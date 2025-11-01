<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource for users.
     */
    public function index()
    {
        $pengajuans = PengajuanSurat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $is_verified_user = Auth::user()->is_verified;
        
        return view('user.pengajuan-surat.index', compact('pengajuans', 'is_verified_user'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $pengajuans = PengajuanSurat::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.pengajuan-surat.index', compact('pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisSurat = [
            'Surat KUA',
            'Surat Keterangan Tidak Mampu',
            'Surat Domisili',
            'Surat Keterangan Tanah',
            'SKCK',
            'Surat Permohonan Bantuan'
        ];
        
        return view('user.pengajuan-surat.create', compact('jenisSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required|in:Surat KUA,Surat Keterangan Tidak Mampu,Surat Domisili,Surat Keterangan Tanah,SKCK,Surat Permohonan Bantuan',
            'keperluan' => 'required|string',
            'surat_pengantar_rw' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ], [
            'jenis_surat.required' => 'Jenis surat harus dipilih',
            'keperluan.required' => 'Keperluan harus diisi',
            'surat_pengantar_rw.required' => 'Surat pengantar RW wajib dilampirkan',
            'surat_pengantar_rw.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
            'surat_pengantar_rw.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Upload surat pengantar RW
        $filePath = $request->file('surat_pengantar_rw')->store('surat-pengantar-rw', 'public');

        // Generate nomor pengajuan
        $nomorPengajuan = PengajuanSurat::generateNomorPengajuan();

        // Simpan data pengajuan
        PengajuanSurat::create([
            'user_id' => Auth::id(),
            'nomor_pengajuan' => $nomorPengajuan,
            'jenis_surat' => $validated['jenis_surat'],
            'keperluan' => $validated['keperluan'],
            'surat_pengantar_rw' => $filePath,
            'keterangan_tambahan' => $validated['keterangan_tambahan'],
        ]);

        return redirect()->route('pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dibuat dengan nomor: ' . $nomorPengajuan);
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $viewPath = Auth::user()->role === 'admin' 
            ? 'admin.pengajuan-surat.show' 
            : 'user.pengajuan-surat.show';

        return view($viewPath, compact('pengajuanSurat'));
    }

    /**
     * Update status pengajuan (Admin only).
     */
    public function updateStatus(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'catatan_admin' => 'nullable|string',
            'file_surat_jadi' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = [
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'],
        ];

        // Upload file surat jadi jika ada
        if ($request->hasFile('file_surat_jadi')) {
            // Hapus file lama jika ada
            if ($pengajuanSurat->file_surat_jadi) {
                Storage::disk('public')->delete($pengajuanSurat->file_surat_jadi);
            }
            
            $data['file_surat_jadi'] = $request->file('file_surat_jadi')->store('surat-jadi', 'public');
        }

        // Set tanggal selesai jika status selesai
        if ($validated['status'] === 'Selesai') {
            $data['tanggal_selesai'] = now();
        }

        $pengajuanSurat->update($data);

        return redirect()->back()
            ->with('success', 'Status pengajuan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized
        if ($pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa dihapus jika status masih Menunggu
        if ($pengajuanSurat->status !== 'Menunggu') {
            return redirect()->back()
                ->with('error', 'Pengajuan yang sudah diproses tidak dapat dihapus');
        }

        // Hapus file surat pengantar
        if ($pengajuanSurat->surat_pengantar_rw) {
            Storage::disk('public')->delete($pengajuanSurat->surat_pengantar_rw);
        }

        // Hapus file surat jadi jika ada
        if ($pengajuanSurat->file_surat_jadi) {
            Storage::disk('public')->delete($pengajuanSurat->file_surat_jadi);
        }

        $pengajuanSurat->delete();

        return redirect()->route('pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus');
    }

    /**
     * Download file surat pengantar RW.
     */
    public function downloadSuratPengantar(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $path = Storage::disk('public')->path($pengajuanSurat->surat_pengantar_rw);
        return response()->download($path);
    }

    /**
     * Download file surat jadi.
     */
    public function downloadSuratJadi(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized
        if ($pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!$pengajuanSurat->file_surat_jadi) {
            return redirect()->back()
                ->with('error', 'Surat belum tersedia');
        }

        $path = Storage::disk('public')->path($pengajuanSurat->file_surat_jadi);
        return response()->download($path);
    }
}
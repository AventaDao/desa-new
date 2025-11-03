<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of pengaduan for user
     */
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Display a listing of pengaduan for admin
     */
    public function adminIndex()
    {
        $pengaduans = Pengaduan::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new pengaduan
     */
    public function create()
    {
        $kategoris = [
            'Kendala Sistem Informasi Desa',
            'Bantuan Sistem Informasi Desa',
            'Laporan Kejadian Lapangan'
        ];
        
        return view('user.pengaduan.create', compact('kategoris'));
    }

    /**
     * Store a newly created pengaduan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|in:Kendala Sistem Informasi Desa,Bantuan Sistem Informasi Desa,Laporan Kejadian Lapangan',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'kategori.required' => 'Kategori pengaduan harus dipilih',
            'judul.required' => 'Judul pengaduan harus diisi',
            'deskripsi.required' => 'Deskripsi pengaduan harus diisi',
            'lampiran.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
            'lampiran.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Upload lampiran jika ada
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('pengaduan', 'public');
        }

        // Generate nomor pengaduan
        $nomorPengaduan = Pengaduan::generateNomorPengaduan();

        Pengaduan::create([
            'user_id' => Auth::id(),
            'nomor_pengaduan' => $nomorPengaduan,
            'kategori' => $validated['kategori'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'lampiran' => $lampiranPath,
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim dengan nomor: ' . $nomorPengaduan);
    }

    /**
     * Display the specified pengaduan
     */
    public function show(Pengaduan $pengaduan)
    {
        // Check authorization
        if (Auth::user()->role !== 'admin' && $pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $viewPath = Auth::user()->role === 'admin' 
            ? 'admin.pengaduan.show' 
            : 'user.pengaduan.show';

        return view($viewPath, compact('pengaduan'));
    }

    /**
     * Update tanggapan pengaduan (Admin only)
     */
    public function updateTanggapan(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'tanggapan_admin' => 'nullable|string',
        ]);

        $pengaduan->update([
            'status' => $validated['status'],
            'tanggapan_admin' => $validated['tanggapan_admin'],
            'tanggal_tanggapan' => now(),
            'ditanggapi_oleh' => Auth::id(),
        ]);

        return redirect()->back()
            ->with('success', 'Tanggapan berhasil disimpan');
    }

    /**
     * Remove the specified pengaduan
     */
    public function destroy(Pengaduan $pengaduan)
    {
        // Check authorization
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa dihapus jika status masih Menunggu
        if ($pengaduan->status !== 'Menunggu') {
            return redirect()->back()
                ->with('error', 'Pengaduan yang sudah diproses tidak dapat dihapus');
        }

        // Hapus lampiran jika ada
        if ($pengaduan->lampiran) {
            Storage::disk('public')->delete($pengaduan->lampiran);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }

    /**
     * Download lampiran pengaduan
     */
    public function downloadLampiran(Pengaduan $pengaduan)
    {
        // Check authorization
        if (Auth::user()->role !== 'admin' && $pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!$pengaduan->lampiran) {
            return redirect()->back()
                ->with('error', 'Lampiran tidak tersedia');
        }

        $path = Storage::disk('public')->path($pengaduan->lampiran);
        return response()->download($path);
    }
}
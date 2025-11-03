<?php

namespace App\Http\Controllers;

use App\Models\BeritaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaDesaController extends Controller
{
    /**
     * Display a listing of berita for admin
     */
    public function index()
    {
        $beritas = BeritaDesa::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new berita
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created berita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:draft,publish',
        ], [
            'judul.required' => 'Judul berita harus diisi',
            'isi.required' => 'Isi berita harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus JPEG, PNG, atau JPG',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'tanggal_publikasi.required' => 'Tanggal publikasi harus diisi',
        ]);

        // Upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        BeritaDesa::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'gambar' => $gambarPath,
            'tanggal_publikasi' => $validated['tanggal_publikasi'],
            'status' => $validated['status'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified berita
     */
    public function show(BeritaDesa $beritum)
    {
        return view('admin.berita.show', compact('beritum'));
    }

    /**
     * Show the form for editing berita
     */
    public function edit(BeritaDesa $beritum)
    {
        return view('admin.berita.edit', compact('beritum'));
    }

    /**
     * Update the specified berita
     */
    public function update(Request $request, BeritaDesa $beritum)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:draft,publish',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $beritum->update($validated);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified berita
     */
    public function destroy(BeritaDesa $beritum)
    {
        // Hapus gambar jika ada
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }

        $beritum->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
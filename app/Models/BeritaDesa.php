<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal_publikasi',
        'status',
        'user_id',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'date',
    ];

    /**
     * Relasi ke User (Penulis)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk berita yang sudah publish
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'publish')
                     ->where('tanggal_publikasi', '<=', now())
                     ->orderBy('tanggal_publikasi', 'desc');
    }
}
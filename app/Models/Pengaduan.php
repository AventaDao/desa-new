<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_pengaduan',
        'kategori',
        'judul',
        'deskripsi',
        'lampiran',
        'status',
        'tanggapan_admin',
        'tanggal_tanggapan',
        'ditanggapi_oleh',
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    /**
     * Relasi ke User (Pelapor)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke User (Admin yang menanggapi)
     */
    public function adminPenanggap()
    {
        return $this->belongsTo(User::class, 'ditanggapi_oleh');
    }

    /**
     * Generate nomor pengaduan otomatis
     */
    public static function generateNomorPengaduan()
    {
        $tahun = date('Y');
        $bulan = date('m');
        
        $lastPengaduan = self::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->orderBy('id', 'desc')
            ->first();
        
        $urutan = $lastPengaduan ? (int) substr($lastPengaduan->nomor_pengaduan, -4) + 1 : 1;
        
        return sprintf('ADU/%s/%s/%04d', $tahun, $bulan, $urutan);
    }

    /**
     * Get badge class berdasarkan status
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'Menunggu' => 'bg-warning',
            'Diproses' => 'bg-info',
            'Selesai' => 'bg-success',
            'Ditolak' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    /**
     * Get icon berdasarkan kategori
     */
    public function getKategoriIconAttribute()
    {
        return match($this->kategori) {
            'Kendala Sistem Informasi Desa' => 'ti-bug',
            'Bantuan Sistem Informasi Desa' => 'ti-help',
            'Laporan Kejadian Lapangan' => 'ti-alert-triangle',
            default => 'ti-message'
        };
    }
}
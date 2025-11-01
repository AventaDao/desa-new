<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_pengajuan',
        'jenis_surat',
        'keperluan',
        'surat_pengantar_rw',
        'keterangan_tambahan',
        'status',
        'catatan_admin',
        'file_surat_jadi',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate nomor pengajuan otomatis
     */
    public static function generateNomorPengajuan()
    {
        $tahun = date('Y');
        $bulan = date('m');
        
        $lastPengajuan = self::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->orderBy('id', 'desc')
            ->first();
        
        $urutan = $lastPengajuan ? (int) substr($lastPengajuan->nomor_pengajuan, -4) + 1 : 1;
        
        return sprintf('SRT/%s/%s/%04d', $tahun, $bulan, $urutan);
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
}
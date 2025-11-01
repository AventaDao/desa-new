<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'pendidikan_terakhir',
        'nama_ayah',
        'nama_ibu',
        'no_telepon',
        'status_hidup',
        'tanggal_meninggal',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_meninggal' => 'date',
    ];

    /**
     * Get the age of the person
     */
    public function getUmurAttribute()
    {
        if ($this->status_hidup === 'Meninggal') {
            return $this->tanggal_lahir->diffInYears($this->tanggal_meninggal);
        }
        return $this->tanggal_lahir->age;
    }
}
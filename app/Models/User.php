<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'email',
        'password',
        'role',
        'avatar',
        'provider',
        'provider_id',
        'is_verified',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
            'otp_expires_at' => 'datetime',
            'is_verified' => 'boolean',
        ];
    }

    // Accessor untuk nama (untuk kompatibilitas dengan kode lama)
    public function getNameAttribute()
    {
        return $this->nama_lengkap;
    }

    // Get umur
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
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
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke UserBlacklist
     */
    public function blacklists()
    {
        return $this->hasMany(UserBlacklist::class);
    }

    /**
     * Get active blacklist
     */
    public function activeBlacklist()
    {
        return $this->hasOne(UserBlacklist::class)
                    ->where('is_active', true)
                    ->where('expires_at', '>', now());
    }

    /**
     * Check if user is blacklisted
     */
    public function isBlacklisted()
    {
        return $this->activeBlacklist()->exists();
    }

    /**
     * Get blacklist info
     */
    public function getBlacklistInfo()
    {
        return $this->activeBlacklist;
    }
}
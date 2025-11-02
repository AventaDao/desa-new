<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserBlacklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason',
        'blacklisted_at',
        'expires_at',
        'is_active',
        'blacklisted_by',
    ];

    protected $casts = [
        'blacklisted_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke User yang di-blacklist
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Admin yang melakukan blacklist
     */
    public function blacklistedBy()
    {
        return $this->belongsTo(User::class, 'blacklisted_by');
    }

    /**
     * Check apakah blacklist masih aktif
     */
    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }

    /**
     * Get remaining time
     */
    public function getRemainingTimeAttribute()
    {
        if ($this->isExpired()) {
            return 'Expired';
        }
        
        return Carbon::now()->diffForHumans($this->expires_at, true);
    }

    /**
     * Scope untuk blacklist yang masih aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('expires_at', '>', Carbon::now());
    }

    /**
     * Auto deactivate expired blacklist
     */
    public static function deactivateExpired()
    {
        return self::where('is_active', true)
                   ->where('expires_at', '<=', Carbon::now())
                   ->update(['is_active' => false]);
    }
}
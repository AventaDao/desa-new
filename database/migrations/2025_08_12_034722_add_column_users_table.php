<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add columns only if they do not already exist to avoid duplicate column errors
        if (!Schema::hasColumn('users', 'otp_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('otp_code')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'otp_expires_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dateTime('otp_expires_at')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'is_verified')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_verified')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop columns only if they exist
        if (Schema::hasColumn('users', 'otp_code') || Schema::hasColumn('users', 'otp_expires_at') || Schema::hasColumn('users', 'is_verified')) {
            Schema::table('users', function (Blueprint $table) {
                $drop = [];
                if (Schema::hasColumn('users', 'otp_code')) {
                    $drop[] = 'otp_code';
                }
                if (Schema::hasColumn('users', 'otp_expires_at')) {
                    $drop[] = 'otp_expires_at';
                }
                if (Schema::hasColumn('users', 'is_verified')) {
                    $drop[] = 'is_verified';
                }

                if (!empty($drop)) {
                    $table->dropColumn($drop);
                }
            });
        }
    }
};

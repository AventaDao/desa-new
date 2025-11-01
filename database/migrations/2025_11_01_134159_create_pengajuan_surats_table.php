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
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pengajuan')->unique();
            $table->enum('jenis_surat', [
                'Surat KUA',
                'Surat Keterangan Tidak Mampu',
                'Surat Domisili',
                'Surat Keterangan Tanah',
                'SKCK',
                'Surat Permohonan Bantuan'
            ]);
            $table->text('keperluan');
            $table->string('surat_pengantar_rw');
            $table->text('keterangan_tambahan')->nullable();
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu');
            $table->text('catatan_admin')->nullable();
            $table->string('file_surat_jadi')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
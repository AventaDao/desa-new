<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanSuratController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact-us', function () {
    return view('contact');
});
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');

Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');
// Route yang hanya bisa diakses oleh user yang belum login
Route::middleware(['guest'])->group(
    function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');

        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');

        Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
        Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');

        // Request reset link
        Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

        // Reset password form
        Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
    }
);


// Route yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/myprofile', function () {
        return view('myprofile');
    });

    // Admin routes
    Route::middleware(['cekRole:admin'])->prefix('admin')->group(function () {
        // Data Penduduk
        Route::resource('penduduk', PendudukController::class);

        // Pengajuan Surat Admin Routes
        Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'adminIndex'])->name('admin.pengajuan-surat.index');
        Route::get('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'show'])->name('admin.pengajuan-surat.show');
        Route::patch('/pengajuan-surat/{pengajuanSurat}/status', [PengajuanSuratController::class, 'updateStatus'])->name('admin.pengajuan-surat.update-status');

        Route::get('/verifikasi', function () {
            return view('admin.verifikasi');
        })->name('admin.verifikasi');
        Route::get('/seleksi', function () {
            return view('admin.seleksi');
        })->name('admin.seleksi');
        Route::get('/pengumuman', function () {
            return view('admin.pengumuman');
        })->name('admin.pengumuman');
        Route::get('/laporan', function () {
            return view('admin.laporan');
        })->name('admin.laporan');
    });

    // User routes
    Route::middleware(['cekRole:user'])->group(function () {
        Route::get('/biodata',  [BiodataController::class, 'index'])->name('user.biodata');
        Route::get('/dokumen', function () {
            return view('user.dokumen');
        })->name('user.dokumen');
        Route::get('/status', function () {
            return view('user.status');
        })->name('user.status');
        Route::get('/daftar-ulang', function () {
            return view('user.daftar_ulang');
        })->name('user.daftar_ulang');

        // Pengajuan Surat untuk User
        Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
        Route::get('/pengajuan-surat/create', [PengajuanSuratController::class, 'create'])->name('pengajuan-surat.create');
        Route::post('/pengajuan-surat', [PengajuanSuratController::class, 'store'])->name('pengajuan-surat.store');
        Route::get('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'show'])->name('pengajuan-surat.show');
        Route::delete('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'destroy'])->name('pengajuan-surat.destroy');
        Route::get('/pengajuan-surat/{pengajuanSurat}/download-pengantar', [PengajuanSuratController::class, 'downloadSuratPengantar'])->name('pengajuan-surat.download-pengantar');
        Route::get('/pengajuan-surat/{pengajuanSurat}/download-surat-jadi', [PengajuanSuratController::class, 'downloadSuratJadi'])->name('pengajuan-surat.download-surat-jadi');
    });
});
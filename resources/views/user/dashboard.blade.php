<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h2 class="mb-3 text-primary">
                    Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>!
                </h2>

                @if (!$user->is_verified)
                    <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm"
                        role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Akun Anda belum terverifikasi.</strong> Silakan verifikasi terlebih dahulu untuk
                                mengakses semua fitur layanan desa.
                            </div>
                        </div>

                        <a href="{{ route('verify.form') }}" id="verify-button"
                            class="btn btn-warning btn-sm fw-bold">Verifikasi Sekarang</a>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="lead mb-4">
                    Ini adalah <span class="fw-bold text-success">Dashboard Sistem Informasi Desa Candi</span>.  
                    Gunakan menu di samping untuk mengelola dan memantau berbagai data desa seperti <span class="text-info">kelahiran, kematian, dan pengaduan warga</span>.
                </p>

                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-info h-100">
                            <div class="card-body">
                                <i class="bi bi-people-fill fs-2 text-info"></i>
                                <h5 class="card-title mt-2">Data Kelahiran</h5>
                                <p class="card-text">Lihat, tambah, atau kelola data kelahiran warga Desa Candi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-danger h-100">
                            <div class="card-body">
                                <i class="bi bi-heartbreak-fill fs-2 text-danger"></i>
                                <h5 class="card-title mt-2">Data Kematian</h5>
                                <p class="card-text">Pantau dan perbarui data kematian di wilayah desa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning h-100">
                            <div class="card-body">
                                <i class="bi bi-chat-left-dots-fill fs-2 text-warning"></i>
                                <h5 class="card-title mt-2">Pengaduan Warga</h5>
                                <p class="card-text">Tinjau dan tanggapi laporan atau pengaduan dari masyarakat.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="/myprofile" class="btn btn-primary mt-4 px-4">
                    <i class="bi bi-person-circle me-2"></i> Profil Saya
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk menangani tombol verifikasi agar menampilkan status "processing"
    const verifyButton = document.getElementById('verify-button');

    if (verifyButton) {
        verifyButton.addEventListener('click', function() {
            this.classList.add('disabled');
            this.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Memproses...
            `;
        });
    }
</script>

<div class="row justify-content-center">
    <!-- Berita Desa Section -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-news me-2"></i>Berita Terbaru Desa</h5>
                <span class="badge bg-light text-primary">{{ $beritas->count() }} Berita</span>
            </div>
            <div class="card-body p-0">
                @if($beritas->count() > 0)
                <div id="beritaCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($beritas as $key => $berita)
                        <button type="button" data-bs-target="#beritaCarousel" data-bs-slide-to="{{ $key }}" 
                                class="{{ $key == 0 ? 'active' : '' }}" 
                                aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                    
                    <div class="carousel-inner">
                        @foreach($beritas as $key => $berita)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row g-0">
                                @if($berita->gambar)
                                <div class="col-md-5">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                         class="d-block w-100" 
                                         alt="{{ $berita->judul }}"
                                         style="height: 350px; object-fit: cover;">
                                </div>
                                <div class="col-md-7">
                                @else
                                <div class="col-md-12">
                                @endif
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="badge bg-primary me-2">
                                                <i class="ti ti-calendar me-1"></i>
                                                {{ $berita->tanggal_publikasi->format('d M Y') }}
                                            </span>
                                            <span class="badge bg-info">
                                                <i class="ti ti-user me-1"></i>
                                                {{ $berita->user->name }}
                                            </span>
                                        </div>
                                        
                                        <h3 class="mb-3">{{ $berita->judul }}</h3>
                                        <p class="text-muted" style="text-align: justify; line-height: 1.8;">
                                            {{ Str::limit($berita->isi, 300) }}
                                        </p>
                                        
                                        @if(strlen($berita->isi) > 300)
                                        <button type="button" class="btn btn-outline-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#beritaModal{{ $berita->id }}">
                                            <i class="ti ti-book-2"></i> Baca Selengkapnya
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal untuk berita lengkap -->
                        <div class="modal fade" id="beritaModal{{ $berita->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $berita->judul }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                             class="img-fluid rounded mb-3" 
                                             alt="{{ $berita->judul }}">
                                        @endif
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="badge bg-primary me-2">
                                                <i class="ti ti-calendar me-1"></i>
                                                {{ $berita->tanggal_publikasi->format('d F Y') }}
                                            </span>
                                            <span class="badge bg-info">
                                                <i class="ti ti-user me-1"></i>
                                                {{ $berita->user->name }}
                                            </span>
                                        </div>
                                        
                                        <div style="text-align: justify; line-height: 1.8; white-space: pre-line;">
                                            {{ $berita->isi }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#beritaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#beritaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="ti ti-news-off f-40 text-muted mb-3"></i>
                    <p class="text-muted">Belum ada berita terbaru</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
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

<style>
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    padding: 20px;
}

.carousel-indicators button {
    background-color: rgba(0, 0, 0, 0.5);
}

.carousel-indicators button.active {
    background-color: #4680ff;
}

.carousel-item {
    min-height: 350px;
}
</style>

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

    // Auto slide carousel setiap 5 detik
    var myCarousel = document.querySelector('#beritaCarousel')
    if (myCarousel) {
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            wrap: true
        })
    }
</script>
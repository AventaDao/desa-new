@extends('layouts.landing')

@section('title', 'Selamat Datang di Sistem Informasi Desa')

@section('content')
    <!-- [ Header ] start -->
    <header id="home" class="d-flex align-items-center"
        style="position: relative; min-height: 100dvh; background: url('{{ asset('assets/images/my/ppdesa.jpeg') }}') no-repeat center center; background-size: cover;">
        <!-- Overlay -->
        <div
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.1));">
        </div>

        <div class="container mt-5 pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center">
                    <h1 class="mt-sm-3 text-white mb-4 f-w-600 wow fadeInUp" data-wow-delay="0.2s" style="font-size: 3.5rem;">
                        Selamat Datang di
                        <br>
                        <span class="text-primary">Aplikasi Sistem Informasi Desa</span>
                    </h1>
                    <h5 class="mb-4 text-white opacity-75 wow fadeInUp" data-wow-delay="0.4s" style="font-size: 1.25rem;">
                        Transparansi dan Kemudahan Akses Data untuk Masyarakat Desa.
                        <br class="d-none d-md-block">
                        Akses informasi desa, data penduduk, surat menyurat, dan pengaduan secara online.
                    </h5>
                    <div class="my-5 wow fadeInUp" data-wow-delay="0.6s">
                        <a href="{{ route('login') }}"
                            class="btn btn-primary btn-lg d-inline-flex align-items-center me-2" target="_blank">Masuk
                            Sistem <i class="ti ti-arrow-right ms-2"></i></a>
                        <a href="#fitur" class="btn btn-outline-light btn-lg me-2">Lihat Fitur Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- [ Header ] End -->

    <!-- [ Fitur Utama ] start -->
    <section id="fitur">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <h5 class="text-primary mb-0">Inovasi Desa Digital</h5>
                    <h2 class="my-3">Mengapa Memilih Sistem Ini?</h2>
                    <p class="mb-0">Sistem Informasi Desa membantu pemerintah dan masyarakat mengelola data kependudukan,
                        pelayanan publik, serta laporan desa dengan mudah dan transparan.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-body">
                            <img src="../assets/images/landing/img-feature1.svg"
                                alt="Dashboard data desa" class="img-fluid">
                            <h5 class="my-3">Manajemen Data Desa</h5>
                            <p class="mb-0 text-muted">Kelola data penduduk, kelahiran, kematian, dan potensi desa secara
                                terpusat dan efisien.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-body">
                            <img src="../assets/images/landing/img-feature2.svg"
                                alt="Pelayanan publik digital" class="img-fluid">
                            <h5 class="my-3">Pelayanan Surat Online</h5>
                            <p class="mb-0 text-muted">Warga dapat mengajukan berbagai surat seperti domisili, kematian,
                                dan lainnya secara daring.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card wow fadeInUp" data-wow-delay="0.8s">
                        <div class="card-body">
                            <img src="../assets/images/landing/img-feature3.svg"
                                alt="Laporan pengaduan warga" class="img-fluid">
                            <h5 class="my-3">Laporan & Pengaduan</h5>
                            <p class="mb-0 text-muted">Warga dapat menyampaikan aspirasi dan pengaduan langsung melalui
                                sistem secara cepat dan transparan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Fitur Utama ] End -->

    <!-- [ Alur Penggunaan ] start -->
    <section class="pt-0" id="alur">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <h5 class="text-primary mb-0">Langkah Mudah</h5>
                    <h2 class="my-3">Cara Menggunakan Sistem</h2>
                    <p class="mb-0">Hanya empat langkah untuk menikmati kemudahan layanan administrasi desa secara digital.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-body text-center">
                            <i class="ti ti-user-plus f-36 text-primary"></i>
                            <h5 class="my-3">1. Login</h5>
                            <p class="mb-0 text-muted">Masuk sebagai admin atau warga untuk mengakses fitur sesuai peran.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-body text-center">
                            <i class="ti ti-file-text f-36 text-primary"></i>
                            <h5 class="my-3">2. Kelola Data</h5>
                            <p class="mb-0 text-muted">Lengkapi dan perbarui data penduduk, surat, dan pengajuan secara
                                online.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="0.8s">
                        <div class="card-body text-center">
                            <i class="ti ti-search f-36 text-primary"></i>
                            <h5 class="my-3">3. Proses Verifikasi</h5>
                            <p class="mb-0 text-muted">Admin desa memverifikasi dan menyetujui data atau pengajuan Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="1.0s">
                        <div class="card-body text-center">
                            <i class="ti ti-bell f-36 text-primary"></i>
                            <h5 class="my-3">4. Selesai</h5>
                            <p class="mb-0 text-muted">Data dan surat dapat diunduh atau dicetak langsung dari sistem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Alur Penggunaan ] End -->

    <!-- [ CTA ] start -->
    <section class="cta-block"
        style="position: relative; padding: 120px 0; background: url('{{ asset('assets/images/my/join-us.png') }}') no-repeat center center; background-size: cover; background-attachment: fixed;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6);">
        </div>

        <div class="container" style="position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="text-white mb-4" style="font-size: 2.8rem; font-weight: 600;">Tingkatkan Layanan Desa dengan
                        <span class="text-primary">Sistem Informasi Digital</span></h2>
                    <p class="text-white opacity-75 mb-4 lead">Wujudkan tata kelola desa yang modern, transparan, dan efisien
                        bersama aplikasi kami.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Masuk Sistem <i
                            class="ti ti-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- [ CTA ] End -->

    <!-- [ Statistik ] start -->
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h2 class="m-0 text-primary">1.250+</h2>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-2">Penduduk Terdata</h4>
                                    <p class="mb-0">Data penduduk tersimpan aman dan dapat diperbarui secara berkala.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h2 class="m-0 text-primary">50+</h2>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-2">Layanan Surat</h4>
                                    <p class="mb-0">Beragam jenis surat resmi desa dapat diajukan melalui sistem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h2 class="m-0 text-primary">10+</h2>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-2">Program Desa</h4>
                                    <p class="mb-0">Informasi kegiatan dan potensi desa yang terus dikembangkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Statistik ] End -->

    <!-- [ Testimoni ] start -->
    <section class="pt-0">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <h5 class="text-primary mb-0">Testimoni</h5>
                    <h2 class="my-3">Apa Kata Warga?</h2>
                    <p class="mb-0">Kami bangga memberikan pelayanan terbaik. Simak pengalaman warga dalam menggunakan Sistem Informasi Desa Bangah.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row cust-slider">
                <div class="col-md-6 col-lg-4">
                    <div class="card wow fadeInRight" data-wow-delay="0.2s">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/user/avatar-1.jpg"
                                        alt="Foto warga pria tersenyum" class="img-fluid wid-40 rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">Pelayanan Cepat dan Ramah</h5>
                                    <div class="star f-12 mb-3">
                                        <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                                    </div>
                                    <p class="mb-2 text-muted">Proses pengurusan surat jauh lebih mudah dan cepat melalui sistem ini. Sangat membantu warga!</p>
                                    <h6 class="mb-0">Dao Rachel Lie, Warga</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card wow fadeInRight" data-wow-delay="0.4s">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/user/avatar-2.jpg"
                                        alt="Foto warga wanita tersenyum"
                                        class="img-fluid wid-40 rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">Transparansi Data Desa</h5>
                                    <div class="star f-12 mb-3">
                                        <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                    <p class="mb-2 text-muted">Sekarang semua informasi desa bisa diakses dengan mudah dan terbuka. Sangat bagus untuk warga.</p>
                                    <h6 class="mb-0">deezydaoo, Warga</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card wow fadeInRight" data-wow-delay="0.6s">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/user/avatar-3.jpg"
                                        alt="Foto warga berhijab tersenyum"
                                        class="img-fluid wid-40 rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">Inovasi Digital Desa</h5>
                                    <div class="star f-12 mb-3">
                                        <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                                    </div>
                                    <p class="mb-2 text-muted">Sistem ini benar-benar membantu warga mengurus layanan tanpa harus datang ke kantor desa.</p>
                                    <h6 class="mb-0">dao, Warga</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Testimoni ] End -->
@endsection

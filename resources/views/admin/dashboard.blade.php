<div class="row">
    <!-- Statistik Utama -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Jumlah Penduduk</h6>
                <h4 class="mb-3">3,258 <span class="badge bg-light-primary border border-primary">
                        <i class="ti ti-trending-up"></i> 2.4%</span></h4>
                <p class="mb-0 text-muted text-sm">Naik <span class="text-primary">78</span> penduduk dari tahun lalu</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Keluarga Terdaftar</h6>
                <h4 class="mb-3">1,024 <span class="badge bg-light-success border border-success">
                        <i class="ti ti-trending-up"></i> 1.8%</span></h4>
                <p class="mb-0 text-muted text-sm">Bertambah <span class="text-success">18</span> KK bulan ini</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Data Kelahiran</h6>
                <h4 class="mb-3">56 <span class="badge bg-light-warning border border-warning">
                        <i class="ti ti-trending-up"></i> 4.2%</span></h4>
                <p class="mb-0 text-muted text-sm"><span class="text-warning">12</span> bayi lahir bulan ini</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Data Kematian</h6>
                <h4 class="mb-3">8 <span class="badge bg-light-danger border border-danger">
                        <i class="ti ti-trending-down"></i> 1.1%</span></h4>
                <p class="mb-0 text-muted text-sm">Turun <span class="text-danger">3</span> kasus dari bulan lalu</p>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik Penduduk -->
    <div class="col-md-12 col-xl-8">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0">Statistik Penduduk</h5>
            <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-home" type="button" role="tab" aria-controls="chart-tab-home"
                        aria-selected="true">Per Bulan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-profile" type="button" role="tab"
                        aria-controls="chart-tab-profile" aria-selected="false">Per Minggu</button>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="chart-tab-tabContent">
                    <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                        tabindex="0">
                        <div id="statistik-bulanan"></div>
                    </div>
                    <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                        aria-labelledby="chart-tab-profile-tab" tabindex="0">
                        <div id="statistik-mingguan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Anggaran Desa -->
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Anggaran Desa</h5>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Penggunaan Minggu Ini</h6>
                <h3 class="mb-3">Rp 12.450.000</h3>
                <div id="anggaran-chart"></div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengajuan Warga -->
    <div class="col-md-12 col-xl-8">
        <h5 class="mb-3">Pengajuan Warga</h5>
        <div class="card tbl-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>No. Surat</th>
                                <th>Nama Pengaju</th>
                                <th>Jenis Surat</th>
                                <th>Status</th>
                                <th class="text-end">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="text-muted">SK-00021</a></td>
                                <td>Ahmad Setiawan</td>
                                <td>Surat Domisili</td>
                                <td><span class="badge bg-warning text-dark">Diproses</span></td>
                                <td class="text-end">08 Okt 2025</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">SK-00018</a></td>
                                <td>Sri Wahyuni</td>
                                <td>Surat Keterangan Usaha</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td class="text-end">06 Okt 2025</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">SK-00015</a></td>
                                <td>Budi Santoso</td>
                                <td>Surat Kematian</td>
                                <td><span class="badge bg-danger">Ditolak</span></td>
                                <td class="text-end">03 Okt 2025</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">SK-00012</a></td>
                                <td>Dewi Lestari</td>
                                <td>Surat Keterangan Tidak Mampu</td>
                                <td><span class="badge bg-warning text-dark">Diproses</span></td>
                                <td class="text-end">01 Okt 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Keuangan Desa -->
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Laporan Keuangan</h5>
        <div class="card">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                    Dana Desa Terserap<span class="h6 mb-0 text-success">85%</span></a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                    Dana Operasional<span class="h6 mb-0 text-primary">Rp 4,2 Jt</span></a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                    Belanja Sosial<span class="h6 mb-0 text-warning">Rp 2,1 Jt</span></a>
            </div>
            <div class="card-body px-2">
                <div id="laporan-keuangan-chart"></div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Warga -->
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Aktivitas Warga</h5>
        <div class="card">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                <i class="ti ti-home f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Pengajuan Surat Domisili</h6>
                            <p class="mb-0 text-muted">Hari ini, 08:00</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-success">+1</h6>
                            <p class="mb-0 text-muted">Baru</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                                <i class="ti ti-users f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Pendataan Keluarga Baru</h6>
                            <p class="mb-0 text-muted">Kemarin, 14:30</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-primary">+2 KK</h6>
                            <p class="mb-0 text-muted">Tercatat</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                <i class="ti ti-alert-triangle f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Laporan Pengaduan Jalan Rusak</h6>
                            <p class="mb-0 text-muted">2 jam lalu</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-danger">1 Laporan</h6>
                            <p class="mb-0 text-muted">Menunggu</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

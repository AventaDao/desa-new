<li class="pc-item {{ request()->is('penduduk*') ? 'active' : '' }}">
    <a href="{{ route('penduduk.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-users"></i></span>
        <span class="pc-mtext">Data Penduduk</span>
    </a>
</li>
<li class="pc-item {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
    <a href="{{ route('pengajuan-surat.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>
<li class="pc-item">
    <a href="{{ route('admin.verifikasi') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-check"></i>
        </span><span class="pc-mtext">Verifikasi Berkas</span></a>
</li>
<li class="pc-item"><a href="{{ route('admin.seleksi') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-list-check"></i></span>
        <span class="pc-mtext">Seleksi</span></a>
</li>
<li class="pc-item">
    <a href="{{ route('admin.pengumuman') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-bell"></i></span>
        <span class="pc-mtext">Pengumuman</span></a>
</li>
<li class="pc-item">
    <a href="{{ route('admin.laporan') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-report"></i></span>
        <span class="pc-mtext">Laporan</span></a>
</li>
<li class="pc-item {{ request()->is('admin/berita*') ? 'active' : '' }}">
    <a href="{{ route('berita.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-news"></i></span>
        <span class="pc-mtext">Kelola Berita</span>
    </a>
</li>
<li class="pc-item {{ request()->is('penduduk*') ? 'active' : '' }}">
    <a href="{{ route('penduduk.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-users"></i></span>
        <span class="pc-mtext">Data Penduduk</span>
    </a>
</li>
<li class="pc-item {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengajuan-surat.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>
<li class="pc-item {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengaduan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-message-report"></i></span>
        <span class="pc-mtext">Kelola Pengaduan</span>
    </a>
</li>
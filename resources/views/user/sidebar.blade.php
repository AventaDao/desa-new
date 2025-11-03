<li class="pc-item {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
    <a href="{{ route('pengajuan-surat.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>

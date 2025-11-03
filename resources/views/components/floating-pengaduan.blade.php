<!-- Floating Pengaduan Button -->
<div class="floating-pengaduan">
    <!-- Main Button -->
    <button class="btn-pengaduan-main" id="btnPengaduanMain" onclick="togglePengaduanMenu()">
        <i class="ti ti-headset"></i>
    </button>

    <!-- Menu Pengaduan -->
    <div class="pengaduan-menu" id="pengaduanMenu" style="display: none;">
        <div class="pengaduan-menu-header">
            <h6 class="mb-0">Pusat Bantuan</h6>
            <button class="btn-close-pengaduan" onclick="togglePengaduanMenu()">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="pengaduan-menu-body">
            <p class="text-muted mb-3">Pilih kategori pengaduan yang sesuai:</p>
            
            <a href="{{ route('pengaduan.create') }}?kategori=Kendala Sistem Informasi Desa" class="pengaduan-item">
                <div class="pengaduan-icon bg-danger">
                    <i class="ti ti-bug"></i>
                </div>
                <div class="pengaduan-content">
                    <h6 class="mb-1">Kendala Sistem</h6>
                    <small class="text-muted">Laporkan masalah teknis website</small>
                </div>
            </a>

            <a href="{{ route('pengaduan.create') }}?kategori=Bantuan Sistem Informasi Desa" class="pengaduan-item">
                <div class="pengaduan-icon bg-primary">
                    <i class="ti ti-help"></i>
                </div>
                <div class="pengaduan-content">
                    <h6 class="mb-1">Bantuan Sistem</h6>
                    <small class="text-muted">Butuh bantuan menggunakan sistem</small>
                </div>
            </a>

            <a href="{{ route('pengaduan.create') }}?kategori=Laporan Kejadian Lapangan" class="pengaduan-item">
                <div class="pengaduan-icon bg-warning">
                    <i class="ti ti-alert-triangle"></i>
                </div>
                <div class="pengaduan-content">
                    <h6 class="mb-1">Laporan Kejadian</h6>
                    <small class="text-muted">Laporkan kejadian di lapangan</small>
                </div>
            </a>

            <hr class="my-3">

            <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-primary btn-sm w-100">
                <i class="ti ti-list"></i> Lihat Pengaduan Saya
            </a>
        </div>
    </div>
</div>

<style>
.floating-pengaduan {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
}

.btn-pengaduan-main {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);
    border: none;
    color: white;
    font-size: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.4);
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.btn-pengaduan-main:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.6);
}

@keyframes pulse {
    0%, 100% {
        box-shadow: 0 4px 12px rgba(70, 128, 255, 0.4);
    }
    50% {
        box-shadow: 0 4px 20px rgba(70, 128, 255, 0.7);
    }
}

.pengaduan-menu {
    position: absolute;
    bottom: 75px;
    right: 0;
    width: 320px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.pengaduan-menu-header {
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);
    color: white;
    border-radius: 12px 12px 0 0;
}

.btn-close-pengaduan {
    background: transparent;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s ease;
}

.btn-close-pengaduan:hover {
    background: rgba(255, 255, 255, 0.2);
}

.pengaduan-menu-body {
    padding: 15px;
    max-height: 400px;
    overflow-y: auto;
}

.pengaduan-item {
    display: flex;
    align-items: center;
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.pengaduan-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.pengaduan-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin-right: 12px;
    flex-shrink: 0;
}

.pengaduan-content h6 {
    color: #2c3e50;
    margin-bottom: 2px;
}

.pengaduan-content small {
    font-size: 11px;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    .floating-pengaduan {
        bottom: 20px;
        right: 20px;
    }

    .btn-pengaduan-main {
        width: 55px;
        height: 55px;
        font-size: 24px;
    }

    .pengaduan-menu {
        width: calc(100vw - 40px);
        right: -10px;
    }
}
</style>

<script>
function togglePengaduanMenu() {
    const menu = document.getElementById('pengaduanMenu');
    const btn = document.getElementById('btnPengaduanMain');
    
    if (menu.style.display === 'none') {
        menu.style.display = 'block';
        btn.style.transform = 'rotate(180deg)';
    } else {
        menu.style.display = 'none';
        btn.style.transform = 'rotate(0deg)';
    }
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const floatingPengaduan = document.querySelector('.floating-pengaduan');
    if (floatingPengaduan && !floatingPengaduan.contains(event.target)) {
        const menu = document.getElementById('pengaduanMenu');
        const btn = document.getElementById('btnPengaduanMain');
        if (menu && menu.style.display === 'block') {
            menu.style.display = 'none';
            btn.style.transform = 'rotate(0deg)';
        }
    }
});
</script>

@extends('layouts.dashboard')
@section('title', 'Buat Pengaduan Baru')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Buat Pengaduan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Buat Pengaduan Baru</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Kategori Pengaduan <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required id="kategoriSelect">
                                    <option value="">-- Pilih Kategori Pengaduan --</option>
                                    @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori }}" 
                                            {{ (old('kategori') ?? request('kategori')) == $kategori ? 'selected' : '' }}>
                                        @if($kategori == 'Kendala Sistem Informasi Desa')
                                            🐛 {{ $kategori }}
                                        @elseif($kategori == 'Bantuan Sistem Informasi Desa')
                                            ❓ {{ $kategori }}
                                        @else
                                            ⚠️ {{ $kategori }}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Pilih kategori yang sesuai dengan pengaduan Anda</small>
                            </div>

                            <!-- Info berdasarkan kategori -->
                            <div class="col-md-12 mb-3">
                                <div id="infoKendala" class="alert alert-danger d-none">
                                    <i class="ti ti-bug me-2"></i>
                                    <strong>Kendala Sistem:</strong> Laporkan bug, error, atau masalah teknis pada website Sistem Informasi Desa.
                                </div>
                                <div id="infoBantuan" class="alert alert-primary d-none">
                                    <i class="ti ti-help me-2"></i>
                                    <strong>Bantuan Sistem:</strong> Ajukan pertanyaan atau minta bantuan cara menggunakan fitur-fitur di website.
                                </div>
                                <div id="infoLaporan" class="alert alert-warning d-none">
                                    <i class="ti ti-alert-triangle me-2"></i>
                                    <strong>Laporan Kejadian:</strong> Laporkan kejadian atau masalah yang terjadi di lapangan/lingkungan desa.
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                       value="{{ old('judul') }}" required placeholder="Ringkasan singkat pengaduan Anda">
                                @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi Pengaduan <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                          rows="6" required placeholder="Jelaskan pengaduan Anda secara detail...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jelaskan masalah/kejadian dengan sejelas mungkin</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Lampiran (Opsional)</label>
                                <input type="file" name="lampiran" 
                                       class="form-control @error('lampiran') is-invalid @enderror" 
                                       accept=".pdf,.jpg,.jpeg,.png" onchange="previewFile(event)">
                                @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Upload screenshot atau foto pendukung. Format: PDF, JPG, JPEG, PNG. Maksimal 2MB.
                                </small>
                                
                                <div id="preview-container" class="mt-3" style="display: none;">
                                    <p class="text-muted mb-2">Preview:</p>
                                    <img id="preview-image" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    <div id="preview-pdf" class="alert alert-info">
                                        <i class="ti ti-file-text me-2"></i>
                                        <span id="pdf-name"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                            <i class="ti ti-info-circle f-24 me-3"></i>
                            <div>
                                <strong>Catatan:</strong> Pengaduan Anda akan ditinjau oleh tim admin kami. Anda akan mendapatkan notifikasi setelah pengaduan diproses.
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send"></i> Kirim Pengaduan
                            </button>
                            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Show info based on kategori
document.getElementById('kategoriSelect').addEventListener('change', function() {
    // Hide all info
    document.getElementById('infoKendala').classList.add('d-none');
    document.getElementById('infoBantuan').classList.add('d-none');
    document.getElementById('infoLaporan').classList.add('d-none');
    
    // Show selected info
    if (this.value === 'Kendala Sistem Informasi Desa') {
        document.getElementById('infoKendala').classList.remove('d-none');
    } else if (this.value === 'Bantuan Sistem Informasi Desa') {
        document.getElementById('infoBantuan').classList.remove('d-none');
    } else if (this.value === 'Laporan Kejadian Lapangan') {
        document.getElementById('infoLaporan').classList.remove('d-none');
    }
});

// Trigger on page load if kategori already selected
window.addEventListener('load', function() {
    const select = document.getElementById('kategoriSelect');
    if (select.value) {
        select.dispatchEvent(new Event('change'));
    }
});

// Preview file
function previewFile(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const previewPdf = document.getElementById('preview-pdf');
    
    if (file) {
        previewContainer.style.display = 'block';
        
        if (file.type.startsWith('image/')) {
            previewImage.style.display = 'block';
            previewPdf.style.display = 'none';
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else if (file.type === 'application/pdf') {
            previewImage.style.display = 'none';
            previewPdf.style.display = 'block';
            document.getElementById('pdf-name').textContent = file.name;
        }
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>
@endsection
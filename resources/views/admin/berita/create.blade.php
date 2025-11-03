@extends('layouts.dashboard')
@section('title', 'Tambah Berita Desa')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Kelola Berita</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tambah Berita</li>
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
                    <h5>Form Tambah Berita Desa</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                           value="{{ old('judul') }}" required placeholder="Masukkan judul berita">
                                    @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
                                    <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" 
                                              rows="10" required placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
                                    @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Berita</label>
                                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                                           accept="image/*" onchange="previewImage(event)">
                                    @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                                    
                                    <div id="preview-container" class="mt-3" style="display: none;">
                                        <img id="preview-image" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_publikasi" class="form-control @error('tanggal_publikasi') is-invalid @enderror" 
                                           value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" required>
                                    @error('tanggal_publikasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="publish" {{ old('status', 'publish') == 'publish' ? 'selected' : '' }}>Publish</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 border-top pt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Simpan Berita
                            </button>
                            <a href="{{ route('berita.index') }}" class="btn btn-secondary">
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
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
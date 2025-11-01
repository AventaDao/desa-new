@extends('layouts.dashboard')
@section('title', 'Ajukan Surat Baru')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengajuan-surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ajukan Surat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Alert Info -->
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="ti ti-info-circle f-24 me-3"></i>
                <div>
                    <strong>Perhatian!</strong> Pastikan Anda telah memiliki <strong>Surat Pengantar dari RW</strong> sebelum mengajukan surat. File yang diupload harus dalam format PDF, JPG, JPEG, atau PNG dengan ukuran maksimal 2MB.
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Form Pengajuan Surat</h5>
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

                    <form action="{{ route('pengajuan-surat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_surat" class="form-select @error('jenis_surat') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    @foreach($jenisSurat as $jenis)
                                    <option value="{{ $jenis }}" {{ old('jenis_surat') == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Pilih jenis surat yang ingin Anda ajukan</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keperluan <span class="text-danger">*</span></label>
                                <textarea name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" 
                                          rows="4" required placeholder="Jelaskan keperluan pengajuan surat ini...">{{ old('keperluan') }}</textarea>
                                @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jelaskan secara detail keperluan Anda mengajukan surat ini</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Surat Pengantar dari RW <span class="text-danger">*</span></label>
                                <input type="file" name="surat_pengantar_rw" 
                                       class="form-control @error('surat_pengantar_rw') is-invalid @enderror" 
                                       accept=".pdf,.jpg,.jpeg,.png" required>
                                @error('surat_pengantar_rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Format: PDF, JPG, JPEG, atau PNG. Maksimal 2MB.
                                </small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keterangan Tambahan (Opsional)</label>
                                <textarea name="keterangan_tambahan" class="form-control @error('keterangan_tambahan') is-invalid @enderror" 
                                          rows="3" placeholder="Masukkan keterangan tambahan jika ada...">{{ old('keterangan_tambahan') }}</textarea>
                                @error('keterangan_tambahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Informasi tambahan yang perlu disampaikan (opsional)</small>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                            <i class="ti ti-alert-triangle f-24 me-3"></i>
                            <div>
                                <strong>Catatan:</strong> Pastikan semua data yang Anda masukkan sudah benar. Setelah diajukan, pengajuan akan diproses oleh admin desa.
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send"></i> Ajukan Surat
                            </button>
                            <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informasi Jenis Surat -->
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Jenis Surat</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionJenisSurat">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat1">
                                    Surat KUA
                                </button>
                            </h2>
                            <div id="surat1" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    Surat pengantar untuk keperluan administrasi di Kantor Urusan Agama (KUA), seperti untuk nikah, rujuk, atau keperluan lainnya.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat2">
                                    Surat Keterangan Tidak Mampu (SKTM)
                                </button>
                            </h2>
                            <div id="surat2" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    Surat keterangan yang menyatakan kondisi ekonomi keluarga kurang mampu. Biasanya digunakan untuk beasiswa, bantuan sosial, atau keringanan biaya.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat3">
                                    Surat Domisili
                                </button>
                            </h2>
                            <div id="surat3" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    Surat keterangan yang menyatakan tempat tinggal seseorang di wilayah tertentu. Digunakan untuk berbagai keperluan administrasi.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat4">
                                    Surat Keterangan Tanah
                                </button>
                            </h2>
                            <div id="surat4" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    Surat keterangan kepemilikan atau penguasaan tanah. Digunakan untuk keperluan jual beli, waris, atau administrasi tanah lainnya.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat5">
                                    SKCK (Surat Keterangan Catatan Kepolisian)
                                </button>
                            </h2>
                            <div id="surat5" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    Surat pengantar dari desa untuk mengurus SKCK di kepolisian. Digunakan untuk keperluan melamar pekerjaan, pendaftaran sekolah, atau keperluan lainnya.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat6">
                                    Surat Permohonan Bantuan
                                </button>
                            </h2>
                            <div id="surat6" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    Surat permohonan bantuan untuk berbagai keperluan seperti bantuan sosial, renovasi rumah, bantuan kesehatan, atau bantuan lainnya.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
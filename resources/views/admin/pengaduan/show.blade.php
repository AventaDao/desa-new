@extends('layouts.dashboard')
@section('title', 'Detail & Tanggapi Pengaduan')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengaduan.index') }}">Kelola Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Detail Pengaduan -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Pengaduan</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge {{ $pengaduan->status_badge }} fs-6 px-3 py-2">
                            <i class="ti ti-circle-check me-1"></i> Status: {{ $pengaduan->status }}
                        </span>
                    </div>

                    <!-- Data Pengaduan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengaduan</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%" class="text-muted">Nomor Pengaduan</td>
                            <td width="5%">:</td>
                            <td><strong>{{ $pengaduan->nomor_pengaduan }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Pelapor</td>
                            <td>:</td>
                            <td><strong>{{ $pengaduan->user->name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email Pelapor</td>
                            <td>:</td>
                            <td>{{ $pengaduan->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kategori</td>
                            <td>:</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="ti {{ $pengaduan->kategori_icon }} me-1"></i>
                                    {{ $pengaduan->kategori }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Pengaduan</td>
                            <td>:</td>
                            <td>{{ $pengaduan->created_at->format('d F Y H:i') }} WIB</td>
                        </tr>
                        @if($pengaduan->tanggal_tanggapan)
                        <tr>
                            <td class="text-muted">Tanggal Tanggapan</td>
                            <td>:</td>
                            <td>{{ $pengaduan->tanggal_tanggapan->format('d F Y H:i') }} WIB</td>
                        </tr>
                        @endif
                        @if($pengaduan->adminPenanggap)
                        <tr>
                            <td class="text-muted">Ditanggapi Oleh</td>
                            <td>:</td>
                            <td>{{ $pengaduan->adminPenanggap->name }}</td>
                        </tr>
                        @endif
                    </table>

                    <!-- Judul -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Judul Pengaduan</h5>
                    <p class="lead">{{ $pengaduan->judul }}</p>

                    <!-- Deskripsi -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Deskripsi</h5>
                    <p class="text-muted" style="white-space: pre-line;">{{ $pengaduan->deskripsi }}</p>

                    <!-- Lampiran -->
                    @if($pengaduan->lampiran)
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Lampiran</h5>
                    <div class="mb-4">
                        @php
                            $extension = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" 
                             alt="Lampiran" 
                             class="img-fluid rounded mb-2" 
                             style="max-height: 400px;">
                        @else
                        <div class="alert alert-info">
                            <i class="ti ti-file-text f-20 me-2"></i>
                            <strong>File PDF:</strong> {{ basename($pengaduan->lampiran) }}
                        </div>
                        @endif
                        
                        <a href="{{ route('pengaduan.download-lampiran', $pengaduan->id) }}" 
                           class="btn btn-outline-primary btn-sm mt-2">
                            <i class="ti ti-download"></i> Download Lampiran
                        </a>
                    </div>
                    @endif

                    <!-- Tanggapan Admin -->
                    @if($pengaduan->tanggapan_admin)
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Tanggapan Admin</h5>
                    <div class="alert alert-info">
                        <i class="ti ti-message-circle me-2"></i>
                        <div style="white-space: pre-line;">{{ $pengaduan->tanggapan_admin }}</div>
                        @if($pengaduan->adminPenanggap)
                        <hr>
                        <small class="text-muted">
                            Ditanggapi oleh: <strong>{{ $pengaduan->adminPenanggap->name }}</strong><br>
                            Tanggal: {{ $pengaduan->tanggal_tanggapan->format('d F Y H:i') }} WIB
                        </small>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Tanggapan -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Berikan Tanggapan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengaduan.update-tanggapan', $pengaduan->id) }}" 
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="Menunggu" {{ $pengaduan->status == 'Menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>
                                <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggapan untuk Pelapor</label>
                            <textarea name="tanggapan_admin" class="form-control @error('tanggapan_admin') is-invalid @enderror" 
                                      rows="6" placeholder="Tulis tanggapan atau solusi untuk pengaduan ini...">{{ old('tanggapan_admin', $pengaduan->tanggapan_admin) }}</textarea>
                            @error('tanggapan_admin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Tanggapan akan dilihat oleh pelapor</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Simpan Tanggapan
                            </button>
                            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Panduan Status</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="badge bg-warning">Menunggu</span>
                            <small class="d-block text-muted">Pengaduan baru masuk</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-info">Diproses</span>
                            <small class="d-block text-muted">Sedang ditindaklanjuti</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success">Selesai</span>
                            <small class="d-block text-muted">Pengaduan sudah diselesaikan</small>
                        </li>
                        <li class="mb-0">
                            <span class="badge bg-danger">Ditolak</span>
                            <small class="d-block text-muted">Pengaduan ditolak</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
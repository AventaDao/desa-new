@extends('layouts.dashboard')
@section('title', 'Detail Pengaduan')

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
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Detail Pengaduan</h5>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge {{ $pengaduan->status_badge }} fs-6 px-3 py-2">
                            <i class="ti ti-circle-check me-1"></i> Status: {{ $pengaduan->status }}
                        </span>
                    </div>

                    <!-- Data Pengaduan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengaduan</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nomor Pengaduan</td>
                                    <td width="5%">:</td>
                                    <td><strong>{{ $pengaduan->nomor_pengaduan }}</strong></td>
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
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Status</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge {{ $pengaduan->status_badge }}">
                                            {{ $pengaduan->status }}
                                        </span>
                                    </td>
                                </tr>
                                @if($pengaduan->tanggal_tanggapan)
                                <tr>
                                    <td class="text-muted">Tanggal Tanggapan</td>
                                    <td>:</td>
                                    <td>{{ $pengaduan->tanggal_tanggapan->format('d F Y H:i') }} WIB</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td>{{ $pengaduan->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Judul Pengaduan</h5>
                    <div class="mb-4">
                        <p class="lead mb-0">{{ $pengaduan->judul }}</p>
                    </div>

                    <!-- Deskripsi -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Deskripsi</h5>
                    <div class="mb-4">
                        <p class="text-muted mb-0" style="white-space: pre-line; line-height: 1.8;">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    <!-- Lampiran -->
                    @if($pengaduan->lampiran)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Lampiran</h5>
                    <div class="mb-4">
                        @php
                            $extension = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" 
                             alt="Lampiran" 
                             class="img-fluid rounded mb-2" 
                             style="max-height: 400px; cursor: pointer;"
                             onclick="window.open(this.src, '_blank')">
                        <p class="text-muted text-sm">Klik gambar untuk memperbesar</p>
                        @else
                        <div class="alert alert-info">
                            <i class="ti ti-file-text f-20 me-2"></i>
                            <strong>File PDF:</strong> {{ basename($pengaduan->lampiran) }}
                        </div>
                        @endif
                        
                        <a href="{{ route('pengaduan.download-lampiran', $pengaduan->id) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-download"></i> Download Lampiran
                        </a>
                    </div>
                    @endif

                    <!-- Tanggapan Admin -->
                    @if($pengaduan->tanggapan_admin)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Tanggapan dari Admin</h5>
                    <div class="alert alert-success mb-4">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-message-circle f-24 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="alert-heading mb-2">Tanggapan:</h6>
                                <p class="mb-0" style="white-space: pre-line; line-height: 1.8;">{{ $pengaduan->tanggapan_admin }}</p>
                                @if($pengaduan->adminPenanggap)
                                <hr class="my-2">
                                <small class="text-muted">
                                    <strong>Ditanggapi oleh:</strong> {{ $pengaduan->adminPenanggap->name }}<br>
                                    <strong>Tanggal:</strong> {{ $pengaduan->tanggal_tanggapan->format('d F Y H:i') }} WIB
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <i class="ti ti-clock me-2"></i>
                        <strong>Pengaduan Anda sedang menunggu tanggapan dari admin.</strong>
                        <p class="mb-0 mt-2">Kami akan segera menindaklanjuti pengaduan Anda. Terima kasih atas kesabaran Anda.</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    @if($pengaduan->status === 'Menunggu')
                    <div class="mt-4 border-top pt-3">
                        <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengaduan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i> Batalkan Pengaduan
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
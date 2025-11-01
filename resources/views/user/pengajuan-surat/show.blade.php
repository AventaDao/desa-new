@extends('layouts.dashboard')
@section('title', 'Detail Pengajuan Surat')

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
                    <h5>Detail Pengajuan Surat</h5>
                    <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge {{ $pengajuanSurat->status_badge }} fs-6 px-3 py-2">
                            <i class="ti ti-file-check me-1"></i> Status: {{ $pengajuanSurat->status }}
                        </span>
                    </div>

                    <!-- Data Pengajuan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengajuan</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nomor Pengajuan</td>
                                    <td width="5%">:</td>
                                    <td><strong>{{ $pengajuanSurat->nomor_pengajuan }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Surat</td>
                                    <td>:</td>
                                    <td><strong>{{ $pengajuanSurat->jenis_surat }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->created_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Status</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge {{ $pengajuanSurat->status_badge }}">
                                            {{ $pengajuanSurat->status }}
                                        </span>
                                    </td>
                                </tr>
                                @if($pengajuanSurat->tanggal_selesai)
                                <tr>
                                    <td class="text-muted">Tanggal Selesai</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->tanggal_selesai->format('d F Y H:i') }} WIB</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Keperluan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Keperluan</h5>
                    <div class="mb-4">
                        <p class="text-muted">{{ $pengajuanSurat->keperluan }}</p>
                    </div>

                    <!-- Keterangan Tambahan -->
                    @if($pengajuanSurat->keterangan_tambahan)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Keterangan Tambahan</h5>
                    <div class="mb-4">
                        <p class="text-muted">{{ $pengajuanSurat->keterangan_tambahan }}</p>
                    </div>
                    @endif

                    <!-- Surat Pengantar RW -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Surat Pengantar RW</h5>
                    <div class="mb-4">
                        <a href="{{ route('pengajuan-surat.download-pengantar', $pengajuanSurat->id) }}" 
                           class="btn btn-outline-primary">
                            <i class="ti ti-download"></i> Download Surat Pengantar RW
                        </a>
                    </div>

                    <!-- Catatan Admin -->
                    @if($pengajuanSurat->catatan_admin)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Catatan dari Admin</h5>
                    <div class="alert alert-info mb-4">
                        <i class="ti ti-info-circle me-2"></i>
                        {{ $pengajuanSurat->catatan_admin }}
                    </div>
                    @endif

                    <!-- Surat Jadi -->
                    @if($pengajuanSurat->file_surat_jadi)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Surat Jadi</h5>
                    <div class="alert alert-success d-flex align-items-center mb-4">
                        <i class="ti ti-circle-check f-24 me-3"></i>
                        <div class="flex-grow-1">
                            <strong>Surat Anda sudah selesai!</strong>
                            <p class="mb-0">Silakan download surat jadi melalui tombol di bawah ini.</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('pengajuan-surat.download-surat-jadi', $pengajuanSurat->id) }}" 
                           class="btn btn-success">
                            <i class="ti ti-download"></i> Download Surat Jadi
                        </a>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    @if($pengajuanSurat->status === 'Menunggu')
                    <div class="mt-4 border-top pt-3">
                        <form action="{{ route('pengajuan-surat.destroy', $pengajuanSurat->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i> Batalkan Pengajuan
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
@extends('layouts.dashboard')
@section('title', 'Kelola Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelola Pengajuan Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kelola Pengajuan Surat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ti ti-clock f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Menunggu</h6>
                            <p class="text-muted mb-0">
                                <strong>{{ $pengajuans->where('status', 'Menunggu')->count() }}</strong> pengajuan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-info">
                                <i class="ti ti-settings f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Diproses</h6>
                            <p class="text-muted mb-0">
                                <strong>{{ $pengajuans->where('status', 'Diproses')->count() }}</strong> pengajuan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-success">
                                <i class="ti ti-circle-check f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Selesai</h6>
                            <p class="text-muted mb-0">
                                <strong>{{ $pengajuans->where('status', 'Selesai')->count() }}</strong> pengajuan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-danger">
                                <i class="ti ti-x f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Ditolak</h6>
                            <p class="text-muted mb-0">
                                <strong>{{ $pengajuans->where('status', 'Ditolak')->count() }}</strong> pengajuan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Pengajuan Surat Warga</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pengajuan</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengajuans as $key => $pengajuan)
                                <tr>
                                    <td>{{ $pengajuans->firstItem() + $key }}</td>
                                    <td><strong>{{ $pengajuan->nomor_pengajuan }}</strong></td>
                                    <td>{{ $pengajuan->user->name }}</td>
                                    <td>{{ $pengajuan->jenis_surat }}</td>
                                    <td>{{ $pengajuan->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $pengajuan->status_badge }}">
                                            {{ $pengajuan->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pengajuan-surat.show', $pengajuan->id) }}" 
                                           class="btn btn-sm btn-info" title="Detail & Proses">
                                            <i class="ti ti-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-file-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada pengajuan surat</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $pengajuans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
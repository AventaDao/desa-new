@extends('layouts.dashboard')
@section('title', 'Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengajuan Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengajuan Surat Desa</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$is_verified_user)
        @include('component.verif-content')
    @else
    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Info Card -->
            <div class="card bg-light-primary border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-info-circle f-28 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-2">Syarat Pengajuan Surat</h5>
                            <p class="mb-0 text-muted">
                                Setiap pengajuan surat <strong>wajib melampirkan Surat Pengantar dari RW</strong>. 
                                Pastikan file dalam format PDF, JPG, JPEG, atau PNG dengan ukuran maksimal 2MB.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Pengajuan Surat</h5>
                    <a href="{{ route('pengajuan-surat.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Ajukan Surat Baru
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pengajuan</th>
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
                                    <td>{{ $pengajuan->jenis_surat }}</td>
                                    <td>{{ $pengajuan->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $pengajuan->status_badge }}">
                                            {{ $pengajuan->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pengajuan-surat.show', $pengajuan->id) }}" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            
                                            @if($pengajuan->file_surat_jadi)
                                            <a href="{{ route('pengajuan-surat.download-surat-jadi', $pengajuan->id) }}" 
                                               class="btn btn-sm btn-success" title="Download Surat">
                                                <i class="ti ti-download"></i>
                                            </a>
                                            @endif

                                            @if($pengajuan->status === 'Menunggu')
                                            <form action="{{ route('pengajuan-surat.destroy', $pengajuan->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-file-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada pengajuan surat</p>
                                        <a href="{{ route('pengajuan-surat.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus"></i> Buat Pengajuan
                                        </a>
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
    @endif
</div>
@endsection
@extends('layouts.dashboard')
@section('title', 'Pengaduan Saya')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengaduan Saya</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengaduan Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Info Card -->
            <div class="card bg-light-info border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-info-circle f-28 text-info me-3"></i>
                        <div>
                            <h5 class="mb-2">Informasi Pengaduan</h5>
                            <p class="mb-0 text-muted">
                                Anda dapat melaporkan kendala sistem, meminta bantuan, atau melaporkan kejadian lapangan melalui fitur ini. 
                                Tim kami akan menanggapi pengaduan Anda secepatnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Pengaduan</h5>
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Buat Pengaduan Baru
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
                                    <th>Nomor Pengaduan</th>
                                    <th>Kategori</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduans as $key => $pengaduan)
                                <tr>
                                    <td>{{ $pengaduans->firstItem() + $key }}</td>
                                    <td><strong>{{ $pengaduan->nomor_pengaduan }}</strong></td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="ti {{ $pengaduan->kategori_icon }} me-1"></i>
                                            {{ Str::limit($pengaduan->kategori, 20) }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($pengaduan->judul, 40) }}</td>
                                    <td>{{ $pengaduan->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $pengaduan->status_badge }}">
                                            {{ $pengaduan->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pengaduan.show', $pengaduan->id) }}" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            @if($pengaduan->status === 'Menunggu')
                                            <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"
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
                                    <td colspan="7" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-message-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada pengaduan</p>
                                        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus"></i> Buat Pengaduan
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $pengaduans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.dashboard')
@section('title', 'Kelola Berita Desa')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelola Berita Desa</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kelola Berita Desa</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Berita Desa</h5>
                    <a href="{{ route('berita.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Berita
                    </a>
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
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Tanggal Publikasi</th>
                                    <th>Status</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beritas as $key => $berita)
                                <tr>
                                    <td>{{ $beritas->firstItem() + $key }}</td>
                                    <td>
                                        @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                             alt="{{ $berita->judul }}" 
                                             class="img-fluid rounded" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="ti ti-photo f-24 text-muted"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ Str::limit($berita->judul, 50) }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($berita->isi, 80) }}</small>
                                    </td>
                                    <td>{{ $berita->tanggal_publikasi->format('d M Y') }}</td>
                                    <td>
                                        @if($berita->status === 'publish')
                                        <span class="badge bg-success">Publish</span>
                                        @else
                                        <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $berita->user->name }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('berita.show', $berita->id) }}" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ route('berita.edit', $berita->id) }}" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('berita.destroy', $berita->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-news-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada berita</p>
                                        <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus"></i> Tambah Berita
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $beritas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
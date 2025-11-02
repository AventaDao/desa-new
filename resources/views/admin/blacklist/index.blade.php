@extends('layouts.dashboard')
@section('title', 'Kelola Blacklist User')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelola Blacklist</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kelola Blacklist User</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Info Card -->
            <div class="card bg-light-warning border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-alert-triangle f-28 text-warning me-3"></i>
                        <div>
                            <h5 class="mb-2">Perhatian</h5>
                            <p class="mb-0 text-muted">
                                User yang di-blacklist akan otomatis logout dan tidak dapat login kembali hingga masa blacklist berakhir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar User Blacklist</h5>
                    <a href="{{ route('admin.blacklist.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Blacklist
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error') || $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') ?? $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Alasan</th>
                                    <th>Tgl Blacklist</th>
                                    <th>Berakhir Pada</th>
                                    <th>Sisa Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blacklists as $key => $blacklist)
                                <tr>
                                    <td>{{ $blacklists->firstItem() + $key }}</td>
                                    <td><strong>{{ $blacklist->user->name }}</strong></td>
                                    <td>{{ $blacklist->user->email }}</td>
                                    <td>{{ Str::limit($blacklist->reason, 50) }}</td>
                                    <td>{{ $blacklist->blacklisted_at->format('d M Y') }}</td>
                                    <td>{{ $blacklist->expires_at->format('d M Y H:i') }}</td>
                                    <td>
                                        @if($blacklist->isExpired())
                                            <span class="badge bg-secondary">Expired</span>
                                        @else
                                            <span class="badge bg-info">{{ $blacklist->remaining_time }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($blacklist->is_active && !$blacklist->isExpired())
                                            <span class="badge bg-danger">Aktif</span>
                                        @elseif($blacklist->isExpired())
                                            <span class="badge bg-secondary">Expired</span>
                                        @else
                                            <span class="badge bg-success">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.blacklist.edit', $blacklist->id) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            
                                            @if($blacklist->is_active)
                                                <form action="{{ route('admin.blacklist.destroy', $blacklist->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan blacklist ini?')"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-success" title="Nonaktifkan">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                </form>
                                            @elseif(!$blacklist->isExpired())
                                                <form action="{{ route('admin.blacklist.reactivate', $blacklist->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin mengaktifkan kembali blacklist ini?')"
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Aktifkan">
                                                        <i class="ti ti-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-users-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Tidak ada user yang di-blacklist</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $blacklists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
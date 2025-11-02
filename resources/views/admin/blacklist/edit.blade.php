@extends('layouts.dashboard')
@section('title', 'Edit Blacklist User')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blacklist.index') }}">Kelola Blacklist</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit Blacklist</li>
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
                    <h5>Form Edit Blacklist User</h5>
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

                    <!-- User Info -->
                    <div class="alert alert-info mb-4">
                        <h5 class="mb-2">Informasi User</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Nama:</strong> {{ $blacklist->user->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $blacklist->user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Tgl Blacklist:</strong> {{ $blacklist->blacklisted_at->format('d F Y H:i') }}</p>
                                <p class="mb-1"><strong>Status:</strong> 
                                    @if($blacklist->is_active && !$blacklist->isExpired())
                                        <span class="badge bg-danger">Aktif</span>
                                    @elseif($blacklist->isExpired())
                                        <span class="badge bg-secondary">Expired</span>
                                    @else
                                        <span class="badge bg-success">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.blacklist.update', $blacklist->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alasan Blacklist <span class="text-danger">*</span></label>
                                <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" 
                                          rows="4" required placeholder="Jelaskan alasan kenapa user ini di-blacklist...">{{ old('reason', $blacklist->reason) }}</textarea>
                                @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jelaskan secara detail alasan blacklist</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Durasi Blacklist (Hari) <span class="text-danger">*</span></label>
                                <input type="number" name="duration_days" 
                                       class="form-control @error('duration_days') is-invalid @enderror" 
                                       value="{{ old('duration_days', now()->diffInDays($blacklist->expires_at)) }}" 
                                       min="1" max="365" required>
                                @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Saat ini tersisa: <strong>{{ $blacklist->remaining_time }}</strong> 
                                    (berakhir pada {{ $blacklist->expires_at->format('d F Y H:i') }})
                                </small>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                            <i class="ti ti-alert-triangle f-24 me-3"></i>
                            <div>
                                <strong>Perhatian:</strong> Perubahan durasi akan menghitung ulang waktu berakhir blacklist dari sekarang.
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Update Blacklist
                            </button>
                            <a href="{{ route('admin.blacklist.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.dashboard')
@section('title', 'Tambah Blacklist User')

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
                        <li class="breadcrumb-item" aria-current="page">Tambah Blacklist</li>
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
                    <h5>Form Tambah Blacklist User</h5>
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

                    <form action="{{ route('admin.blacklist.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pilih User <span class="text-danger">*</span></label>
                                <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Pilih user yang akan di-blacklist</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alasan Blacklist <span class="text-danger">*</span></label>
                                <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" 
                                          rows="4" required placeholder="Jelaskan alasan kenapa user ini di-blacklist...">{{ old('reason') }}</textarea>
                                @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jelaskan secara detail alasan blacklist</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Durasi Blacklist (Hari) <span class="text-danger">*</span></label>
                                <input type="number" name="duration_days" 
                                       class="form-control @error('duration_days') is-invalid @enderror" 
                                       value="{{ old('duration_days', 7) }}" 
                                       min="1" max="365" required>
                                @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Tentukan berapa hari user akan di-blacklist (1-365 hari)</small>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                            <i class="ti ti-alert-triangle f-24 me-3"></i>
                            <div>
                                <strong>Perhatian:</strong> User yang di-blacklist akan otomatis logout dan tidak dapat login kembali hingga masa blacklist berakhir. Pastikan keputusan ini sudah dipertimbangkan dengan matang.
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-ban"></i> Blacklist User
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
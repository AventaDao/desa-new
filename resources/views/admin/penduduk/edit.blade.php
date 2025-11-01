@extends('layouts.dashboard')
@section('title', 'Edit Data Penduduk')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('penduduk.index') }}">Data Penduduk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit Data</li>
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
                    <h5>Form Edit Data Penduduk</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Data Identitas -->
                        <h5 class="mb-3 text-primary">Data Identitas</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                                       value="{{ old('nik', $penduduk->nik) }}" maxlength="16" required>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                       value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required>
                                @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                       value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required>
                                @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                       value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d')) }}" required>
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <h5 class="mb-3 text-primary mt-4">Data Alamat</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                          rows="3" required>{{ old('alamat', $penduduk->alamat) }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">RT <span class="text-danger">*</span></label>
                                <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" 
                                       value="{{ old('rt', $penduduk->rt) }}" maxlength="3" required>
                                @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">RW <span class="text-danger">*</span></label>
                                <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" 
                                       value="{{ old('rw', $penduduk->rw) }}" maxlength="3" required>
                                @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Desa <span class="text-danger">*</span></label>
                                <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" 
                                       value="{{ old('desa', $penduduk->desa) }}" required>
                                @error('desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" 
                                       value="{{ old('kecamatan', $penduduk->kecamatan) }}" required>
                                @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kabupaten <span class="text-danger">*</span></label>
                                <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" 
                                       value="{{ old('kabupaten', $penduduk->kabupaten) }}" required>
                                @error('kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" 
                                       value="{{ old('provinsi', $penduduk->provinsi) }}" required>
                                @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" 
                                       value="{{ old('kode_pos', $penduduk->kode_pos) }}" maxlength="5" required>
                                @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Lainnya -->
                        <h5 class="mb-3 text-primary mt-4">Data Lainnya</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Agama <span class="text-danger">*</span></label>
                                <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $penduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $penduduk->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $penduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $penduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $penduduk->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $penduduk->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                       value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" required>
                                @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                                <select name="kewarganegaraan" class="form-select @error('kewarganegaraan') is-invalid @enderror" required>
                                    <option value="WNI" {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI</option>
                                    <option value="WNA" {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                                </select>
                                @error('kewarganegaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" 
                                       value="{{ old('pendidikan_terakhir', $penduduk->pendidikan_terakhir) }}">
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                                       value="{{ old('no_telepon', $penduduk->no_telepon) }}" maxlength="15">
                                @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Status Hidup <span class="text-danger">*</span></label>
                                <select name="status_hidup" class="form-select @error('status_hidup') is-invalid @enderror" id="statusHidup" required>
                                    <option value="Hidup" {{ old('status_hidup', $penduduk->status_hidup) == 'Hidup' ? 'selected' : '' }}>Hidup</option>
                                    <option value="Meninggal" {{ old('status_hidup', $penduduk->status_hidup) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                                </select>
                                @error('status_hidup')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row" id="tanggalMeninggalField" style="display: {{ old('status_hidup', $penduduk->status_hidup) == 'Meninggal' ? 'block' : 'none' }}">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tanggal Meninggal</label>
                                <input type="date" name="tanggal_meninggal" class="form-control @error('tanggal_meninggal') is-invalid @enderror" 
                                       value="{{ old('tanggal_meninggal', $penduduk->tanggal_meninggal ? $penduduk->tanggal_meninggal->format('Y-m-d') : '') }}">
                                @error('tanggal_meninggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Keluarga -->
                        <h5 class="mb-3 text-primary mt-4">Data Keluarga</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" 
                                       value="{{ old('nama_ayah', $penduduk->nama_ayah) }}">
                                @error('nama_ayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" 
                                       value="{{ old('nama_ibu', $penduduk->nama_ibu) }}">
                                @error('nama_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Update Data
                            </button>
                            <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('statusHidup').addEventListener('change', function() {
        const tanggalMeninggalField = document.getElementById('tanggalMeninggalField');
        if (this.value === 'Meninggal') {
            tanggalMeninggalField.style.display = 'block';
        } else {
            tanggalMeninggalField.style.display = 'none';
        }
    });
</script>
@endsection
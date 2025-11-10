@extends('layouts.auth')

@section('title', 'Register Page')

@section('content')
    <div class="card my-5">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Daftar Akun</b></h3>
                    <a href="/login" class="link-primary">Already have an account?</a>
                </div>
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

                <!-- Data Identitas -->
                <h5 class="mb-3 text-primary">Data Identitas</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                               value="{{ old('nik') }}" maxlength="16" required placeholder="16 digit">
                        @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                               value="{{ old('nama_lengkap') }}" required>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                               value="{{ old('tempat_lahir') }}" required>
                        @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                               value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Data Alamat -->
                <h5 class="mb-3 text-primary mt-3">Data Alamat</h5>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                  rows="2" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">RT <span class="text-danger">*</span></label>
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" 
                               value="{{ old('rt') }}" maxlength="3" required>
                        @error('rt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">RW <span class="text-danger">*</span></label>
                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" 
                               value="{{ old('rw') }}" maxlength="3" required>
                        @error('rw')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Desa <span class="text-danger">*</span></label>
                        <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" 
                               value="{{ old('desa', 'Candi') }}" required>
                        @error('desa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" 
                               value="{{ old('kecamatan', 'Sidoarjo') }}" required>
                        @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kabupaten <span class="text-danger">*</span></label>
                        <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" 
                               value="{{ old('kabupaten', 'Sidoarjo') }}" required>
                        @error('kabupaten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                        <input type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" 
                               value="{{ old('provinsi', 'Jawa Timur') }}" required>
                        @error('provinsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                        <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" 
                               value="{{ old('kode_pos') }}" maxlength="5" required>
                        @error('kode_pos')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Data Lainnya -->
                <h5 class="mb-3 text-primary mt-3">Data Lainnya</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class ="form-select @error('agama') is-invalid @enderror" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                        <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror" required>
                            <option value="">Pilih Status</option>
                            <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                            <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                        @error('status_perkawinan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" 
                               value="{{ old('pekerjaan') }}" required>
                        @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                        <select name="kewarganegaraan" class="form-select @error('kewarganegaraan') is-invalid @enderror" required>
                            <option value="WNI" {{ old('kewarganegaraan', 'WNI') == 'WNI' ? 'selected' : '' }}>WNI</option>
                            <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                        </select>
                        @error('kewarganegaraan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" 
                               value="{{ old('pendidikan_terakhir') }}">
                        @error('pendidikan_terakhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                               value="{{ old('no_telepon') }}" maxlength="15">
                        @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Data Keluarga -->
                <h5 class="mb-3 text-primary mt-3">Data Keluarga</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" 
                               value="{{ old('nama_ayah') }}">
                        @error('nama_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" 
                               value="{{ old('nama_ibu') }}">
                        @error('nama_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Data Akun -->
                <h5 class="mb-3 text-primary mt-3">Data Akun</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Email (Opsional)</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" placeholder="email@contoh.com">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Email diperlukan jika ingin verifikasi akun</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                               required placeholder="Minimal 6 karakter">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" 
                               required placeholder="Ulangi password">
                    </div>
                </div>

                <p class="mt-4 text-sm text-muted">
                    Dengan mendaftar, Anda setuju dengan <a href="#" class="text-primary">Syarat & Ketentuan</a> 
                    dan <a href="#" class="text-primary">Kebijakan Privasi</a> kami.
                </p>
                
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                </div>
                
                <div class="saprator mt-3">
                    <span>Atau daftar dengan</span>
                </div>
                @include('auth.sso')
            </div>
        </form>
    </div>
@endsection
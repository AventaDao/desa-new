@extends('layouts.dashboard')
@section('title', 'Detail Data Penduduk')

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
                        <li class="breadcrumb-item" aria-current="page">Detail Data</li>
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
                    <h5>Detail Data Penduduk</h5>
                    <div>
                        <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="btn btn-warning btn-sm">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        <a href="{{ route('penduduk.index') }}" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Data Identitas -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Identitas</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">NIK</td>
                                    <td width="5%">:</td>
                                    <td><strong>{{ $penduduk->nik }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nama Lengkap</td>
                                    <td>:</td>
                                    <td><strong>{{ $penduduk->nama_lengkap }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->jenis_kelamin }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Tempat Lahir</td>
                                    <td width="5%">:</td>
                                    <td>{{ $penduduk->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->tanggal_lahir->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Umur</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->umur }} Tahun</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Alamat -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Alamat</h5>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="20%" class="text-muted">Alamat</td>
                                    <td width="2%">:</td>
                                    <td>{{ $penduduk->alamat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">RT / RW</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->rt }} / {{ $penduduk->rw }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Desa / Kelurahan</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->desa }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kecamatan</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kabupaten / Kota</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->kabupaten }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Provinsi</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->provinsi }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kode Pos</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->kode_pos }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Lainnya -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Lainnya</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Agama</td>
                                    <td width="5%">:</td>
                                    <td>{{ $penduduk->agama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status Perkawinan</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->status_perkawinan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Pekerjaan</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kewarganegaraan</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->kewarganegaraan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Pendidikan Terakhir</td>
                                    <td width="5%">:</td>
                                    <td>{{ $penduduk->pendidikan_terakhir ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">No. Telepon</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->no_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td>:</td>
                                    <td>
                                        @if($penduduk->status_hidup == 'Hidup')
                                            <span class="badge bg-success">Hidup</span>
                                        @else
                                            <span class="badge bg-danger">Meninggal</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($penduduk->status_hidup == 'Meninggal' && $penduduk->tanggal_meninggal)
                                <tr>
                                    <td class="text-muted">Tanggal Meninggal</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->tanggal_meninggal->format('d F Y') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Data Keluarga -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Keluarga</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nama Ayah</td>
                                    <td width="5%">:</td>
                                    <td>{{ $penduduk->nama_ayah ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nama Ibu</td>
                                    <td width="5%">:</td>
                                    <td>{{ $penduduk->nama_ibu ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Sistem -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Sistem</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="20%" class="text-muted">Data Dibuat</td>
                                    <td width="2%">:</td>
                                    <td>{{ $penduduk->created_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td>{{ $penduduk->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
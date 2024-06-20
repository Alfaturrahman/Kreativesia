@extends('layout.html')

@push('css')
    <link rel="stylesheet" href="{{ asset('web-assets/css/pasien.css') }}">
@endpush

@section('content')
    <div class="min-vh-100">
        <div class="container">
            <h2 class="text-uppercase mx-auto heading" data-aos="fade-down" data-aos-duration="500">pasien <span class="ms-1">saya</span></h2>
            <div class="row border-dark border-bottom mb-3">
                <div class="col-12" data-aos="fade-right" data-aos-duration="500">
                    <p class="fs-5 hard-color"><i class="fa-solid fa-circle text-primary"></i> Menunggu: {{ $dataPasienMenunggu->count() }} </p>
                </div>
                @forelse ($dataPasienMenunggu as $index => $data )
                    <div class="col-md-6 col-lg-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="{{ $data->mahasiswa->foto ? asset('storage/'.$data->mahasiswa->foto) : asset('web-assets/image/consult.png') }}" class="img-fluid rounded-start object-fit-cover" alt="...">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <p class="card-title blockquote fw-semibold">{{ $data->mahasiswa->nama_mahasiswa }}</p>
                                        <p class="text-body-secondary blockquote-footer fst-italic">{{ $data->mahasiswa->nim }}</p>
                                        <p class="card-text">
                                            <span class="fw-medium text-capitalize">keluhan</span> : {{ $data->keluhan_umum }}
                                        </p>
                                        <p class="card-text">
                                            <span class="fw-medium text-capitalize">jenis kelamin</span> : {{ $data->mahasiswa->jenis_kelamin }}
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn bg-hard text-light me-2" data-bs-toggle="modal" data-bs-target="#DetailModal{{ $data->id_janji_temu }}">
                                                <i class="fa-solid fa-circle-info"></i> Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-duration="500">
                        <img src="{{ asset('web-assets/image/empty.png') }}" alt="" width="auto" height="300">
                        <div class="text-content">
                            <h3 class="text-capitalize text-center hard-color">Tidak ada data untuk ditampilkan!</h3>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="row border-dark border-bottom mb-3">
                <div class="col-12" data-aos="fade-right" data-aos-duration="500">
                    <p class="fs-5 hard-color"><i class="fa-solid fa-circle text-success"></i> diterima: {{ $dataPasienDiterima->count() }} </p>
                </div>
                @forelse ($dataPasienDiterima as $index => $data )
                    <div class="col-md-6 col-lg-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="{{ $data->mahasiswa->foto ? asset('storage/'.$data->mahasiswa->foto) : asset('web-assets/image/consult.png') }}" class="img-fluid rounded-start object-fit-cover" alt="...">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <p class="card-title blockquote fw-semibold">{{ $data->mahasiswa->nama_mahasiswa }}</p>
                                        <p class="text-body-secondary blockquote-footer fst-italic">{{ $data->mahasiswa->nim }}</p>
                                        <p class="card-text">
                                            <span class="fw-medium text-capitalize">keluhan</span> : {{ $data->keluhan_umum }}
                                        </p>
                                        <p class="card-text">
                                            <span class="fw-medium text-capitalize">jenis kelamin</span> : {{ $data->mahasiswa->jenis_kelamin }}
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn bg-hard text-light me-2" data-bs-toggle="modal" data-bs-target="#DetailModal{{ $data->id_janji_temu }}">
                                                <i class="fa-solid fa-circle-info"></i> Detail
                                            </button>
                                            <form action="{{ route('pasienUpdateSelesai',['id_janji_temu' => $data->id_janji_temu ]) }}" method="POST">
                                                @csrf @method('put')
                                                <button type="submit" class="btn bg-hard text-light me-2">
                                                    <i class="fa-solid fa-circle-check"></i> selesai
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-duration="500">
                        <img src="{{ asset('web-assets/image/empty.png') }}" alt="" width="auto" height="300">
                        <div class="text-content">
                            <h3 class="text-capitalize text-center hard-color">Tidak ada data untuk ditampilkan!</h3>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12" data-aos="fade-right" data-aos-duration="500">
                    <p class="fs-5 hard-color"><i class="fa-solid fa-circle text-secondary"></i> selesai: {{ $dataPasienSelesai->count() }} </p>
                </div>
                @forelse ($dataPasienSelesai as $index => $data )
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="{{ $data->mahasiswa->foto ? asset('storage/'.$data->mahasiswa->foto) : asset('web-assets/image/consult.png') }}" class="img-fluid rounded-start object-fit-cover" alt="...">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <p class="card-title blockquote fw-semibold">{{ $data->mahasiswa->nama_mahasiswa }}</p>
                                        <p class="text-body-secondary blockquote-footer fst-italic">{{ $data->mahasiswa->nim }}</p>
                                        <p class="card-text">
                                            <span class="fw-medium text-capitalize">keluhan</span> : {{ $data->keluhan_umum }}
                                        </p>
                                        <p class="card-text">
                                            <span class="fw-medium text-capitalize">jenis kelamin</span> : {{ $data->mahasiswa->jenis_kelamin }}
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn bg-hard text-light me-2" data-bs-toggle="modal" data-bs-target="#DetailModal{{ $data->id_janji_temu }}">
                                                <i class="fa-solid fa-circle-info"></i> Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-duration="500">
                        <img src="{{ asset('web-assets/image/empty.png') }}" alt="" width="auto" height="300">
                        <div class="text-content">
                            <h3 class="text-capitalize text-center hard-color">Tidak ada data untuk ditampilkan!</h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal -->
@foreach ($dataPasien as $index => $data )
    <div class="modal fade" id="DetailModal{{ $data->id_janji_temu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $data->mahasiswa->nama_mahasiswa }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <img src="{{ $data->mahasiswa->foto ? asset('storage/'.$data->mahasiswa->foto) : asset('web-assets/image/consult.png') }}" alt="" class="rounded-circle object-fit-cover mb-3" height="250" width="250">
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover border table-bordered align-middle">
                                        <tr>
                                            <th class="text-capitalize">Id janji temu</th>
                                            <td>{{ $data->id_janji_temu }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">nim</th>
                                            <td>{{ $data->mahasiswa->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">nama</th>
                                            <td>{{ $data->mahasiswa->nama_mahasiswa }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">jenis kelamin</th>
                                            <td>{{ $data->mahasiswa->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">jenis konsultasi</th>
                                            <td>{{ $data->jenis_konsultasi }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">tanggal konsultasi</th>
                                            <td>{{ $data->tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">jam konsultasi</th>
                                            <td>{{ $data->jam }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">keluhan umum</th>
                                            <td>{{ $data->keluhan_umum }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-capitalize">detail masalah</th>
                                            <td>
                                                <p>
                                                    {{ $data->detail_masalah }}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    @if ($data->status == 'menunggu')
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#AturUlangJadwalModal{{ $data->id_janji_temu }}">Atur ulang jadwal</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#TerimaModal{{ $data->id_janji_temu }}">Terima</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="TerimaModal{{ $data->id_janji_temu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terima pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('terimaPasienProcess',['id_janji_temu' => $data->id_janji_temu]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">NIM</label>
                                    <input type="text" class="form-control" value="{{ $data->mahasiswa->nim }}" readonly>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $data->mahasiswa->nama_mahasiswa }}" readonly>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="4" placeholder="Berikan link meet jika jenis pengajuan online">{{ old('keterangan') }}</textarea>
                                    <p class="text-small text-danger">*Abaikan jika jenis pengajuan offline</p>
                                    @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Terima</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AturUlangJadwalModal{{ $data->id_janji_temu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atur ulang jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rescheduleProcess',['id_janji_temu' => $data->id_janji_temu]) }}" method="POST">
                    @csrf @method('put')
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">NIM</label>
                                    <input type="text" class="form-control" value="{{ $data->mahasiswa->nim }}" readonly>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $data->mahasiswa->nama_mahasiswa }}" readonly>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" required>
                                    @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Jam</label>
                                    <input type="time" name="jam" class="form-control @error('tanggal') is-invalid @enderror" required>
                                    @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="4" placeholder="Berikan keterangan mengapa anda mengatur ulang jadwal" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ubah Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection

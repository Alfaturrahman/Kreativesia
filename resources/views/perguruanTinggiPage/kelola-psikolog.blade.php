@extends('layout.html')

@section('content')
<div class="min-vh-100 section-warm-bg-color">
    <div class="container">
        <h2 class="text-capitalize py-3 hard-color">Kelola Akun Psikolog</h2>
        <div class="d-flex flex-wrap">
            <button class="btn bg-hard text-white ms-auto mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fa-solid fa-circle-plus"></i> Buat akun
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover border table-bordered text-center align-middle">
                <thead class="text-capitalize">
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nomor STR</th>
                        <th scope="col">nama</th>
                        <th scope="col">alumni</th>
                        <th scope="col">email</th>
                        <th scope="col">nomor telepon</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPsikolog as $index => $data )
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->akunPsikolog->username }}</td>
                        <td>{{ $data->no_str }}</td>
                        <td>{{ $data->nama_psikolog }}</td>
                        <td>{{ $data->alumni }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->no_telp }}</td>
                        <td>
                            <button class="btn bg-soft text-capitalize" data-bs-toggle="modal" data-bs-target="#editModal{{ $index+1 }}">
                                edit <i class="fa-regular fa-pen-to-square text-light"></i>
                            </button>
                            <button class="btn bg-soft text-capitalize" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $index+1 }}">
                                hapus <i class="fa-solid fa-trash text-light"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%" class="text-center">Tidak Ada Data untuk Ditampilkan!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Akun Psikolog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tambahPsikolog') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" placeholder="masukkan username" value="{{ old('username') }}" required>
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="masukkan password" value="{{ old('password') }}" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nomor STR</label>
                                <input type="text" class="form-control @error('no_str') is-invalid @enderror" name="no_str" placeholder="Nomor STR Psikolog" value="{{ old('no_str') }}" required>
                                @error('no_str')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama_psikolog') is-invalid @enderror" name="nama_psikolog" placeholder="Nama psikolog" value="{{ old('nama_psikolog') }}" required>
                                @error('nama_psikolog')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alumni</label>
                                <input type="text" class="form-control @error('alumni') is-invalid @enderror" name="alumni" placeholder="Asal Universitas Psikolog" value="{{ old('alumni') }}" required>
                                @error('alumni')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email psikolog" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" placeholder="Nomor telepon Mahasiswa" value="{{ old('no_telp') }}" required>
                                @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($dataPsikolog as $index => $data )
<div class="modal fade" id="editModal{{ $index+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editPsikolog',['id_user' => $data->id_user]) }}" method="POST">
                    @csrf @method('put')
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden"  name="old_username"  value="{{ $data->akunPsikolog->username }}">
                            <input type="hidden" name="old_email" value="{{ $data->email }}">
                            <input type="hidden" name="old_no_str" value="{{ $data->no_str }}">
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" placeholder="masukkan username" value="{{ old('username',$data->akunPsikolog->username) }}" required>
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nomor STR</label>
                                <input type="text" class="form-control @error('no_str') is-invalid @enderror" name="no_str" placeholder="Nomor STR Psikolog" value="{{ old('no_str',$data->no_str) }}" required>
                                @error('no_str')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama_psikolog') is-invalid @enderror" name="nama_psikolog" placeholder="Nama psikolog" value="{{ old('nama_psikolog',$data->nama_psikolog) }}" required>
                                @error('nama_psikolog')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alumni</label>
                                <input type="text" class="form-control @error('alumni') is-invalid @enderror" name="alumni" placeholder="Asal Universitas Psikolog" value="{{ old('alumni',$data->alumni) }}" required>
                                @error('alumni')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email psikolog" value="{{ old('email',$data->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" placeholder="Nomor telepon Mahasiswa" value="{{ old('no_telp',$data->no_telp) }}" required>
                                @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusModal{{ $index+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-capitalize">apakah anda yakin ingin menghapus akun dengan username <span class="fw-bold">{{ $data->akunPsikolog->username }}</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('hapusPsikolog',['id_user' => $data->id_user]) }}" method="POST">
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                info: false,
                dom: '<"row"<"col-sm-6 d-flex justify-content-center justify-content-sm-start mb-2 mb-sm-0"l><"col-sm-6 d-flex justify-content-center justify-content-sm-end"f>>rtp',
            });
        });
    </script>
@endpush

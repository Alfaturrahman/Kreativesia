@extends('layout.html')

@section('content')
<div class="min-vh-100 section-warm-bg-color">
    <div class="container">
        <h2 class="text-capitalize hard-color py-3">Kelola Akun mahasiswa</h2>
        <div class="d-flex flex-wrap">
            <button class="btn bg-hard text-white ms-auto mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fa-solid fa-circle-plus"></i> Buat akun
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover border table-bordered align-middle">
                <thead class="text-capitalize">
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">Username</th>
                        <th scope="col">nim</th>
                        <th scope="col">nama</th>
                        <th scope="col">alamat</th>
                        <th scope="col">email</th>
                        <th scope="col">jenis kelamin</th>
                        <th scope="col">Fakultas</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataMahasiswa as $index => $data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->akunMahasiswa->username }}</td>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->nama_mahasiswa }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->jenis_kelamin }}</td>
                        <td>{{ $data->fakultas->fakultas }}</td>
                        <td>
                            <button class="btn bg-soft text-capitalize" data-bs-toggle="modal" data-bs-target="#editModal{{ $index+1 }}">
                                edit <i class="fa-regular fa-pen-to-square text-light"></i>
                            </button>
                            <button class="btn bg-soft text-capitalize" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->nim }}">
                                hapus <i class="fa-solid fa-trash text-light"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%" class="text-center">Tidak Ada Data untuk ditampilkan!</td>
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
                <h5 class="modal-title">Buat Akun Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tambahMahasiswa') }}" method="post">
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
                                <label for="" class="form-label">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" placeholder="nim mahasiswa" value="{{ old('nim') }}" required>
                                @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" placeholder="Nama mahasiswa" value="{{ old('nama_mahasiswa') }}" required>
                                @error('nama_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat Mahasiswa" value="{{ old('alamat') }}" required>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Mahasiswa" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Jenis kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="pria">pria</option>
                                    <option value="wanita">wanita</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">fakultas</label>
                                <select class="form-select @error('fakultas') is-invalid @enderror" name="fakultas" required>
                                    <option value="">Pilih fakultas</option>
                                    @foreach ($dataFakultas as $index => $data)
                                    <option value="{{ $data->id_fakultas }}">{{ $data->fakultas }}</option>
                                    @endforeach
                                </select>
                                @error('fakultas')
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

@foreach ($dataMahasiswa as $index => $data)
    <div class="modal fade" id="editModal{{ $index+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editMahasiswa',['id_user' => $data->id_user]) }}" method="POST">
                        @csrf @method('put')
                        <input type="hidden"  name="old_username"  value="{{ $data->akunMahasiswa->username }}">
                        <input type="hidden" name="old_email" value="{{ $data->email }}">
                        <input type="hidden" name="old_nim" value="{{ $data->nim }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" placeholder="masukkan username" value="{{ old('username',$data->akunMahasiswa->username) }}" required>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NIM</label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" placeholder="nim mahasiswa" value="{{ old('nim',$data->nim) }}" required>
                            @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" placeholder="Nama mahasiswa" value="{{ old('nama_mahasiswa',$data->nama_mahasiswa) }}" required>
                            @error('nama_mahasiswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat Mahasiswa" value="{{ old('alamat',$data->alamat) }}" required>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Mahasiswa" value="{{ old('email',$data->email) }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="pria" @if ($data->jenis_kelamin == 'pria') selected @endif>pria</option>
                                <option value="wanita" @if ($data->jenis_kelamin == 'wanita') selected @endif>wanita</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">fakultas</label>
                            <select class="form-select @error('fakultas') is-invalid @enderror" name="fakultas" required>
                                <option value="">Pilih fakultas</option>
                                @foreach ($dataFakultas as $index => $data1)
                                    <option value="{{ $data1->id_fakultas }}" @if ($data1->id_fakultas == $data->id_fakultas) selected @endif>{{ $data1->fakultas }}</option>
                                @endforeach
                            </select>
                            @error('fakultas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

    <div class="modal fade" id="hapusModal{{ $data->nim }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-capitalize">apakah anda yakin ingin menghapus akun dengan username <span class="fw-bold">{{ $data->akunMahasiswa->username }}</span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('hapusMahasiswa',['id_user' => $data->id_user]) }}" method="post">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-success">hapus</button>
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

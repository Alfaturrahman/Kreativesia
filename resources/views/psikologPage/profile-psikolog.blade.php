@extends('layout.html')

@section('content')
<div class="min-vh-100">
    <div class="d-flex justify-content-center align-items-center header finisher-header" data-aos="fade-up" data-aos-duration="500">
        <img src="{{ $dataProfile->foto ? asset('storage/'.$dataProfile->foto) : 'https://learning-if.polibatam.ac.id/theme/image.php/moove/core/1675225508/u/f2' }}" alt="" class="border rounded-circle object-fit-cover my-3" height="170" width="170">
    </div>
    <div class="container">
        <form action="{{ route('updateProfilePsikolog',['id_user' => $dataProfile->id_user]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('put')
            <div class="row border my-2">
                <div class="col-12 text-center mt-3" data-aos="fade-down" data-aos-duration="500">
                    <h2>Profile</h2>
                </div>
                <div class="col-12 d-flex justify-content-end mb-3" data-aos="fade-left" data-aos-duration="500">
                    <button type="button" class="btn bg-soft" onclick="enableinput()" id="editButton">
                        <i class="fa-solid fa-gear"></i> Edit
                    </button>
                </div>
                <input type="hidden" name="old_no_str" value="{{ $dataProfile->no_str }}">
                <input type="hidden" name="old_email" value="{{ $dataProfile->email }}">
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Nomor STR</label>
                    <input type="text" class="form-control buka @error('no_str') is-invalid @enderror" name="no_str" placeholder="Nomor STR Psikolog" value="{{ old('no_str',$dataProfile->no_str) }}" required readonly disabled>
                    @error('no_str')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Perguruan Tinggi</label>
                    <input type="text" class="form-control @error('kode_pt') is-invalid @enderror" name="kode_pt" value="{{ old('kode_pt',$dataProfile->perguruanTinggi->nama_pt) }}" readonly disabled>
                    @error('kode_pt')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control buka @error('nama_psikolog') is-invalid @enderror" name="nama_psikolog" placeholder="Nama psikolog" value="{{ old('nama_psikolog',$dataProfile->nama_psikolog) }}" required readonly disabled>
                    @error('nama_psikolog')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Alumni</label>
                    <input type="text" class="form-control buka @error('alumni') is-invalid @enderror" name="alumni" placeholder="Asal Universitas Psikolog" value="{{ old('alumni',$dataProfile->alumni) }}" required readonly disabled>
                    @error('alumni')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control buka @error('email') is-invalid @enderror" name="email" placeholder="Email psikolog" value="{{ old('email',$dataProfile->email) }}" required readonly disabled>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control buka @error('no_telp') is-invalid @enderror" name="no_telp" placeholder="Nomor telepon Mahasiswa" value="{{ old('no_telp',$dataProfile->no_telp) }}" required readonly disabled>
                    @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Foto Psikolog</label>
                    <input type="file" name="foto" class="form-control buka @error('foto') is-invalid @enderror" readonly disabled>
                    @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-center mb-3" data-aos="fade-up" data-aos-duration="500">
                    <button type="submit" class="btn bg-soft">Simpan Perubahan</button>
                </div>
            </div>
        </form>
        <form action="{{ route('updateKataSandiPsikolog',['id_user' => $dataProfile->id_user]) }}" method="POST">
            @csrf @method('put')
            <div class="border row my-3">
                <div class="col-12 text-center mt-3" data-aos="fade-down" data-aos-duration="500">
                    <h2 class="hard-color">Ubah Kata Sandi</h2>
                </div>
                <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Kata Sandi Lama</label>
                    <input type="password" name="password_lama" class="form-control buka @error('password_lama') is-invalid @enderror" value="{{ old('password_lama') }}" placeholder="Masukkan password lama" required>
                    @error('password_lama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Kata Sandi Baru</label>
                    <input type="password" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" value="{{ old('password_baru') }}" placeholder="Masukkan password baru" required>
                    @error('password_baru')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <label for="" class="form-label">Ulangi Kata Sandi Baru</label>
                    <input type="password" name="konf_password" class="form-control @error('konf_password') is-invalid @enderror" value="{{ old('konf_password') }}" placeholder="Ulangi password baru" required>
                    @error('konf_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-center mb-3" data-aos="fade-up" data-aos-duration="500">
                    <button type="submit" class="btn bg-soft">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">
        new FinisherHeader({
            "count": 100,
            "size": {
                "min": 2,
                "max": 8,
                "pulse": 0
            },
            "speed": {
                "x": {
                "min": 0,
                "max": 0.4
                },
                "y": {
                "min": 0,
                "max": 0.6
                }
            },
            "colors": {
                "background": "#fff6f6",
                "particles": [
                "#e7c7c6",
                "#c98f8f",
                "#ffc088"
                ]
            },
            "blending": "none",
            "opacity": {
                "center": 1,
                "edge": 0
            },
            "skew": 0,
            "shapes": [
                "c"
            ]
        });
    </script>
@endpush

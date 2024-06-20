@extends('layout.html')

@section('content')
<div class="min-vh-100 section-warm-bg-color">
    <div class="container">
        <h2 class="text-capitalize hard-color py-3">laporan konsultasi</h2>
        <div class="d-flex flex-wrap">
            <button class="btn bg-hard text-white ms-auto mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#BuatLaporanModal">
                <i class="fa-solid fa-circle-plus"></i> Buat Laporan
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover border table-bordered align-middle">
                <thead class="text-capitalize">
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">nim</th>
                        <th scope="col">jenis konsultasi</th>
                        <th scope="col">keluhan</th>
                        <th scope="col">tanggal</th>
                        <th scope="col">Tingkat permasalahan</th>
                        <th scope="col">laporan perguruan tinggi</th>
                        <th scope="col">catatan mahasiswa</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanKonsul as $index => $data )
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->janjiTemu->jenis_konsultasi }}</td>
                        <td>{{ $data->janjiTemu->keluhan_umum }}</td>
                        <td>{{ $data->janjiTemu->tanggal }}</td>
                        <td>
                            <span class="badge @if ($data->tingkat_permasalahan == 'ringan') text-bg-success @elseif ($data->tingkat_permasalahan == 'sedang') text-bg-warning @else text-bg-danger @endif">
                                {{ $data->tingkat_permasalahan }}
                            </span>
                        </td>
                        <td>
                            <p>
                                {{ $data->laporan_perguruan_tinggi }}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $data->catatan_mahasiswa }}
                            </p>
                        </td>
                        <td>
                            <button class="btn bg-soft text-capitalize" data-bs-toggle="modal" data-bs-target="#EditModal{{ $index+1 }}">
                                edit <i class="fa-regular fa-pen-to-square text-light"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%" class="text-center">Tidak ada data untuk ditampilkan!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="BuatLaporanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tambahLaporan') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Id janji temu</label>
                        <select name="id_janji_temu" class="form-control @error('id_janji_temu') is-invalid @enderror" required>
                            <option value="">Pilih id</option>
                            @foreach ($idJanjiTemu as $index => $data )
                                @if (!$laporanKonsul->contains('id_janji_temu', $data->id_janji_temu))
                                    <option value="{{ $data->id_janji_temu }}">{{ $data->id_janji_temu }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('id_janji_temu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tingkat permasalahan</label>
                        <select name="tingkat_permasalahan" class="form-control @error('tingkat_permasalahan') is-invalid @enderror" required>
                            <option value="">Pilih Tingkat permasalahan</option>
                            <option value="berat">Berat</option>
                            <option value="sedang">Sedang</option>
                            <option value="ringan">Ringan</option>
                        </select>
                        @error('tingkat_permasalahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Catatan Mahasiswa</label>
                        <textarea name="catatan_mahasiswa" class="form-control @error('catatan_mahasiswa') is-invalid @enderror" rows="4" placeholder="Catatan anda untuk mahasiswa" required>{{ old('catatan_mahasiswa') }}</textarea>
                        @error('catatan-mahasiswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">laporan perguruan tinggi</label>
                        <textarea name="laporan_perguruan_tinggi" class="form-control @error('laporan_perguruan_tinggi') is-invalid @enderror" rows="4" placeholder="Laporan untuk perguruan tinggi" required>{{ old('laporan_perguruan_tinggi') }}</textarea>
                    </div>
                    @error('laporan_perguruan_tinggi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($laporanKonsul as $index => $data )
    <div class="modal fade" id="EditModal{{ $index+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">edit Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('editLaporan',['id_laporan_konsultasi' => $data->id_laporan_konsultasi]) }}" method="POST">
                    @csrf @method('put')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Tingkat permasalahan</label>
                            <select name="tingkat_permasalahan" class="form-control @error('tingkat_permasalahan') is-invalid @enderror" required>
                                <option value="">Pilih Tingkat permasalahan</option>
                                <option value="berat" @if ($data->tingkat_permasalahan == 'berat') selected @endif>Berat</option>
                                <option value="sedang" @if ($data->tingkat_permasalahan == 'sedang') selected @endif>Sedang</option>
                                <option value="ringan" @if ($data->tingkat_permasalahan == 'ringan') selected @endif>Ringan</option>
                            </select>
                            @error('tingkat_permasalahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Catatan Mahasiswa</label>
                            <textarea name="catatan_mahasiswa" class="form-control @error('catatan_mahasiswa') is-invalid @enderror" rows="4" placeholder="Catatan anda untuk mahasiswa" required>{{ old('catatan_mahasiswa',$data->catatan_mahasiswa) }}</textarea>
                            @error('catatan-mahasiswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">laporan perguruan tinggi</label>
                            <textarea name="laporan_perguruan_tinggi" class="form-control @error('laporan_perguruan_tinggi') is-invalid @enderror" rows="4" placeholder="Laporan untuk perguruan tinggi" required>{{old('laporan_perguruan_tinggi',$data->laporan_perguruan_tinggi)}}</textarea>
                        </div>
                        @error('laporan_perguruan_tinggi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
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
                dom: '<"d-flex flex-wrap mb-2"B><"row"<"col-sm-6 d-flex justify-content-center justify-content-sm-start mb-2 mb-sm-0"l><"col-sm-6 d-flex justify-content-center justify-content-sm-end"f>>rtp',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa-solid fa-copy"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa-solid fa-file-excel"></i> Excel',
                        titleAttr: 'Excel',
                        filename: 'Laporan_Konsultasi',
                        title: 'Laporan Konsultasi Mahasiswa'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                        titleAttr: 'PDF',
                        filename: 'Laporan_Konsultasi',
                        title: 'Laporan Konsultasi Mahasiswa'
                    }
                ]
            });
        });
    </script>
@endpush

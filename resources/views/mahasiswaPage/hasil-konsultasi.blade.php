@extends('layout.html')

@section('content')
<div class="min-vh-100 section-warm-bg-color">
    <div class="container">
        <h2 class="text-capitalize py-3 hard-color">Hasil konsultasi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover border table-bordered align-middle">
                <thead class="text-capitalize">
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">nama psikolog</th>
                        <th scope="col">jenis konsultasi</th>
                        <th scope="col">keluhan</th>
                        <th scope="col">Tingkat Permasalahan</th>
                        <th scope="col">tanggal</th>
                        <th scope="col">catatan mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hasilKonsultasi as $index => $data )
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->psikolog->nama_psikolog }}</td>
                        <td>{{ $data->janjiTemu->jenis_konsultasi }}</td>
                        <td>{{ $data->janjiTemu->keluhan_umum }}</td>
                        <td>
                            <span class="badge @if ($data->tingkat_permasalahan == 'ringan') text-bg-success @elseif ($data->tingkat_permasalahan == 'sedang') text-bg-warning @else text-bg-danger @endif">
                                {{ $data->tingkat_permasalahan }}
                            </span>
                        </td>
                        <td>{{ $data->janjiTemu->tanggal }}</td>
                        <td>
                            <p>
                                {{ $data->catatan_mahasiswa }}
                            </p>
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

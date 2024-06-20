@extends('layout.html')

@section('content')
    <div class="min-vh-100 section-warm-bg-color">
        <div class="container">
            <h2 class="text-capitalize hard-color py-3">Data Riwayat Konsultasi</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover border table-bordered text-center align-middle">
                    <thead class="text-capitalize">
                        <tr>
                            <th scope="col">no</th>
                            <th scope="col">nama psikolog</th>
                            <th scope="col">jenis konsultasi</th>
                            <th scope="col">keluhan</th>
                            <th scope="col">tanggal janji</th>
                            <th scope="col">jam janji</th>
                            <th scope="col">status</th>
                            <th scope="col">keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataRiwayat as $index => $data )
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $data->psikolog->nama_psikolog }}</td>
                            <td>{{ $data->jenis_konsultasi }}</td>
                            <td>{{ $data->keluhan_umum }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td>{{ $data->jam }}</td>
                            <td>
                                <span class="badge text-capitalize @if ($data->status == 'menunggu')text-bg-primary @elseif ($data->status == 'diterima') text-bg-success @elseif ($data->status == 'selesai') text-bg-secondary @else text-bg-warning @endif ">
                                    {{ $data->status }}
                                </span>
                            </td>
                            <td>
                                @if ($data->keterangan == null)
                                    -
                                @else
                                    {{ $data->keterangan }}
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%">Tidak Ada untuk Ditampilkan!</td>
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
        $('.table').DataTable({
            info: false,
            dom: '<"row"<"col-sm-6 d-flex justify-content-center justify-content-sm-start mb-2 mb-sm-0"l><"col-sm-6 d-flex justify-content-center justify-content-sm-end"f>>rtp',
            autoWidth: false,
        });
    </script>
@endpush

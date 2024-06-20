@extends('layout.html')

@section('content')
    <div class="min-vh-100 section-warm-bg-color">
        <div class="container">
            <h2 class="text-capitalize hard-color py-3">Laporan Riwayat Konsultasi Mahasiswa</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover border table-bordered">
                    <thead class="text-capitalize">
                        <tr>
                            <th scope="col">no</th>
                            <th scope="col">nama psikolog</th>
                            <th scope="col">jenis konsultasi</th>
                            <th scope="col">keluhan</th>
                            <th scope="col">tanggal</th>
                            <th scope="col">fakultas</th>
                            <th scope="col">deskripsi laporan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hasilLaporan as $index => $data )
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $data->psikolog->nama_psikolog }}</td>
                            <td>{{ $data->janjiTemu->jenis_konsultasi }}</td>
                            <td>{{ $data->janjiTemu->keluhan_umum }}</td>
                            <td>{{ $data->janjiTemu->tanggal }}</td>
                            <td>{{ $data->mahasiswa->fakultas->fakultas }}</td>
                            <td>
                                <p>
                                    {{ $data->laporan_perguruan_tinggi }}
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
            <div class="row" data-aos="fade-up" data-aos-duration="500">
                <h1 class="border-dark border-2 border-bottom pb-2 my-3 text-capitalize">statistik riwayat konsultasi mahasiswa</h1>
            </div>
            <form action="{{ route('showChart') }}" method="POST" class="row row-cols-1 row-cols-sm-3">
                @csrf
                <div class="col">
                    <div class="form-floating my-3" data-aos="fade-up" data-aos-duration="500">
                        <select class="form-select" name="tahun" required>
                            <option value="">pilih tahun</option>
                            @php
                            use Carbon\Carbon;
                            $tahunSekarang = Carbon::now()->format('Y');
                            $tahunAwal = $tahunSekarang - 10;
                            @endphp
                            @for ($tahun = $tahunAwal; $tahun <= $tahunSekarang; $tahun++)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endfor
                        </select>
                        <label for="floatingSelect">Tahun</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating my-3" data-aos="fade-up" data-aos-duration="500">
                        <select class="form-select" name="bulan" required>
                            <option value="">pilih Bulan</option>
                            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                            <option value="{{ $index + 1 }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Bulan</label>
                    </div>
                </div>
                <div class="col my-2 d-flex align-items-center" data-aos="fade-up" data-aos-duration="500">
                    <button type="submit" class="btn bg-soft">lihat statistik</button>
                </div>
            </form>
            @if (session('labels'))
            <div class="row d-flex justify-content-center align-items-center">
                <div class="chart">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            @endif
        </div>
    </div>
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
                        filename: 'Riwayat_Konsultasi',
                        title: 'Laporan Riwayat Konsultasi Mahasiswa'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                        titleAttr: 'PDF',
                        filename: 'Riwayat_Konsultasi',
                        title: 'Laporan Riwayat Konsultasi Mahasiswa'
                    }
                ]
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(session('labels', [])),
                datasets: [
                    {
                        label: 'Pria',
                        data: @json(session('dataPria', [])),
                        backgroundColor: 'rgba(255, 205, 86, 0.3)',
                        borderColor: 'rgb(255, 205, 86)',
                        borderWidth: 1,
                        hoverBorderRadius:5,
                        hoverBorderWidth:2,
                    },
                    {
                        label: 'Wanita',
                        data: @json(session('dataWanita', [])),
                        backgroundColor: 'rgba(66, 186, 150, 0.3)',
                        borderColor: 'rgb(82, 235, 186)',
                        borderWidth: 1,
                        hoverBorderRadius:5,
                        hoverBorderWidth:2,
                    },
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: '{{ session('jenis_pengajuan') }}',
                        font: {
                            size: 22,
                            weight: 'bold'
                        }
                    },
                },
                animation: {
                    duration: 3000,
                    easing: 'easeOutQuart'
                },
            }
        });
    </script>
@endpush

@extends('layout.html')

@push('css')
    <link rel="stylesheet" href="{{ asset('web-assets/css/layanan.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endpush

@section('content')
    <section class="min-vh-100 section-warm-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-1 order-lg-0">
                    <div class="section-header" data-aos="fade-right" data-aos-duration="500">
                        <h1 class="text-uppercase h1">
                            <p class="hard-color">apa</p>
                            <p class="hard-color">yang sedang</p>
                            <p class="hard-color">kamu rasakan?</p>
                        </h1>
                    </div>
                    <div class="section-content d-flex" data-aos="fade-up" data-aos-duration="500">
                        <div id="stres" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/stress.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">Stres</p>
                            </div>
                        </div>
                        <div id="depresi" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/depresi.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">Depresi </p>
                            </div>
                        </div>
                        <div id="adhd" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/adhd.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">Adhd</p>
                            </div>
                        </div>
                        <div id="toxic" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/toxic-relation.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">Toxic Relation</p>
                            </div>
                        </div>
                        <div id="kecemasan" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/kecemasan.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex flex-wrap align-items-center">
                                <p class="card-text">Kecemasan</p>
                            </div>
                        </div>
                        <div id="gangguan-makanan" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/gangguan-makan.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">Gangguan Makanan</p>
                            </div>
                        </div>
                        <div id="gangguan-tidur" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/gangguan-tidur.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">Gangguan Tidur</p>
                            </div>
                        </div>
                        <div id="ptsd" class="btn card d-flex justify-content-center align-items-center p-3 text-capitalize">
                            <img src="{{ asset('web-assets/image/ptsd.jpg') }}" class="card-img-top rounded-circle border border-3" alt="...">
                            <div class="card-body d-flex align-items-center">
                                <p class="card-text">PTSD</p>
                            </div>
                        </div>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-stres">
                        <p class="mt-3" >
                            Stres adalah respons tubuh terhadap tekanan atau ancaman. Ini muncul saat kita merasa cemas atau tertekan oleh tuntutan, baik itu dari pekerjaan, studi, atau kehidupan pribadi.
                        </p>
                        <p>
                            Ciri-ciri awal stres termasuk sakit kepala, sulit tidur, mudah marah, dan perubahan nafsu makan. Anda mungkin juga merasa lelah secara fisik dan mental, serta mengalami kesulitan dalam berkonsentrasi.
                        </p>
                        <p>
                            Untuk mengatasi stres secara mandiri, coba gunakan teknik relaksasi seperti meditasi atau yoga, luangkan waktu untuk hobi atau kegiatan yang Anda nikmati, dan pastikan mendapatkan tidur yang cukup. Selain itu, makan makanan sehat dan olahraga secara teratur juga penting.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-depresi">
                        <p class="mt-3" >
                            Depresi adalah gangguan kesehatan mental yang ditandai oleh perasaan sedih yang mendalam, hilangnya minat atau kesenangan, perasaan berat atau kelelahan, dan kesulitan berkonsentrasi.
                        </p>
                        <p>
                            Gejala awal depresi dapat mencakup tidur yang terganggu, perubahan nafsu makan, penurunan energi, dan merasa cemas atau gelisah. Perubahan mood, seperti merasa sedih atau frustrasi bahkan tentang hal-hal kecil, juga bisa menjadi tanda awal.
                        </p>
                        <p>
                            Untuk penanganan mandiri, latihan fisik teratur dan pola makan sehat bisa membantu. Praktik mindfulness dan teknik relaksasi seperti pernapasan dalam juga bisa membantu. Namun, mencari bantuan profesional sangat disarankan jika gejala berlanjut atau memburuk.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-adhd">
                        <p class="mt-3" >
                            Attention-Deficit/Hyperactivity Disorder (ADHD) adalah kondisi neurobiologis yang mempengaruhi individu sepanjang rentang kehidupan mereka. Ini biasanya ditandai dengan kesulitan dalam mempertahankan perhatian, hiperaktivitas, dan perilaku impulsif yang tidak sesuai dengan usia seseorang.
                        </p>
                        <p>
                            Gejala awal ADHD mungkin terlihat berbeda tergantung pada individu, tetapi umumnya meliputi kesulitan dalam mengikuti instruksi, mudah terganggu, sering mengganti aktivitas, serta perilaku dan gerakan yang hiperaktif atau gelisah. Orang dengan ADHD seringkali kesulitan dalam manajemen waktu, merencanakan, dan organisasi.
                        </p>
                        <p>
                            Meski tidak ada "penyembuhan" untuk ADHD, gejalanya dapat dikelola dengan berbagai cara. Penanganan mandiri bisa melibatkan teknik manajemen waktu dan organisasi, serta rutinitas tidur yang sehat. Latihan fisik teratur dan teknik relaksasi, seperti meditasi atau yoga, juga bisa membantu. Selain itu, pendekatan diet dan nutrisi yang sehat juga dapat berkontribusi dalam manajemen gejala. Ingat, untuk gejala yang parah atau mengganggu, sebaiknya konsultasikan dengan profesional kesehatan mental.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-toxic">
                        <p class="mt-3" >
                            Toxic relationship adalah hubungan interpersonal yang merugikan dan mengandung perilaku negatif. Ini dapat mempengaruhi kesehatan mental karena melibatkan manipulasi emosional dan pengabaian.
                        </p>
                        <p>
                            Tanda-tanda awal dari toxic relationship meliputi penurunan kepercayaan diri, perasaan terisolasi dari lingkungan sosial, kesulitan tidur, dan perasaan cemas yang berlebihan.
                        </p>
                        <p>
                            Untuk mengatasi toxic relationship, penting untuk meningkatkan kesadaran diri, membatasi interaksi dengan orang yang merugikan, dan mencari dukungan baik dari lingkungan sosial maupun dari profesional kesehatan mental jika diperlukan.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-kecemasan">
                        <p class="mt-3" >
                            Kecemasan adalah respons alami tubuh terhadap stres yang bisa menjadi masalah jika berlangsung lama atau tidak proporsional. Kondisi ini dapat berkembang menjadi gangguan kecemasan, sebuah kategori penyakit mental.
                        </p>
                        <p>
                            Ciri-ciri awal kecemasan mencakup perasaan khawatir atau takut yang berlebihan dan berkepanjangan, sulit berkonsentrasi, iritabilitas, dan masalah tidur. Jika ini terjadi, segera cari bantuan.
                        </p>
                        <p>
                            Pengelolaan kecemasan mandiri dapat mencakup teknik relaksasi seperti pernapasan dalam, olahraga teratur, pola tidur dan makan yang sehat, serta menghindari kafein dan alkohol. Namun, bantuan profesional tetap penting.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-gangguan-makanan">
                        <p class="mt-3" >
                            Gangguan makan adalah kondisi yang ditandai oleh ketidaknormalan dalam pola makan, biasanya berupa makan terlalu banyak atau terlalu sedikit. Gangguan ini bisa mencakup anoreksia nervosa, bulimia nervosa, dan binge eating disorder.
                        </p>
                        <p>
                            Ciri-ciri awal dapat mencakup kekhawatiran berlebihan tentang berat badan atau bentuk tubuh, diet ekstrem, makan dalam jumlah besar, atau penggunaan metode tidak sehat untuk mencegah penambahan berat badan.
                        </p>
                        <p>
                            Penanganan secara mandiri bisa mencakup langkah-langkah seperti menjaga pola makan seimbang, menjauhkan diri dari diet ekstrem, menjalankan olahraga rutin, dan mencari dukungan dari teman dan keluarga. Namun, bantuan profesional sering diperlukan.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-gangguan-tidur">
                        <p class="mt-3" >
                            Gangguan tidur adalah serangkaian kondisi yang menghambat kapasitas seseorang untuk tidur secara konsisten dan berkualitas. Gangguan ini bisa merusak kesehatan fisik dan mental, serta mempengaruhi performa sehari-hari.
                        </p>
                        <p>
                            Gejala awal gangguan tidur termasuk kesulitan untuk tertidur atau tetap tidur, terjaga di malam hari, bangun terlalu dini, atau merasa tidak segar bahkan setelah tidur cukup lama. Gangguan tidur juga bisa ditandai dengan mengantuk berlebihan di siang hari.
                        </p>
                        <p>
                            Penanganan mandiri untuk gangguan tidur meliputi menjaga rutinitas tidur yang teratur, mengurangi konsumsi kafein dan alkohol, serta menjaga lingkungan tidur agar tetap tenang dan nyaman. Aktivitas relaksasi, seperti meditasi atau mandi air hangat sebelum tidur, juga bisa membantu.
                        </p>
                    </div>
                    <div class="keterangan-box" data-aos="fade-up" data-aos-duration="500" id="keterangan-ptsd">
                        <p class="mt-3" >
                            PTSD, atau Post-Traumatic Stress Disorder, adalah kondisi kesehatan mental yang muncul setelah seseorang mengalami atau menyaksikan peristiwa traumatis seperti perang, kecelakaan, atau kekerasan.
                        </p>
                        <p>
                            Gejala awal PTSD meliputi flashbacks atau mimpi buruk mengenai peristiwa traumatis, menghindari hal-hal yang mengingatkan pada trauma, perubahan mood, dan respons fisik yang berlebihan seperti detak jantung cepat.
                        </p>
                        <p>
                            Pada tahap awal, penanggulangan PTSD bisa dilakukan dengan melakukan teknik relaksasi, seperti meditasi atau pernapasan dalam-dalam, dan menjaga rutinitas sehari-hari. Namun, bantuan profesional sangat disarankan.
                        </p>
                    </div>
                    <a href="#psikolog" class="btn btn-lg bg-soft text-capitalize mb-3">Carikan Ahli</a>
                </div>
                <div class="col-lg-5 d-flex justify-content-center align-items-center order-0 order-lg-1">
                    <img src="{{ asset('web-assets/image/layanan-1.png') }}" alt="" class="img-fluid object-fit-cover">
                </div>
            </div>
        </div>
    </section>
    <section id="psikolog" class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <h1 class="mx-auto text-uppercase heading" data-aos="fade-down" data-aos-duration="500">Para <span class="ms-1">Ahli</span></h1>
            @auth
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 mb-3">
                    @foreach ($dataPsikolog as $index => $data )
                        <div class="col" data-aos="fade-up" data-aos-duration="500">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-4 psikolog-image">
                                        <i class="status-icon fa-solid fa-circle ms-2 mt-2 @if ($data->status == 'online') text-success @elseif ($data->status == 'sibuk') text-warning @else text-danger @endif"></i>
                                        <img src="{{ $data->foto ? asset('storage/'.$data->foto) : asset('web-assets/image/consult.png') }}" class="img-fluid rounded-start object-fit-cover" alt="...">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <p class="card-title blockquote fw-semibold">{{ $data->nama_psikolog }}</p>
                                            <p class="text-body-secondary blockquote-footer fst-italic">{{ $data->no_str }}</p>
                                            <p class="card-text"><i class="fa-solid fa-graduation-cap hard-color"></i> : {{ $data->alumni }}</p>
                                            <p class="card-text"><i class="fa-solid fa-envelope hard-color"></i> : {{ $data->email }}</p>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn bg-hard text-light @if ($data->status != 'online') disabled @endif" data-bs-toggle="modal" data-bs-target="#buatJanjiModal{{ $index+1 }}">
                                                    @if ($data->status == 'online')
                                                    <i class="fa-solid fa-calendar-check"></i> Buat Janji
                                                    @elseif ($data->status == 'sibuk')
                                                    <i class="fa-solid fa-business-time"></i> sibuk
                                                    @else
                                                    <i class="fa-solid fa-power-off"></i> offline
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-start align-items-center">
                        <img src="{{ asset('web-assets/image/empty.png') }}" alt="" width="auto" height="300">
                        <div class="text-content">
                            <h2 class="text-capitalize typing-animation hard-color">silakan masuk terlebih dahulu</h2>
                        </div>
                        <a href="{{ route('loginPage') }}" class="btn btn-lg bg-soft">Masuk <i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                </div>
            @endauth
        </div>
    </section>

@auth
    @foreach ($dataPsikolog as $index => $data )
        <div class="modal fade" id="buatJanjiModal{{ $index+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Janji</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('ajukanJanjiProcess') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="" class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ Auth::user()->mahasiswa->nim }}" required readonly>
                                    @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">No STR</label>
                                    <input type="text" name="no_str" class="form-control @error('no_str') is-invalid @enderror" value="{{ $data->no_str }}" required readonly>
                                    @error('no_str')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">keluhan umum</label>
                                    <select name="keluhan_umum" class="form-select @error('keluhan_umum') is-invalid @enderror" required>
                                        <option value="">Pilih Keluhan</option>
                                        <option value="Depresi">Depresi</option>
                                        <option value="Stress">Stress</option>
                                        <option value="Toxic Relation">Toxic Relation</option>
                                        <option value="Gangguan Makan">Gangguan Makan</option>
                                        <option value="Gangguan Tidur">Gangguan Tidur</option>
                                        <option value="PTSD">PTSD</option>
                                        <option value="ADHD">ADHD</option>
                                        <option value="Kecemasan">Kecemasan</option>
                                    </select>
                                    @error('keluhan_umum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Detail Masalah</label>
                                    <textarea name="detail_masalah" class="form-control @error('detail_masalah') is-invalid @enderror" rows="4" placeholder="Ceritakan detail masalah anda" required>{{ old('detail_masalah') }}</textarea>
                                    @error('detail_masalah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Jam</label>
                                    <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" value="{{ old('jam') }}" required>
                                    @error('jam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Jenis Konsultasi</label>
                                    <select name="jenis_konsultasi" class="form-select @error('jenis_konsultasi') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Konsultasi</option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                    @error('jenis_konsultasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
@endauth

@endsection

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.section-content').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-circle-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-circle-chevron-right"></i></button>',
            mobileFirst: true,

        });
    </script>

    <script>
        const cardsContainer = document.querySelector('.section-content');
        const keteranganBoxes = document.querySelectorAll('.keterangan-box');

        keteranganBoxes.forEach((box) => {
            box.style.display = 'none';
        });
        const keteranganStres = document.getElementById('keterangan-stres');
        keteranganStres.style.display = 'block';

        cardsContainer.addEventListener('click', (event) => {
            const clickedCard = event.target.closest('.card');
            if (!clickedCard) return;
            keteranganBoxes.forEach((box) => {
                box.style.display = 'none';
            });

            const cardId = clickedCard.id;
            const keteranganBox = document.getElementById(`keterangan-${cardId}`);
            if (keteranganBox) {
                keteranganBox.style.display = 'block';
            }
        });
    </script>

    <script>

    </script>
@endpush

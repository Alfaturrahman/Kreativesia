@extends('layout.html')

@push('css')
    <link rel="stylesheet" href="{{ asset('web-assets/css/landing.css') }}">
@endpush

@section('content')
    <section id="section-1" class="min-vh-100 d-flex justify-content-center align-items-center pb-3 pb-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-1 order-lg-0" data-aos="fade-up" data-aos-duration="500">
                    <h1 class="text-uppercase">
                        <p class="hard-color">Kesehatan Mental</p>
                        <p>itu penting !</p>
                    </h1>
                    <p class="lh-3">
                        Kesehatan mental, bukan hanya tentang bebas gangguan jiwa, tapi juga tentang kemampuan menikmati hidup, bertahan dalam tantangan, dan menjalin hubungan positif. Kesehatan mental mempengaruhi cara kita berpikir, merasa, dan bertindak. Prioritaskan kesehatan mental untuk hidup yang lebih bahagia, produktif, dan bermakna. Sehat mental, kekayaan sejati.
                    </p>
                </div>
                <div class="col-lg-5 d-flex justify-content-center" data-aos="fade-down" data-aos-duration="500">
                    <img src="{{ asset('web-assets/image/landing-1.jpg') }}" class="img-fluid object-fit-cover">
                </div>
            </div>
        </div>
    </section>
    <section id="section-2" class="min-vh-100 d-flex justify-content-center align-items-center pb-4 pb-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-flex justify-content-center" data-aos="fade-down" data-aos-duration="500">
                    <div class="my-3">
                        <img src="{{ asset('web-assets/image/landing-2.png') }}" alt="" class="img-fluid object-fit-cover">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="500">
                    <h1 class="text-uppercase">
                        <span class="hard-color">apa itu</span> mental health?
                    </h1>
                        <p class="lh-3">
                            Kesehatan Mental merupakan hal fundamental dalam kehidupan, yang melibatkan keseimbangan emosional, psikologis, dan sosial. Ini memungkinkan kita berfungsi dengan baik dalam kehidupan sehari-hari dan menikmati kehidupan yang produktif. Tetapi, tantangan dan tekanan bisa mengganggu keseimbangan ini. Jika Anda merasa terjebak, bingung, atau bahkan sedih, mencari bantuan profesional seperti psikolog bisa menjadi langkah yang sangat berarti. Ingatlah, meminta bantuan bukanlah simbol kelemahan, melainkan tindakan berani dalam menjaga kesejahteraan diri
                        </p>
                    <a href="/layanan" class="btn btn-lg">Ayo konsul <i class="fa-solid fa-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section id="section-3" class="min-vh-100 d-flex justify-content-center align-items-center pb-3 pb-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="500">
                <h1 class="text-uppercase">
                    <span class="text-light opacity-75">Kamu,kami,dan kita dapat saling membantu</span> dalam mengatasi mental health
                </h1>
                <p class="fs-6">
                    Kamu, kami, dan kita semua punya peran penting dalam menjaga kesehatan mental. Dengan saling mendukung, kita bisa menghadapi tantangan dan membangun keseimbangan emosi dan psikologis untuk hidup lebih baik.                </p>
            </div>
            <div class="col-lg-5" data-aos="fade-down" data-aos-duration="500">
                <div class="card mb-3">
                    <img src="{{ asset('web-assets/image/landing-3.jpg') }}" class="card-img-top img-fluid object-fit-cover" alt="...">
                </div>
            </div>
        </div>
    </section>
    <section id="section-4" class="min-vh-100 d-flex justify-content-center align-items-center pb-3 pb-lg-0">
        <div class="container">
            <h1 class="text-center text-uppercase h1 heading" data-aos="fade-down" data-aos-duration="500">alur <span class="ms-2">konsultasi</span></h1>
            <div class="d-flex flex-column flex-md-row flex-wrap justify-content-center align-items-center mt-3">
                <div class="flow-content p-2" data-aos="fade-up" data-aos-duration="500">
                    <h2 class="text-center hard-color">1</h2>
                    <div class="rounded-circle border border-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('web-assets/image/alur-1.jpg') }}" alt="" class="img-fluid object-fit-cover rounded-circle">
                    </div>
                    <div class="text-content border rounded-3 mt-3 text-center py-2">
                        <h4 class="text-capitalize">Membuat janji temu</h4>
                        <p>Buat janji temu dengan psikolog atau terapis sesuai kebutuhan Anda</p>
                    </div>
                </div>
                <div class="flow-content p-2" data-aos="fade-up" data-aos-duration="500">
                    <h2 class="text-center hard-color">2</h2>
                    <div class="rounded-circle border border-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('web-assets/image/alur-2.jpg') }}" alt="" class="img-fluid object-fit-cover rounded-circle">
                    </div>
                    <div class="text-content border rounded-3 mt-3 text-center py-2">
                        <h4 class="text-capitalize">Mengisi form janji temu</h4>
                        <p>Isi form janji untuk menentukan jadwal konsultasi Anda agar kami dapat mempersiapkan sesi yang paling relevan dan efektif sesuai kebutuhan Anda.</p>
                    </div>
                </div>
                <div class="flow-content p-2" data-aos="fade-up" data-aos-duration="500">
                    <h2 class="text-center hard-color">3</h2>
                    <div class="rounded-circle border border-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('web-assets/image/alur-3.jpg') }}" alt="" class="img-fluid object-fit-cover rounded-circle">
                    </div>
                    <div class="text-content border rounded-3 mt-3 text-center py-2">
                        <h4 class="text-capitalize">menyesuaikan janji temu</h4>
                        <p>Koordinasikan dan sesuaikan waktu yang tepat untuk berkonsultasi dengan psikolog Anda.</p>
                    </div>
                </div>
                <div class="flow-content p-2" data-aos="fade-up" data-aos-duration="500">
                    <h2 class="text-center hard-color">4</h2>
                    <div class="rounded-circle border border-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('web-assets/image/alur-4.jpg') }}" alt="" class="img-fluid object-fit-cover rounded-circle">
                    </div>
                    <div class="text-content border rounded-3 mt-3 text-center py-2">
                        <h4 class="text-capitalize">Berkonsultasi dengan psikolog</h4>
                        <p> Konsultasikan perasaan dan pikiran Anda dengan psikolog untuk mencari solusi terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-5" class="min-vh-100 d-flex justify-content-center align-items-center pb-3 pb-lg-0">
        <div class="container">
            <h1 class="text-center text-uppercase hard-color" data-aos="fade-down" data-aos-duration="500">Konsultan kami</h1>
            <div class="row row-cols-1 row-cols-md-3 g-3 mt-3">
                <div class="col">
                    <div class="card mb-3 h-100" data-aos="fade-up" data-aos-duration="500">
                        <img src="{{ asset('web-assets/image/ahli-pria.jpg') }}" class="card-img-top object-fit-cover" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Alfaturahman</h5>
                            <p class="card-text">Politeknik Negeri Batam</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 h-100" data-aos="fade-up" data-aos-duration="500">
                        <img src="{{ asset('web-assets/image/ahli-wanita.jpg') }}" class="card-img-top object-fit-cover" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Hadian Nelvi</h5>
                            <p class="card-text">Politeknik Negeri Batam</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 h-100" data-aos="fade-up" data-aos-duration="500">
                        <img src="{{ asset('web-assets/image/ahli-pria.jpg') }}" class="card-img-top object-fit-cover" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">A.Iqbal Zulmi</h5>
                            <p class="card-text">Politeknik Negeri Batam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

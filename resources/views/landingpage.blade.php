@extends('layouts.app')
@section('content')
    <style>
        #bannerCarousel .carousel-item img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 1rem;
        }
    </style>
    <!--start main wrapper-->
    <div class="main-content">
        <!--start banner-->
        <section class="py-5 mt-5" id="home">
            <div class="container py-4 px-4 px-lg-0">
                <div class="row align-items-center justify-content-center g-4">
                    <div class="col-12 col-xl-6 order-xl-first order-last">
                        <h1 class="fw-bold mb-3 banner-heading">Digitalisasikan pencatatan air !</h1>
                        <h5 class="mb-0 banner-paragraph">
                            Transformasikan sistem pencatatan air konvensional menjadi lebih efisien dan akurat dengan
                            solusi digital kami
                        </h5>
                        <div class="d-flex flex-column flex-lg-row align-items-center gap-3 mt-5">
                            <a href="https://wa.me/6282119286029" target="_blank"
                                class="btn btn-lg d-flex align-items-center justify-content-center rounded-5 gap-2 px-4 py-2 text-white"
                                style="background-color: #25D366; box-shadow: 0 4px 12px rgba(37,211,102,0.3); transition: all 0.2s ease;">
                                <i class="bi bi-whatsapp fs-4"></i> Kontak Sekarang
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.yourapp" target="_blank"
                                class="btn btn-lg d-flex align-items-center justify-content-center rounded-5 gap-2 px-4 py-2 text-white"
                                style="background-color: #000000; box-shadow: 0 4px 12px rgba(0,0,0,0.3); transition: all 0.2s ease;">
                                <i class="bi bi-google-play fs-4"></i> Dapatkan di playstore
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 text-center mt-4 mt-xl-0">
                        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                            <div class="carousel-inner rounded-4 shadow-sm">
                                <div class="carousel-item active">
                                    <img src="assets/images/bayar-air-image/banner-1.png" class="img-fluid" alt="Banner 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/images/bayar-air-image/banner-2.png" class="img-fluid" alt="Banner 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/images/bayar-air-image/banner-3.png" class="img-fluid" alt="Banner 3">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/images/bayar-air-image/banner-4.png" class="img-fluid" alt="Banner 4">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/images/bayar-air-image/banner-5.png" class="img-fluid" alt="Banner 5">
                                </div>
                                <!-- Optional: Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                            <!-- Optional: Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end banner-->


        <!--start about us-->
        <section class="py-5 bg-section" id="About">
            <div class="container py-4 px-4 px-lg-0">
                <div class="section-title text-center mb-5">
                    <h1 class="mb-0 section-title-name">Tentang Kami</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-xl-6">
                        <h2 class="mb-3">PT Progantara Teknologi Indonesia</h2>
                        <p class="mb-3">sebuah perusahaan yang bergerak di
                            bidang teknologi informasi, merespons kebutuhan tersebut dengan
                            mengembangkan aplikasi custume seperti aplikasi sistem pembayaran air ini
                        </p>
                        <div class="d-flex flex-column gap-2">
                            <p class="d-flex align-items-start gap-3 mb-0"><i
                                    class="material-icons-outlined fs-5">check_circle</i>Tim Profesional
                                Ahli berpengalaman dengan solusi tepat guna.</p>
                            <p class="d-flex align-items-start gap-3 mb-0"><i
                                    class="material-icons-outlined fs-5">check_circle</i>Harga Terjangkau
                                Solusi efisien dan kompetitif tanpa mengorbankan kualitas.</p>
                            <p class="d-flex align-items-start gap-3 mb-0"><i
                                    class="material-icons-outlined fs-5">check_circle</i>Teknologi Terkini
                                Selalu update demi keunggulan kompetitif bisnis Anda.</p>
                        </div>
                        <div class="mt-4">
                            <!-- <a href="javascript:;" class="btn btn-grd btn-grd-primary">Read More</a> -->
                            <a href="https://www.progantara.com/"
                                class="btn btn-grd btn-grd-primary rounded-5 d-flex align-items-center gap-2 raised px-4">
                                Website kami<i class="material-icons-outlined">east</i>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 d-flex justify-content-center align-items-center">
                        <!-- <img src="assets/images/gallery/24.png" class="img-fluid img-thumbnail rounded-4 bg-grd-warning" alt=""> -->
                        <img src="assets/images/Progantara/Logo-Progantara.png" class="img-fluid img-thumbnail"
                            alt="">
                    </div>
                </div><!--end row-->
            </div>
        </section>
        <!--end about us-->

        <!--start services-->
        <section class="py-5" id="Services">
            <div class="container py-4 px-4 px-lg-0">
                <div class="section-title text-center mb-5">
                    <h1 class="mb-0 section-title-name">Fitur</h1>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-4">
                    <div class="col d-flex">
                        <div class="card rounded-4 mb-0 w-100">
                            <div class="card-body text-center p-4">
                                <div class="d-flex flex-column gap-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-branding text-white flex-shrink-0 mx-auto">
                                        <i class="material-icons-outlined fs-2">account_balance</i>
                                    </div>
                                    <div class="">
                                        <h5>Pencatatan pemakaian air</h5>
                                        <p class="mb-0">
                                            Catat dan kelola data pemakaian air pelanggan secara digital
                                            dengan akurasi tinggi dan tampilan yang mudah digunakan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-4 mb-0 w-100">
                            <div class="card-body text-center p-4">
                                <div class="d-flex flex-column gap-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-success text-white flex-shrink-0 mx-auto">
                                        <i class="material-icons-outlined fs-2">history</i>
                                    </div>
                                    <div class="">
                                        <h5>Riwayat Pembayara Air</h5>
                                        <p class="mb-0">
                                            Akses riwayat pembayaran dengan mudah, transparan,
                                            dan cepat untuk setiap pelanggan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-4 mb-0 w-100">
                            <div class="card-body text-center p-4">
                                <div class="d-flex flex-column gap-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-deep-blue text-white flex-shrink-0 mx-auto">
                                        <i class="material-icons-outlined fs-2">leaderboard</i>
                                    </div>
                                    <div class="">
                                        <h5>ringkasan Pembayaran</h5>
                                        <p class="mb-0">
                                            Dapatkan laporan dan ringkasan transaksi secara real-time untuk mempermudah
                                            pemantauan dan analisis keuangan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-4 mb-0 w-100">
                            <div class="card-body text-center p-4">
                                <div class="d-flex flex-column gap-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-warning text-white flex-shrink-0 mx-auto">
                                        <i class="material-icons-outlined fs-2">language</i>
                                    </div>
                                    <div class="">
                                        <h5>Integrasi Mobile & Printer Struk</h5>
                                        <p class="mb-0">
                                            Aplikasi mobile yang terintegrasi dengan printer struk untuk pencatatan dan
                                            pembayaran air di lapangan secara langsung.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </section>
        <!--end services-->

        <!--start FAQ-->
        @if ($faqs->isNotEmpty())
            <section class="py-5 bg-section" id="FAQ">
                <div class="container py-4 px-4 px-lg-0">
                    <div class="section-title text-center mb-5">
                        <h1 class="mb-0 section-title-name">FAQ</h1>
                        <p class="mb-0">Pertanyaan yang sering diajukan oleh pengguna kami</p>
                        <p>Click Pertanyaa untuk membuka jawaban nya</p>
                    </div>

                    <div class="accordion" id="faqAccordion">
                        @foreach ($faqs as $index => $faq)
                            <div class="accordion-item mb-3 rounded-4 shadow-sm border-0">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}"
                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!--end FAQ-->
    </div>

    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
@endsection

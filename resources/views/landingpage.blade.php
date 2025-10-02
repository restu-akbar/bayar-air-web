@extends('layouts.app')
@section('content')
    @include('components.landing-header')
    <!--start main wrapper-->
        <div class="main-content">

            <!--start banner-->
            <section class="py-5" id="home">
                <div class="container py-4 px-4 px-lg-0">
                    <div class="row align-items-center justify-content-center g-4">
                        <div class="col-12 col-xl-6 order-xl-first order-last">
                            <h1 class="fw-bold mb-3 banner-heading">Improved Business Solutions for Your Organization.
                            </h1>
                            <h5 class="mb-0 banner-paragraph">We are a group of talented designers who specialize in
                                developing
                                websites using Bootstrap.</h5>
                            <div class="d-flex flex-column flex-lg-row align-items-center gap-3 mt-5">
                                <a href="javascript:;"
                                    class="btn btn-lg btn-grd btn-grd-primary d-flex align-items-center rounded-5 gap-2 raised">
                                    <i class="material-icons-outlined">speed</i>Get Started
                                </a>
                                <a href="javascript:;"
                                    class="btn btn-lg btn-light d-flex align-items-center rounded-5 gap-2 raised">
                                    <i class="material-icons-outlined">play_circle_outline</i>Watch Video
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6 text-center">
                            <img src="assets/images/banners/01.png" class="img-fluid" width="560" alt="">
                        </div>
                    </div><!--end row-->
                    <div class="row g-4 mt-4">
                        <div class="col-12 col-lg-6 col-xl-4 d-flex">
                            <div class="card rounded-4 mb-0 w-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle wh-64 btn-grd-info text-white flex-shrink-0">
                                            <i class="material-icons-outlined fs-2">emoji_events</i>
                                        </div>
                                        <div class="">
                                            <h5>There are many variations</h5>
                                            <p class="mb-0">All the Lorem Ipsum generators on the Internet tend to
                                                repeat predefined chunks as
                                                necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4 d-flex">
                            <div class="card rounded-4 mb-0 w-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle wh-64 btn-grd-danger text-white flex-shrink-0">
                                            <i class="material-icons-outlined fs-2">privacy_tip</i>
                                        </div>
                                        <div class="">
                                            <h5>Many desktop publishing</h5>
                                            <p class="mb-0">Many desktop publishing packages and web page editors now
                                                use Lorem Ipsum as
                                                their.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 col-xl-4 d-flex">
                            <div class="card rounded-4 mb-0 w-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle wh-64 btn-grd-success text-white flex-shrink-0">
                                            <i class="material-icons-outlined fs-2">try</i>
                                        </div>
                                        <div class="">
                                            <h5>Contrary to popular belief</h5>
                                            <p class="mb-0">It has survived not only five centuries, but also the
                                                leap into electronic
                                                typesetting.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </section>
            <!--end banner-->


            <!--start about us-->
            <section class="py-5 bg-section" id="About">
                <div class="container py-4 px-4 px-lg-0">
                    <div class="section-title text-center mb-5">
                        <h1 class="mb-0 section-title-name">About Us</h1>
                    </div>
                    <div class="row g-4">
                        <div class="col-12 col-xl-6">
                            <h6 class="text-uppercase mb-3">Who We Are</h6>
                            <h2 class="mb-3">Maximizing Potential through Innovative Strategies.</h2>
                            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                                impedit quo minus id
                                quod maxime placeat
                                facere possimus, omnis voluptas assumenda Quis autem vel eum iure reprehenderit qui in
                                ea voluptate
                                velit esse quam nihil
                            </p>
                            <div class="d-flex flex-column gap-2">
                                <p class="d-flex align-items-start gap-3 mb-0"><i
                                        class="material-icons-outlined fs-5">check_circle</i>At vero eos et accusamus
                                    et iusto odio
                                    dignissimos ducimus blanditiis</p>
                                <p class="d-flex align-items-start gap-3 mb-0"><i
                                        class="material-icons-outlined fs-5">check_circle</i>On the other hand, we
                                    denounce with righteous
                                    indignation </p>
                                <p class="d-flex align-items-start gap-3 mb-0"><i
                                        class="material-icons-outlined fs-5">check_circle</i>In a free hour, when our
                                    power of choice is
                                    untrammelled</p>
                                <p class="d-flex align-items-start gap-3 mb-0"><i
                                        class="material-icons-outlined fs-5">check_circle</i>Nor again is there anyone
                                    who loves or pursues
                                    or desires to obtain pain of itself, because it is pain, but because occasionally
                                    circumstances occur
                                    in which toil and pain can procure him some great pleasure</p>
                            </div>
                            <div class="mt-4">
                                <!-- <a href="javascript:;" class="btn btn-grd btn-grd-primary">Read More</a> -->
                                <a href="javascript:;"
                                    class="btn btn-grd btn-grd-primary rounded-5 d-flex align-items-center gap-2 raised px-4">
                                    Read More<i class="material-icons-outlined">east</i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <!-- <img src="assets/images/gallery/24.png" class="img-fluid img-thumbnail rounded-4 bg-grd-warning" alt=""> -->
                            <img src="assets/images/banners/widget-1.png"
                                class="img-fluid img-thumbnail rounded-4 bg-grd-warning" alt="">
                        </div>
                    </div><!--end row-->
                </div>
            </section>
            <!--end about us-->

            <!--start services-->
            <section class="py-5" id="Services">
                <div class="container py-4 px-4 px-lg-0">
                    <div class="section-title text-center mb-5">
                        <h1 class="mb-0 section-title-name">Services</h1>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                        <div class="col d-flex">
                            <div class="card rounded-4 mb-0 w-100">
                                <div class="card-body text-center p-4">
                                    <div class="d-flex flex-column gap-4">
                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-primary text-white flex-shrink-0 mx-auto">
                                            <i class="material-icons-outlined fs-2">favorite_border</i>
                                        </div>
                                        <div class="">
                                            <h5>Asperiores Commodit</h5>
                                            <p class="mb-0">Non et temporibus minus omnis sed dolor esse consequatur.
                                                Cupiditate sed error ea fuga sit provident adipisci neque.</p>
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
                                            class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-danger text-white flex-shrink-0 mx-auto">
                                            <i class="material-icons-outlined fs-2">card_membership</i>
                                        </div>
                                        <div class="">
                                            <h5>Velit Doloremque</h5>
                                            <p class="mb-0">Cumque et suscipit saepe. Est maiores autem enim facilis
                                                ut aut ipsam corporis
                                                aut.
                                                Sed animi at autem alias eius labore.</p>
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
                                            <h5>All Variations</h5>
                                            <p class="mb-0">Provident nihil minus qui consequatur non omnis maiores.
                                                Eos accusantium minus dolores iure perferendis tempore et consequatur.
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
                                            class="d-flex align-items-center justify-content-center rounded-circle wh-64 bg-grd-branding text-white flex-shrink-0 mx-auto">
                                            <i class="material-icons-outlined fs-2">account_balance</i>
                                        </div>
                                        <div class="">
                                            <h5>Nesciunt Mete</h5>
                                            <p class="mb-0">Provident nihil minus qui consequatur non omnis maiores.
                                                Eos accusantium minus dolores iure perferendis tempore et consequatur.
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
                                            <h5>Ledo Markt</h5>
                                            <p class="mb-0">Ut excepturi voluptatem nisi sed. Quidem fuga
                                                consequatur.
                                                Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
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
                                            <h5>Eosle Commodi</h5>
                                            <p class="mb-0">Ut autem aut autem non a. Sint sint sit facilis nam iusto
                                                sint.
                                                Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </section>
            <!--end services-->

            <!--start team-->
            <section class="py-5 bg-section" id="Team">
                <div class="container py-4 px-4 px-lg-0">
                    <div class="section-title text-center mb-5">
                        <h1 class="mb-0 section-title-name">Team</h1>
                    </div>

                    <div class="row row-cols-1 row-cols-xl-2 g-4">
                        <div class="col">
                            <div class="card mb-0 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-column flex-lg-row align-items-center gap-4">
                                        <div class="">
                                            <img src="https://placehold.co/120x120/png" width="120" height="120"
                                                class="rounded-circle p-1 bg-white bg-grd-warning" alt="">
                                        </div>
                                        <div class="profile-info">
                                            <div class="my-4">
                                                <h3 class="mb-1">Sarah Jhonson</h3>
                                                <p class="mb-3 fs-6">UI Developer</p>
                                                <p class="mb-0">Explicabo voluptatem mollitia et repellat qui dolorum
                                                    quasi</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start gap-3">
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-deep-blue text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-linkedin fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-info text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-facebook fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-danger text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-youtube fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-voilet text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-twitter-x fs-5"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-0 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-column flex-lg-row align-items-center gap-4">
                                        <div class="">
                                            <img src="https://placehold.co/120x120/png" width="120" height="120"
                                                class="rounded-circle p-1 bg-white bg-grd-danger" alt="">
                                        </div>
                                        <div class="profile-info">
                                            <div class="my-4">
                                                <h3 class="mb-1">Pauline Roman</h3>
                                                <p class="mb-3 fs-6">Graphic Designer</p>
                                                <p class="mb-0">Explicabo voluptatem mollitia et repellat qui dolorum
                                                    quasi</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start gap-3">
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-deep-blue text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-linkedin fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-info text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-facebook fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-danger text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-youtube fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-voilet text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-twitter-x fs-5"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-0 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-column flex-lg-row align-items-center gap-4">
                                        <div class="">
                                            <img src="https://placehold.co/120x120/png" width="120" height="120"
                                                class="rounded-circle p-1 bg-white bg-grd-primary" alt="">
                                        </div>
                                        <div class="profile-info">
                                            <div class="my-4">
                                                <h4 class="mb-1">David Buckley</h4>
                                                <p class="mb-3">Android Developer</p>
                                                <p class="mb-0">Explicabo voluptatem mollitia et repellat qui dolorum
                                                    quasi</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start gap-3">
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-deep-blue text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-linkedin fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-info text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-facebook fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-danger text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-youtube fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-voilet text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-twitter-x fs-5"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-0 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-column flex-lg-row align-items-center gap-4">
                                        <div class="">
                                            <img src="https://placehold.co/120x120/png" width="120" height="120"
                                                class="rounded-circle p-1 bg-white bg-grd-success" alt="">
                                        </div>
                                        <div class="profile-info">
                                            <div class="my-4">
                                                <h4 class="mb-1">Amanda Jepson</h4>
                                                <p class="mb-3">Product Manager</p>
                                                <p class="mb-0">Explicabo voluptatem mollitia et repellat qui dolorum
                                                    quasi</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start gap-3">
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-deep-blue text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-linkedin fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-info text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-facebook fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-danger text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-youtube fs-5"></i></a>
                                                <a href="javascript:;"
                                                    class="wh-42 bg-grd-voilet text-white rounded-circle d-flex align-items-center justify-content-center"><i
                                                        class="bi bi-twitter-x fs-5"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </section>
            <!--end team-->
        </div>

    <!--start footer strip-->
    <footer class="page-footer">
        <p class="mb-0">PTI Copyright ©{{ date('Y') }}. All right reserved.</p>
    </footer>
    <!--end footer strip-->


    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class="material-icons-outlined">arrow_upward</i></a>
    <!--End Back To Top Button-->


    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
@endsection

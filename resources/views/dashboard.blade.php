@extends('layouts.app')

<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    {{-- <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analysis</li>
                    </ol> --}}
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <!-- Full width Name Card -->
        <div class="row">
            <div class="col-12">
                <div class="card w-100 overflow-hidden rounded-4">
                    <div class="card-body position-relative p-4">
                        <div class="row">
                            <div class="col-12 col-sm-7">
                                <div class="d-flex align-items-center gap-3 mb-5">
                                    <div>
                                        <p class="mb-0 fw-semibold">Selamat Datang !</p>
                                        <h4 class="fw-semibold mb-0 fs-4">{{ Auth::user()->name }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-5">
                                    <div>
                                        <h4 class="mb-1 fw-semibold d-flex align-content-center">
                                            {{ $totalCustomers }}
                                            <i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                        </h4>
                                        <p class="mb-3">Total Jumlah pelanggan</p>
                                    </div>
                                    <div class="vr"></div>
                                    {{-- <div>
                                        <h4 class="mb-1 fw-semibold d-flex align-content-center">
                                            78.4%
                                            <i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                        </h4>
                                        <p class="mb-3">Growth Rate</p>
                                        <div class="progress mb-0" style="height:5px;">
                                            <div class="progress-bar bg-grd-danger" role="progressbar"
                                                style="width: 60%"></div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-12 col-sm-5">
                                <div class="welcome-back-img pt-4">
                                    <img src="assets/images/gallery/welcome-back-3.png" height="180" alt="">
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Other widgets below -->
        <div class="row mt-4">
            <!-- Widget Pembayaran bulan ini -->
            <div class="col-xl-6 col-xxl-4 d-flex align-items-stretch">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start justify-content-between">
                                <h5 class="mb-0">Pembayaran Bulan ini</h5>
                            </div>
                            <div class="position-relative">
                                <div class="piechart-legend">
                                    <h2 class="mb-1">{{ $persenBayar }}</h2>
                                    <h6 class="mb-0">dibayar</h6>
                                </div>
                                <div id="chart6"></div>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 d-flex align-items-center gap-2 w-25">
                                        <span class="material-icons-outlined fs-6 text-primary">desktop_windows</span>
                                        Sudah&nbsp;Bayar
                                    </p>
                                    <p class="mb-0">{{ $persenBayar }}%</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 d-flex align-items-center gap-2 w-25">
                                        <span class="material-icons-outlined fs-6 text-danger">tablet_mac</span>
                                        Belum&nbsp;Bayar
                                    </p>
                                    <p class="mb-0">{{ $persenBelum }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tren Pendapatan-->
            <div class="col-xl-6 col-xxl-4 d-flex align-items-stretch">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <div class="text-center">
                            <h6 class="mb-0">Tren Pendapatan</h6>
                        </div>
                        <div class="mt-4" id="chart5"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
</main>
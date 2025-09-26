@extends('layouts.app')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
    <div class="breadcrumb-title pe-3">Detail Pelanggan</div>
    <div class="ps-3 flex-grow-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('master.pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card p-2">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{asset('assets/images/avatars/01.png')}}" class="rounded-circle" width="100"
                            height="100" alt="">
                    </div>
                    <h4 class="text-center">{{$customer->name}}</h4>
                    <h5 class="text-center">{{$customer->phone_number}}</h5>
                    <p class="text-center">{{$customer->address}}</p>
                </div>
                <div class="col-md-9">
                    <select class="form-control">
                        @for ($i=date('Y'); $i >= 2024; $i--)
                            <option value="{{ $i }}">{{$i}}</option>
                        @endfor
                    </select>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Meteran</th>
                                    <th>Selisih Bulan Lalu</th>
                                    <th>Status Pembayaran</th>
                                    <th>Tagihan (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Januari</th>
                                    <td>1.000</td>
                                    <td>1.000</td>
                                    <td>
                                        <span class="badge bg-success">Sudah Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Februari</th>
                                    <td>1.200</td>
                                    <td>200</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Maret</th>
                                    <td>1.300</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>April</th>
                                    <td>1.400</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mei</th>
                                    <td>1.500</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Juni</th>
                                    <td>1.600</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Juli</th>
                                    <td>1.700</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Agustus</th>
                                    <td>1.800</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>September</th>
                                    <td>1.900</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Oktober</th>
                                    <td>2.000</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>November</th>
                                    <td>2.100</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                                <tr>
                                    <th>Desember</th>
                                    <td>2.200</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    </td>
                                    <td>
                                        1.200.000
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center">Total</th>
                                    <th>2.000.000</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

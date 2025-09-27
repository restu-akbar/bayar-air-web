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
                    <form method="GET" action="">
                        <select class="form-control" onchange="this.form.submit()" name="tahun">
                            @for ($i=date('Y'); $i >= 2024; $i--)
                            <option value="{{ $i }}" {{ request()->get('tahun', date('Y')) == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                            @endfor
                        </select>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Bulan</th>
                                    <th class="text-center">Meteran (M<sup>3</sup>)</th>
                                    <th class="text-center">Pemakaian (M<sup>3</sup>)</th>
                                    <th class="text-center">Status Pembayaran</th>
                                    <th class="text-center">Tagihan (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($recap)
                                <tr>
                                    <th>Januari</th>
                                    <td class="text-end">{{ number_format($recap?->meter_jan, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_jan, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_jan == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_jan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Februari</th>
                                    <td class="text-end">{{ number_format($recap?->meter_feb, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_feb, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_feb == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_feb, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Maret</th>
                                    <td class="text-end">{{ number_format($recap?->meter_mar, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_mar, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_mar == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_mar, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>April</th>
                                    <td class="text-end">{{ number_format($recap?->meter_apr, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_apr, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_apr == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_apr, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Mei</th>
                                    <td class="text-end">{{ number_format($recap?->meter_mei, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_mei, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_mei == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_mei, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Juni</th>
                                    <td class="text-end">{{ number_format($recap?->meter_jun, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_jun, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_jun == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_jun, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Juli</th>
                                    <td class="text-end">{{ number_format($recap?->meter_jul, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_jul, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_jul == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_jul, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Agustus</th>
                                    <td class="text-end">{{ number_format($recap?->meter_agu, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_agu, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_agu == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_agu, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>September</th>
                                    <td class="text-end">{{ number_format($recap?->meter_sep, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_sep, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_sep == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_sep, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Oktober</th>
                                    <td class="text-end">{{ number_format($recap?->meter_okt, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_okt, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_okt == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_okt, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>November</th>
                                    <td class="text-end">{{ number_format($recap?->meter_nov, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_nov, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_nov == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_nov, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Desember</th>
                                    <td class="text-end">{{ number_format($recap?->meter_des, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($recap?->pakai_des, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($recap?->status_des == 'sudah_bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                        @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($recap?->bayar_des, 0, ',', '.') }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="5">
                                        Tidak Ada Data
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-end">{{ number_format($recap?->meter_des ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-end">
                                        {{ number_format(
                                        ($recap?->pakai_jan ?? 0) +
                                        ($recap?->pakai_feb ?? 0) +
                                        ($recap?->pakai_mar ?? 0) +
                                        ($recap?->pakai_apr ?? 0) +
                                        ($recap?->pakai_mei ?? 0) +
                                        ($recap?->pakai_jun ?? 0) +
                                        ($recap?->pakai_jul ?? 0) +
                                        ($recap?->pakai_agu ?? 0) +
                                        ($recap?->pakai_sep ?? 0) +
                                        ($recap?->pakai_okt ?? 0) +
                                        ($recap?->pakai_nov ?? 0) +
                                        ($recap?->pakai_des ?? 0),
                                        0, ',', '.'
                                        ) }}
                                    </td>
                                    <td>-</td>
                                    <td class="text-end">
                                        {{ number_format(
                                        ($recap?->bayar_jan ?? 0) +
                                        ($recap?->bayar_feb ?? 0) +
                                        ($recap?->bayar_mar ?? 0) +
                                        ($recap?->bayar_apr ?? 0) +
                                        ($recap?->bayar_mei ?? 0) +
                                        ($recap?->bayar_jun ?? 0) +
                                        ($recap?->bayar_jul ?? 0) +
                                        ($recap?->bayar_agu ?? 0) +
                                        ($recap?->bayar_sep ?? 0) +
                                        ($recap?->bayar_okt ?? 0) +
                                        ($recap?->bayar_nov ?? 0) +
                                        ($recap?->bayar_des ?? 0),
                                        0, ',', '.'
                                        ) }}
                                    </td>
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

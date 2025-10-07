@extends('layouts.app')
@section('content')

{{-- bread crumb --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
    <div class="breadcrumb-title pe-3">Pelanggan</div>
        <div class="ps-3 flex-grow-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">edit</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="card">
    <div class="card p-2">
        <div class="card-body p-4">
            <h5 class="mb-4">Form Edit Pelanggan</h5>
            <form action="{{ route('laporan.update_laporan', $meterRecord->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Nama --}}
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               placeholder="Masukkan nama pelanggan"
                               readonly
                               value="{{ old('name', $customer->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="row mb-3">
                    <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control"
                                  id="address"
                                  name="address"
                                  rows="2"
                                  readonly
                                  placeholder="Masukkan alamat pelanggan">{{ old('address', $customer->address) }}</textarea>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div class="row mb-3">
                    <label for="phone_number" class="col-sm-3 col-form-label">Nomor HP</label>
                    <div class="col-sm-9">
                        <input type="text"
                               class="form-control"
                               id="phone_number"
                               name="phone_number"
                               placeholder="Masukkan nomor handphone"
                               readonly
                               value="{{ old('phone_number', $customer->phone_number) }}">
                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- RT & RW --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">RT / RW</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rt" name="rt"
                                    placeholder="Masukkan RT" 
                                    readonly
                                    value="{{ old('rt', $customer->rt) }}">
                                @error('rt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rw" name="rw"
                                    placeholder="Masukkan RW"
                                    readonly
                                    value="{{ old('rw', $customer->rw) }}">
                                @error('rw')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Meter Record Form --}}
                <hr>
                <h5 class="mb-3">Data Pencatatan</h5>

                {{-- Meter Sebelumnya --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Meter Sebelumnya</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" id="prev_meter" name="prev_meter"
                            value="{{ $previousMeter ?? 0 }}" readonly>
                    </div>
                </div>

                {{-- Meter Sekarang --}}
                <div class="row mb-3">
                    <label for="meter" class="col-sm-3 col-form-label">Meter</label>
                    <div class="col-sm-9">
                        <input type="number" step="1" class="form-control" id="meter" name="meter"
                            value="{{ old('meter', $meterRecord->meter) }}" required>
                        @error('meter') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- Usage --}}
                <div class="row mb-3">
                    <label for="usage" class="col-sm-3 col-form-label">Pemakaian (m³)</label>
                    <div class="col-sm-9">
                        <input type="number" step="1" class="form-control" id="usage" name="usage"
                            value="{{ old('usage', $meterRecord->usage) }}" required>
                        @error('usage') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- Fine / Denda --}}
                <div class="row mb-3">
                    <label for="fine" class="col-sm-3 col-form-label">Denda</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="fine" name="fine"
                            value="{{ old('fine', $meterRecord->fine) }}">
                    </div>
                </div>

                {{-- Duty Stamp / Materai --}}
                <div class="row mb-3">
                    <label for="duty_stamp" class="col-sm-3 col-form-label">Materai</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="duty_stamp" name="duty_stamp"
                            value="{{ old('duty_stamp', $meterRecord->duty_stamp) }}">
                    </div>
                </div>

                {{-- Retribution Fee --}}
                <div class="row mb-3">
                    <label for="retribution_fee" class="col-sm-3 col-form-label">Retribusi</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="retribution_fee" name="retribution_fee"
                            value="{{ old('retribution_fee', $meterRecord->retribution_fee) }}">
                    </div>
                </div>

                {{-- Status --}}
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="status" id="status" required>
                            <option value="belum_bayar" {{ $meterRecord->status == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="sudah_bayar" {{ $meterRecord->status == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                        </select>
                    </div>
                </div>

                {{-- Current Price Info --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Harga per m³</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" readonly
                                    value="Rp {{ number_format($setPrice->price ?? 0 , 0, ',', '.') }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" readonly
                                    value="Admin Fee: Rp {{ number_format($setPrice->admin_fee ?? 0, 0, ',', '.') }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Total Pembayaran</label>
                    <div class="col-sm-9">

                        @if ($isFirstRecord)
                            {{-- Indikator data pertama --}}
                            <div class="alert alert-warning py-2">
                                <i class="bx bx-info-circle"></i>
                                Data ini merupakan <strong>catatan pertama</strong> untuk pelanggan ini.
                                Total dapat diubah secara manual.
                            </div>

                            <input type="number" class="form-control" step="500" id="total_amount" name="total_amount"
                                value="{{ old('total_amount', $meterRecord->total_amount) }}">
                        @else
                            <input type="text" class="form-control" id="total_amount" name="total_amount"
                                readonly value="{{ old('total_amount', $meterRecord->total_amount) }}">
                        @endif

                    </div>
                </div>


                {{-- Evidence Image --}}
                <div class="row mb-4">
                    <label class="col-sm-3 col-form-label">Bukti Foto Meter</label>
                    <div class="col-sm-9">
                        <img src="{{ asset('storage/'.$meterRecord->evidence) }}" alt="Bukti Foto" class="img-fluid rounded" width="300">
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('laporan.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const isFirstRecord = @json($isFirstRecord);
    const prevMeterInput = document.getElementById('prev_meter');
    const meterInput = document.getElementById('meter');
    const usageInput = document.getElementById('usage');
    const totalAmountInput = document.getElementById('total_amount');

    const price = {{ $setPrice->price ?? 0 }};
    const adminFee = {{ $setPrice->admin_fee ?? 0 }};

    function updateUsageAndTotal() {
        const prev = parseFloat(prevMeterInput.value) || 0;
        const current = parseFloat(meterInput.value) || 0;
        const usage = Math.max(current - prev, 0);
        usageInput.value = usage;

        if (!isFirstRecord) {
            const total = (usage * price) + adminFee;
            totalAmountInput.value = total.toLocaleString('id-ID');
        }
    }

    updateUsageAndTotal();
    meterInput.addEventListener('input', updateUsageAndTotal);
});
</script>


@endsection

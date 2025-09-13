@extends('layouts.app')
@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Data Master</h5>
                    <form action="{{ route('setting.store') }}" method="POST" class="row g-3">
                        @csrf
                        {{-- Data Pada Saat Ini --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Data Pada Saat Ini</label>
                            <div class="p-3 border rounded bg-light">
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">Harga per kubik</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="{{ number_format($setting->price ?? 0, 0, ',', '.') }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Biaya Admin</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="{{ number_format($setting->admin_fee ?? 0, 0, ',', '.') }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-2">Ubah Data Master</h5>

                        {{-- Harga per kubik --}}
                        <div class="col-md-12">
                            <label for="price" class="form-label">Harga per kubik</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Masukkan harga dasar air per m³"
                                value="{{ old('price', $setting->price ?? '') }}"
                                oninput="handleInput('price','priceFormat')">
                            <small id="priceFormat" class="text"></small>
                            <div class="mt-2">
                                <button type="button" class="btn btn-outline-primary"
                                    onclick="changeValue('price','priceFormat',1000,'increment')">+1.000</button>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="changeValue('price','priceFormat',1000,'decrement')">-1.000</button>
                            </div>
                        </div>

                        {{-- Biaya Admin --}}
                        <div class="col-md-12">
                            <label for="admin_fee" class="form-label">Biaya Admin</label>
                            <input type="text" class="form-control" id="admin_fee" name="admin_fee"
                                placeholder="Biaya admin" value="{{ old('admin_fee', $setting->admin_fee ?? '') }}"
                                oninput="handleInput('admin_fee','adminFeeFormat')">
                            <small id="adminFeeFormat" class="text"></small>
                            <div class="mt-2">
                                <button type="button" class="btn btn-outline-primary"
                                    onclick="changeValue('admin_fee','adminFeeFormat',500,'increment')">+500</button>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="changeValue('admin_fee','adminFeeFormat',500,'decrement')">-500</button>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                                <button type="reset" class="btn btn-grd-royal px-4">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatNumber(number) {
            return 'Rp' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function handleInput(inputId, displayId) {
            const input = document.getElementById(inputId);
            input.value = input.value.replace(/[^0-9]/g, ''); // hanya angka
            document.getElementById(displayId).textContent =
                input.value ? formatNumber(input.value) : '';
        }

        function changeValue(inputId, displayId, step, action) { // Button increment decrement
            const input = document.getElementById(inputId);
            let value = parseInt(input.value) || 0;
            if (action === 'increment') value += step;
            if (action === 'decrement' && value >= step) value -= step;
            input.value = value;
            document.getElementById(displayId).textContent =
                value ? formatNumber(value) : '';
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            handleInput('price', 'priceFormat');
            handleInput('admin_fee', 'adminFeeFormat');
        });
    </script>
@endsection

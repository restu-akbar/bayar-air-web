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
            <form action="{{ route('master.pelanggan.update', $customer->id) }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Nama --}}
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               placeholder="Masukkan nama pelanggan"
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
                                    placeholder="Masukkan RT" value="{{ old('rt', $customer->rt) }}">
                                @error('rt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rw" name="rw"
                                    placeholder="Masukkan RW" value="{{ old('rw', $customer->rw) }}">
                                @error('rw')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('master.pelanggan.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

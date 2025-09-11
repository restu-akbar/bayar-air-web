@extends('layouts.app')
@section('content')
    <div class="card p-2">
        <div class="card-body p-4">
            <h5 class="mb-4">Form pengeditan user</h5>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Masukan nama</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama" value="{{ old('name', $user->name) }}">
                            <span class="position-absolute top-50 translate-middle-y"><i class="material-icons-outlined fs-5">person_outline</i></span>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Masukan username</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" value="{{ old('username', $user->username) }}">
                            <span class="position-absolute top-50 translate-middle-y"><i class="material-icons-outlined fs-5">person_outline</i></span>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="phone_number" class="col-sm-3 col-form-label">Nomor handphone</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Nomor handphone" value="{{ old('phone_number', $user->phone_number) }}">
                            <span class="position-absolute top-50 translate-middle-y"><i class="material-icons-outlined fs-5">phone</i></span>
                            @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
                            <span class="position-absolute top-50 translate-middle-y"><i class="material-icons-outlined fs-5">send</i></span>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Masukan Password</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password (kosongkan jika tidak ingin mengubah)">
                            <span class="position-absolute top-50 translate-middle-y"><i class="material-icons-outlined fs-5">vpn_key</i></span>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="role_name" class="col-sm-3 col-form-label">Pilih Role</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="role_name" name="role_name">
                            <option value="" {{ old('role_name', $user->role_name) ? '' : 'selected' }}>Pilih Role</option>
                            <option value="admin" {{ old('role_name', $user->role_name) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="teknisi" {{ old('role_name', $user->role_name) == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        </select>
                        @error('role_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
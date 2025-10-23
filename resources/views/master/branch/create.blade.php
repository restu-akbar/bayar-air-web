@extends('layouts.app')

@section('content')
{{-- Bread crumb --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
    <div class="breadcrumb-title pe-3">Branch</div>
    <div class="ps-3 flex-grow-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.branch.index') }}">Branch</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card p-2">
        <div class="card-body p-4">
            <h5 class="mb-4">Form Pembuatan Branch</h5>

            <form action="{{ route('master.branch.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Nama Branch</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Masukkan nama branch" 
                                   value="{{ old('name') }}">
                            <span class="position-absolute top-50 translate-middle-y">
                                <i class="material-icons-outlined fs-5">store</i>
                            </span>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                            <button type="reset" class="btn btn-secondary px-4">Reset</button>
                            <a href="{{ route('master.branch.index') }}" class="btn px-4">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

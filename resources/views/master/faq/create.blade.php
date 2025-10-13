@extends('layouts.app')
@section('content')
    {{-- Breadcrumb --}}
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
        <div class="breadcrumb-title pe-3">FAQ</div>
        <div class="ps-3 flex-grow-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('master.faq.index') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah FAQ</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Tambah FAQ Baru</h5>

            <form action="{{ route('master.faq.store') }}" method="POST">
                @csrf

                {{-- Pertanyaan --}}
                <div class="row mb-3">
                    <label for="question" class="col-sm-3 col-form-label">Pertanyaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="question" name="question"
                            value="{{ old('question') }}" placeholder="Masukkan pertanyaan">
                        @error('question')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Jawaban --}}
                <div class="row mb-3">
                    <label for="answer" class="col-sm-3 col-form-label">Jawaban</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="answer" name="answer" rows="2" placeholder="Masukkan jawaban">{{ old('answer') }}</textarea>
                        @error('answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Platform --}}
                <div class="row mb-3">
                    <label for="platform" class="col-sm-3 col-form-label">Pilih Platform</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="platform" name="platform">
                            <option value="" {{ old('platform') ? '' : 'selected' }}>Pilih Platform</option>
                            <option value="web" {{ old('platform') == 'web' ? 'selected' : '' }}>web</option>
                            <option value="mobile" {{ old('platform') == 'mobile' ? 'selected' : '' }}>mobile</option>
                        </select>
                        @error('platform')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            <button type="reset" class="btn btn-secondary px-4">Reset</button>
                            <a href="{{ route('master.faq.index') }}" class="btn px-4">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

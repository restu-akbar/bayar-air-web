@extends('layouts.app')

@section('content')

{{-- bread crumb --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Pelanggan</div>
        <div class="ps-3 flex-grow-1">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('master.pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </div>
        <div class="gap-2 d-flex">
        {{-- Dropdown Import --}}
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i></i> Import
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('master.pelanggan.import.template') }}">
                        <i class="bi bi-download me-2"></i> Download Template
                    </a>
                </li>
                <li>
                    <label class="dropdown-item mb-0" for="importFile">
                        <i class="bi bi-upload me-2"></i> Import User
                    </label>
                    <form id="importForm" action="{{ route('master.pelanggan.import.process') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                        @csrf
                        <input type="file" id="importFile" name="file" accept=".xlsx,.csv" onchange="document.getElementById('importForm').submit()">
                    </form>
                </li>
            </ul>
        </div>

        {{-- Tambah Pelanggan --}}
        <a href="{{ route('master.pelanggan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pelanggan
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="pelanggan-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>RT/RW</th>
                        <th>Tanggal dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
{{-- Script to load DataTables resources --}}
<script>
    (function() {
        // console.log('Resource loader started');

        // Load CSS jika hilang
        if (!document.querySelector('link[href*="datatables.net"]')) {
            let css = document.createElement('link');
            css.rel = 'stylesheet';
            css.href = 'https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css';
            document.head.appendChild(css);
        }

        // Helper to load external scripts sequentially
        function loadExternalScript(sourceUrl, callback) {
            let scriptElement = document.createElement('script');
            scriptElement.src = sourceUrl;
            scriptElement.onload = callback;
            scriptElement.onerror = () => console.error('Failed to load', sourceUrl);
            document.head.appendChild(scriptElement);
        }

        // Tunggu sampai jQuery ready
        function waitForJquery(whenReady) {
            if (window.jQuery) {
                whenReady();
            } else {
                setTimeout(() => waitForJquery(whenReady), 50);
            }
        }

        // Load DataTables scripts jika belum ada
        waitForJquery(() => {
            if (!window.jQuery.fn || !window.jQuery.fn.dataTable) {
                loadExternalScript('https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js', () => {
                    loadExternalScript('https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js', () => {
                        document.dispatchEvent(new Event('DataTablesReady'));
                    });
                });
            } else {
                document.dispatchEvent(new Event('DataTablesReady'));
            }
        });
    })();
</script>

{{-- Script to initialize the DataTable --}}
<script>
    document.addEventListener('DataTablesReady', function() {
        console.log('Init DataTable...');
        $('#pelanggan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.pelanggan.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'phone_number', name: 'phone_number' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.rt + '/' + row.rw;
                    },
                    orderable: false,
                    searchable: false
                },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable:false, searchable:false }
            ]
        });
    });
</script>
@endsection

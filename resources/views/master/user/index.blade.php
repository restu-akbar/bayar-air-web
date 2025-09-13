@extends('layouts.app')
@section('content')
{{-- bread crumb --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
    <div class="breadcrumb-title pe-3 ms-4">User</div>
        <div class="ps-3 flex-grow-1">
            <nav aria-label="breadcrumb">
                {{-- <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Analysis</li>
                </ol> --}}
            </nav>
        </div>
    <a href="{{ route('user.create') }}" class="btn btn-primary ms-auto">
        <i class="bi bi-plus-lg"></i> Tambah User
    </a>
</div>

<div class="card m-3">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Daftar User</h5>  
        </div>
        <hr>
        <div class="table-responsive">
            <table id="user-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nomor Handphone</th>
                        <th>Role</th>
                        <th>Tanggal dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- Script to load DataTables resources --}}
<script>
    (function() {
        console.log('Resource loader started');

        // Load CSS jika ilang
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

        // Wait until jQuery is available
        function waitForJquery(whenReady) {
            if (window.jQuery) {
                whenReady();
            } else {
                setTimeout(() => waitForJquery(whenReady), 50);
            }
        }

        // Load DataTables scripts if not already present
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


{{-- Script to initialize the table --}}
<script>
    document.addEventListener('DataTablesReady', function() {
        console.log('Init DataTable...');
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.user.data') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'role_name', name: 'role_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable:false, searchable:false }
            ]
        });
    });
</script>

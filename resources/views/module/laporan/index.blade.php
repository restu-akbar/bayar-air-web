@extends('layouts.app')
@section('content')

{{-- bread crumb --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
    <div class="breadcrumb-title pe-3 ms-4">Laporan</div>
        <div class="ps-3 flex-grow-1">
            <nav aria-label="breadcrumb">
                {{-- <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Analysis</li>
                </ol> --}}
            </nav>
        </div>
</div>

    <div class="card m-3">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                <h5 class="card-title">Daftar Pencatatan</h5>
                <!-- Filter Section -->
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <label class="form-label mb-0 me-2">Filter Waktu:</label>

                    <div class="input-group">
                        <input type="date" id="start-date" class="form-control">
                        <span class="input-group-text">s/d</span>
                        <input type="date" id="end-date" class="form-control">
                        <button id="apply-date-filter" class="btn btn-primary btn-sm">
                            <i class="material-icons-outlined" style="font-size:16px;">filter_alt</i> Terapkan
                        </button>

                        <button id="reset-date-filter" class="btn btn-outline-secondary btn-sm">
                            <i class="material-icons-outlined" style="font-size:16px;">refresh</i> Reset
                        </button>
                    </div>


                </div>
            </div>
            <hr>
        <div class="table-responsive">
            <table id="user-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama pelanggan</th>
                        <th>Nama pencatat</th>
                        <th>meter</th>
                        <th>Total pembayaran</th>
                        <th>Tanggal dibuat</th>
                        <th>Status pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pencatatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr><th>Nama Pelanggan</th><td id="detail-customer"></td></tr>
          <tr><th>Nama Pencatat</th><td id="detail-user"></td></tr>
          <tr><th>Meter</th><td id="detail-meter"></td></tr>
          <tr><th>Total Pembayaran</th><td id="detail-total"></td></tr>
          <tr><th>Denda</th><td id="detail-fine"></td></tr>
          <tr><th>Materai</th><td id="detail-duty"></td></tr>
          <tr><th>Retribusi</th><td id="detail-retribution"></td></tr>
          <tr><th>Status pembayaran</th><td id="detail-status"></td></tr>
          <tr><th>Tanggal di catat</th><td id="detail-date"></td></tr>
        </table>
        <div class="text-center">
          <img id="detail-evidence" src="" alt="Bukti Foto" class="img-fluid rounded">
        </div>
      </div>
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

    let table = $('#user-table').DataTable({
        processing: true,
        serverSide: true,
         ajax: {
            url: "{{ route('laporan.data') }}",
            data: function (d) {
                d.start_date = $('#start-date').val(); 
                d.end_date   = $('#end-date').val();   
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'customer.name', name: 'customer.name' },
            { data: 'user.name', name: 'user.name' },
            { data: 'meter', name: 'meter' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable:false, searchable:false }
        ]
    });

    // Tombol Terapkan filter
    $('#apply-date-filter').on('click', function() {
        table.ajax.reload();
    });

    // Tombol Reset filter
    $('#reset-date-filter').on('click', function() {
        $('#start-date').val('');
        $('#end-date').val('');
        table.ajax.reload();
    });

    // Binding click event setelah tabel render
    $('#user-table').on('click', '.btn-detail', function() {
        let url = $(this).data('url');
        console.log("Fetch detail from:", url); // debug

        $.get(url, function(data) {
            $('#detail-customer').text(data.customer);
            $('#detail-user').text(data.user);
            $('#detail-meter').text(data.meter);
            $('#detail-total').text(data.total_amount);
            $('#detail-fine').text(data.fine);
            $('#detail-duty').text(data.duty_stamp);
            $('#detail-retribution').text(data.retribution_fee);
            $('#detail-date').text(data.created_at);
            $('#detail-status').text(data.status);
            $('#detail-evidence').attr('src', data.evidence);

            $('#detailModal').modal('show');
        });
    });
});
</script>




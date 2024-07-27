@extends('backend.layouts.app')
@section('backend_content')
    <div class="container">
        <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas>
        <form method="POST" action="{{ route('date.wise.payment.reports') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-2">
                    <input id="start_date" type="text" placeholder="start date" class="form-control datepicker "
                        name="start_date" value="" required>
                </div>
                <div class="col-md-2">
                    <input id="end_date" type="text" placeholder="end date" class="form-control datepicker"
                        name="end_date" value="" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered data-table table-striped text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Pnone</th>
                    <th>Fathers Phone</th>
                    <th>District</th>
                    <th>Course Name</th>
                    <th>Session</th>
                    <th>Uploded Document</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@push('member-scripts')
    <script>
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('all.student.table.report') }}",
            columns: [{
                    data: 'name'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'father_phone'
                },
                {
                    data: 'district'
                },
                {
                    data: 'course_name'
                },
                {
                    data: 'session'
                },
                {
                    data: 'type',
                    name: 'type',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            pageLength: 20,
            lengthMenu: [
                [5, 10, 20, 25, 50, -1],
                [5, 10, 20, 25, 50, "All"]
            ]
        });
    </script>
    <script>
        $(document).ready(function() {
            @if (Auth::user()->role === 'Account')
                var today = new Date();
                var startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1); // First day of last month
                var endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0); // Last day of this month

                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    startDate: startDate,
                    endDate: endDate
                });
            @else
                jQuery('.datepicker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                    todayBtn: 'linked'
                });
            @endif
        })
    </script>
@endpush
@push('custom-css')
    <style>
        .modal-body img {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }

        table.table-bordered.dataTable td:last-child {
            width: 200px;
        }

        .data-table {
            font-size: 13px;
        }

        .data-table td {
            padding: 0;
            text-align: center;
        }

        table.dataTable>thead>tr>th:not(.sorting_disabled) {
            padding-right: 0px;
        }
    </style>
@endpush

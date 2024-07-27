@extends('backend.layouts.app')
@section('backend_content')
    <div class="container">
        <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas>
        <form method="POST" action="{{ route('general.details.report') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-select" name="session" id="session">
                        <option selected disabled>Select Session</option>
                        @php
                            $startYear = 20;
                            $endYear = 33;
                        @endphp

                        @for ($year = $startYear; $year <= $endYear; $year++)
                            <option value="{{ $year }}">{{ $year }}-{{ $year + 1 }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="course_name" id="course_name" aria-label="Default select example">
                        <option selected disabled>Select Course</option>
                        @php
                            $courses = [
                                'Diploma in Nursing Science & Midwifery',
                                'Diploma in Midwifery',
                                'BSc Nursing (Post Basic)',
                                'BSc Nursing (Basic)',
                            ];
                        @endphp

                        @foreach ($courses as $course)
                            <option value="{{ $course }}">{{ $course }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </div>
        </form>
        {{-- <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" id="start_date" class="form-control datepicker" placeholder="Start Date">
        </div>
        <div class="col-md-3">
            <input type="text" id="end_date" class="form-control datepicker" placeholder="End Date">
        </div>
        <div class="col-md-3">
            <button id="generate_report" class="btn btn-primary">Generate Report</button>
        </div>
    </div> --}}
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
            ajax: "{{ route('all.student.table') }}",
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
            jQuery('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                todayBtn: 'linked'
            });
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

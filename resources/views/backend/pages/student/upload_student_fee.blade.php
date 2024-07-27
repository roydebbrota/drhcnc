@extends('backend.layouts.app')
@section('backend_content')
    <div class="container">
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 mt-5 pb-2 mb-3 border-bottom  bg-warning">
            <h1 class="h2 text-center">Collect Student Fees</h1>
        </div>

        <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas>
        <h4 class="text-center">User Details</h4>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Applied For</th>
                        <th scope="col">Email</th>
                        <th scope="col">Division</th>
                        <th scope="col">DIstrict</th>
                        <th scope="col">Village</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 20px 2px;">{{ 'STD' . $student->session . $student->id }}</td>
                        <td style="padding: 20px 2px;">{{ $student->name }}</td>
                        <td style="padding: 20px 2px;">
                            {{ $student->course_name . '(session ' . $student->session . '-' . (int) $student->session + 1 . ')' }}
                        </td>
                        <td style="padding: 20px 2px;">{{ $student->email }}</td>
                        <td style="padding: 20px 2px;">{{ $student->division_name }}</td>
                        <td style="padding: 20px 2px;">{{ $student->district_name }}</td>
                        <td style="padding: 20px 2px;">{{ $student->village }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas> --}}
        <h4 class="text-center px-2 py-3 alert-success">Collect Fees</h4>
        <form class="form-horizontal" method="post" action="{{ route('collect.fee') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="student_id" name="student_id" value="{{ $student->id }}" />
            <div class="card-body border">
                <div class="row">
                    <div class="form-group">
                        <div class="row mx-lg-4">
                            <div class="col-md-2 mb-3">
                                <select class="form-select" name="type" id="type" required>
                                    <option selected disabled>Select Type</option>
                                    @forelse ($feeTypes as $feeType)
                                        <option value="{{ $feeType->id }}">{{ $feeType->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input id="amount" type="number"
                                    class="form-control @error('amount') is-invalid @enderror" name="amount"
                                    value="{{ $studentId['amount'] ?? old('amount') }}" placeholder="Amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control datepicker" id="date" name="date"
                                    placeholder="DD-MM-YYYY">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <textarea type="note" class="form-control summernote" name="note" id="note"
                                    @error('note') is-invalid @enderror>{{ '' }}</textarea>

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-primary ">Collect</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas>
        <h4 class="text-center">Student Payment Details</h4>
        <h5 class="text-center bg-primary text-white py-2">
            {{ 'Contract Amount = ' . $student->contract_amount . ',' }}<canvas width="20"
                height="0"></canvas>{{ ' Paid Amount = ' . $paidFees + $onAdmisionFees . ',' }}
            <canvas width="20"
                height="0"></canvas>{{ ' Remaining Amount = ' . round($student->contract_amount - ( $paidFees + $onAdmisionFees), 2) }}<br>
            <hr>{{ $completedPayment }}
        </h5>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Collect for</th>
                        <th scope="col">Note</th>
                        <th scope="col">Collect by</th>
                        <th scope="col">Date of collection</th>
                        @if (Auth::user()->role == 'SuperAdmin')
                            <th scope="col">Actionn</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fees as $fee)
                        <tr>
                            <td style="padding: 20px 2px;">{{ $fee->fee_type_name }}</td>
                            <td style="padding: 20px 2px;">{{ $fee->amount }}</td>
                            <td style="padding: 20px 2px;">{{ date('j M Y', strtotime($fee->month)) }}</td>
                            <td style="padding: 20px 2px;">{{ $fee->note }}</td>
                            <td style="padding: 20px 2px;">{{ $fee->uploader_name }}</td>
                            <td style="padding: 20px 2px;">{{ date('j M Y', strtotime($fee->created_at)) }}</td>
                            @if (Auth::user()->role == 'SuperAdmin')

                                <td style="padding: 20px 2px;"><button type="submit" data-fees-id="{{ $fee->id }}" data-amount="{{ $fee->amount }}"
                                        data-fee_type_name="{{ $fee->fee_type_name }}" data-note="{{ $fee->note }}" data-date="{{ \Carbon\Carbon::parse($fee->month)->format('d-m-Y') }}"
                                        data-fee_type_id="{{ $fee->fee_type_id }}" class="btn btn-primary change-fees">
                                        {{ __('Change') }}
                                    </button></td>
                            @endif
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="updateFees" aria-hidden="true" aria-labelledby="updateFeesModalToggleLabelAdd"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-uppercase" id="updateFeesModalToggleLabelAdd"></h5>
                    <button type="button" class="btn-close single-doctor-schedule-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- @endif --}}
                <div class="modal-body">
                    <input type="hidden" id="fees_id"  value="" />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <select class="form-select" class="modal-select" name="u_type" id="u_type" required>
                                    <option id="option" selected value=""></option>
                                    @forelse ($feeTypes as $feeType)
                                        <option value="{{ $feeType->id }}">{{ $feeType->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-2 mb-3">
                                <input type="number"
                                    class="form-control modal-input @error('amount') is-invalid @enderror" id="u_amount"
                                    name="u_amount" value="" placeholder="Amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-2 mb-3">
                                <input type="text" class="form-control datepicker modal-input" id="u_date" name="u_date"
                                    placeholder="DD-MM-YYYY">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <textarea  class="form-control modal-text" name="u_note" id="u_note"></textarea>

                            </div>
                            <div class="col-lg-1 mb-3">
                                <button type="submit" class="btn btn-primary " id="u_submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-datepicker.min.css') }}">
    <style>
    </style>
@endpush
@push('custom-scripts')
    <script src="{{ asset('/backend/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 50,
                toolbar: [
                    // ['style', ['style']],
                    // ['font', ['bold', 'underline', 'clear']],
                    // ['color', ['color']],
                    // ['para', ['ul', 'ol', 'paragraph']],
                    // ['table', ['table']],
                    // ['insert', ['link', 'picture', 'video']],
                    // ['view', ['fullscreen', 'codeview', 'help']],
                    // ['height', ['height']]
                ]
            });
            @if ($userRole == 'Account')
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
            $(document).on('click', '.change-fees', function() {
                $("#option").val($(this).attr('data-fee_type_id'));
                $("#option").html($(this).attr('data-fee_type_name'));
                $("#u_amount").val($(this).attr('data-amount'));
                $("#u_note").html($(this).attr('data-note'));
                $("#u_date").val($(this).attr('data-date'));
                $("#fees_id").val($(this).attr('data-fees-id'));
                $('#updateFees').modal('show')
            })
            $(document).on('click', '#u_submit', function() {
                var obj = {};
                obj.amount = $('#u_amount').val();
                obj.note = $('#u_note').val();
                obj.date = $('#u_date').val();
                obj.fees_id = $('#fees_id').val();
                obj.fees_type = $('#u_type').val();
                console.log(obj);
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/fees-update",
                    type: "POST",
                    data: {
                        post_data: obj,
                        _token: _token
                    },
                    success: function(response) {
                        $('.modal-input').val('')
                        $('.modal-text').html('')
                        $('#updateFees').modal('hide')
                    },
                })
            })
        });
    </script>
@endpush

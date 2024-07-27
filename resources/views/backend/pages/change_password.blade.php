@extends('backend.layouts.app')
@section('backend_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class=" col-sm-12 mt-5">
        <div class="card mx-5 border-0">
            <div class="card-body ">
                <form class="form-horizontal" method="post" action="">
                    @csrf
                    <div class="card-body">
                        <h4 class="text-center alert-success py-3">Change Password</h4>
                        <div class="row">
                            <div class="form-group  pb-4 col-md-6">
                                <label for="old_password" class=" control-label col-form-label">Current Password</label>
                                <div class="">
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                        id="old_password" name="old_password">
                                </div>
                            </div>
                            <div class="form-group  pb-4 col-md-6">
                                <label for="model" class=" control-label col-form-label">New Password</label>
                                <div class="">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="form-group  pb-4 col-md-6">
                                <label for="password-confirm" class=" control-label col-form-label">Confirm Password</label>
                                <div class="">
                                    <input type="password" class="form-control" id="password-confirm"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush

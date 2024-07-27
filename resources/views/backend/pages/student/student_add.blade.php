@extends('backend.layouts.app')
@section('backend_content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card ">
                <h3 class="fw-bold card-header text-center bg-warning">{{ __('Application Form') }}</h3>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="course_name"
                                class="col-md-3 col-form-label text-md-end">{{ __('Application For') }}<span
                                    class= "text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="form-select" name="course_name" id="course_name"
                                    aria-label="Default select example">
                                    <option selected disabled>Select Course</option>
                                    <option value="Diploma in Nursing Science & Midwifery">Diploma in Nursing Science &
                                        Midwifery</option>
                                    <option value="Diploma in Midwifery">Diploma in Midwifery</option>
                                    <option value="BSc Nursing (Post Basic)">BSc Nursing (Post Basic)</option>
                                    <option value="BSc Nursing (Basic)">BSc Nursing (Basic)</option>
                                </select>

                                @error('course_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="session"
                                class="col-md-3 col-form-label text-md-end">{{ __('Application For Session') }}<span
                                    class= "text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="form-select" name="session" id="session">
                                    <option selected disabled>Select Session</option>
                                    <option value="20">20-21</option>
                                    <option value="21">21-22</option>
                                    <option value="22">22-23</option>
                                    <option value="23">23-24</option>
                                    <option value="24">24-25</option>
                                    <option value="25">25-26</option>
                                    <option value="26">26-27</option>
                                    <option value="27">27-28</option>
                                    <option value="28">28-29</option>
                                    <option value="29">29-30</option>
                                    <option value="30">30-31</option>
                                    <option value="31">31-32</option>
                                    <option value="32">32-33</option>
                                    <option value="33">33-34</option>
                                </select>

                                @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-3 col-form-label text-md-end">{{ __('Applicant Name (English)') }}<span
                                    class= "text-danger">*</span></label>
                            <div class="col-md-8">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name_bangla"
                                class="col-md-3 col-form-label text-md-end">{{ __('Applicant Name (Bangla)') }}</label>
                            <div class="col-md-8">
                                <input id="name_bangla" type="text"
                                    class="form-control @error('name_bangla') is-invalid @enderror" name="name_bangla"
                                    value="{{ old('name_bangla') }}" autofocus>

                                @error('name_bangla')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="father"
                                class="col-md-3 col-form-label text-md-end">{{ __("Father's Name") }}<span
                                    class= "text-danger">*</span></label>
                            <div class="col-md-8">
                                <input id="father" type="text"
                                    class="form-control @error('father') is-invalid @enderror" name="father"
                                    value="{{ old('father') }}" required autofocus>

                                @error('father')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mother"
                                class="col-md-3 col-form-label text-md-end">{{ __("Mothers's Name") }}<span
                                    class= "text-danger">*</span></label>
                            <div class="col-md-8">
                                <input id="mother" type="text"
                                    class="form-control @error('mother') is-invalid @enderror" name="mother"
                                    value="{{ old('mother') }}" required autofocus>

                                @error('mother')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone"
                                class="col-md-3 col-form-label text-md-end">{{ __('Mobile Number (Applicant)') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" required autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="father_phone"
                                class="col-md-3 col-form-label text-md-end">{{ __("Mobile Number (Father's)") }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <input id="father_phone" type="text"
                                    class="form-control @error('father_phone') is-invalid @enderror" name="father_phone"
                                    value="{{ old('father_phone') }}" required autofocus>

                                @error('father_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_of_birth"
                                class="col-md-3 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                            <div class="col-md-8">
                                <input id="date_of_birth" type="text"
                                    class="form-control datepicker @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" value="{{ old('date_of_birth') }}" required autofocus>

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="blood_group"
                                class="col-md-3 col-form-label text-md-end">{{ __('Blood Group') }}</label>

                            <div class="col-md-8">
                                <input id="blood_group" type="text"
                                    class="form-control @error('blood_group') is-invalid @enderror" name="blood_group"
                                    value="{{ old('blood_group') }}" required autofocus>

                                @error('blood_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nid_birth_reg"
                                class="col-md-3 col-form-label text-md-end">{{ __('NID/Birth Registration') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <select class="form-select" name="nid_birth_reg" id="nid_birth_reg" required>
                                    <option selected disabled>Select NID/Birth Registration</option>
                                    <option value="NID">NID</option>
                                    <option value="Birth Registration">Birth Registration</option>
                                </select>

                                @error('nid_birth_reg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nid_birth_reg_num"
                                class="col-md-3 col-form-label text-md-end">{{ __('NID/Birth Registration No.') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <input id="nid_birth_reg_num" type="text"
                                    class="form-control @error('nid_birth_reg_num') is-invalid @enderror"
                                    name="nid_birth_reg_num" value="{{ old('nid_birth_reg_num') }}" required autofocus>

                                @error('nid_birth_reg_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hostel"
                                class="col-md-3 col-form-label text-md-end">{{ __('Want to stay in a hostel?') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <select class="form-select" name="hostel" id="hostel" required>
                                    <option selected disabled>Select One</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 border">
                            <h4 class="text-center mt-2 text-info">Parmanent Address</h4>
                            <div class="col-md-6 mb-2">
                                <label for="division" class=" col-form-label text-md-end">{{ __('Division') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="division" id="division" required>
                                    <option selected disabled>Select Division</option>
                                    @forelse ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @empty
                                    @endforelse
                                </select>

                                @error('division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="district" class=" col-form-label text-md-end">{{ __('District') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="district" id="district" required>
                                    <option selected disabled>Select Division First</option>
                                </select>

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="upazila" class=" col-form-label text-md-end">{{ __('Upazila') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="upazila" id="upazila" required>
                                    <option selected disabled>Select District First</option>
                                </select>

                                @error('upazila')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="thana"
                                    class=" col-form-label text-md-end">{{ __('Police Station/Thana') }}<span
                                        class= "text-danger">*</span></label>
                                <input type="text" class="form-control" name="thana" id="thana" required>

                                @error('thana')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="post_office" class=" col-form-label text-md-end">{{ __('Post Office') }}<span
                                        class= "text-danger">*</span></label>
                                <input type="text" class="form-control" id="post_office" name="post_office" required>

                                @error('post_office')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="post_code" class=" col-form-label text-md-end">{{ __('Post Code') }}<span
                                        class= "text-danger">*</span></label>
                                <input type="number" class="form-control" id="post_code" name="post_code" required>

                                @error('post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="village" class=" col-form-label text-md-end">{{ __('Village') }}<span
                                        class= "text-danger">*</span></label>
                                <input type="text" class="form-control" name="village" id="village" required>

                                @error('village')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="present_address"
                                class="col-md-3 col-form-label text-md-end">{{ __('Present Address') }}</label>
                            <div class="col-md-8">
                                <input id="present_address" type="text"
                                    class="form-control @error('present_address') is-invalid @enderror"
                                    name="present_address" value="{{ old('present_address') }}">

                                @error('present_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 border">
                            <h4 class="text-center mt-2 text-info">Educational Qualification (SSC/Dakhil)</h4>
                            <div class="col-md-2 mb-2">
                                <label for="ssc_exam_name"
                                    class=" col-form-label text-md-end">{{ __('Name of Exam') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="ssc_exam_name" id="ssc_exam_name" required>
                                    <option selected disabled>Select Name</option>
                                    <option value="SSC">SSC</option>
                                    <option value="Dakhil">Dakhil</option>
                                </select>

                                @error('ssc_exam_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="ssc_board" class=" col-form-label text-md-end">{{ __('Board') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="ssc_board" id="ssc_board" required>
                                    <option selected disabled>Select Board</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Cumilla">Cumilla</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Jashore">Jashore</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Madrasah">Madrasah</option>
                                    <option value="Technical">Technical</option>
                                </select>

                                @error('ssc_board')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="ssc_roll" class=" col-form-label text-md-end">{{ __('Roll') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="ssc_roll" type="text"
                                    class="form-control @error('ssc_roll') is-invalid @enderror" name="ssc_roll"
                                    value="{{ old('ssc_roll') }}" required>

                                @error('ssc_roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="ssc_reg_no" class=" col-form-label text-md-end">{{ __('Reg. No.') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="ssc_reg_no" type="text"
                                    class="form-control @error('ssc_reg_no') is-invalid @enderror" name="ssc_reg_no"
                                    value="{{ old('ssc_reg_no') }}" required>

                                @error('ssc_reg_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="ssc_gpa" class=" col-form-label text-md-end">{{ __('G.P.A.') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="ssc_gpa" type="text"
                                    class="form-control @error('ssc_gpa') is-invalid @enderror" name="ssc_gpa"
                                    value="{{ old('ssc_gpa') }}" required>

                                @error('ssc_gpa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="ssc_year" class=" col-form-label text-md-end">{{ __('Passing Year') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="ssc_year" type="text"
                                    class="form-control @error('ssc_year') is-invalid @enderror" name="ssc_year"
                                    value="{{ old('ssc_year') }}" required>

                                @error('ssc_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 border">
                            <h4 class="text-center mt-2 text-info">Educational Qualification (HSC/Alim/Diploma)</h4>
                            <div class="col-md-2 mb-2">
                                <label for="hsc_exam_name"
                                    class=" col-form-label text-md-end">{{ __('Name of Exam') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="hsc_exam_name" id="hsc_exam_name" required>
                                    <option selected disabled>Select One</option>
                                    <option value="HSC">HSC</option>
                                    <option value="Alim">Alim</option>
                                    <option value="Diploma">Diploma</option>
                                </select>
                                @error('hsc_exam_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="hsc_board" class=" col-form-label text-md-end">{{ __('Board') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="hsc_board" id="hsc_board" required>
                                    <option selected disabled>Select Board</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Cumilla">Cumilla</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Jashore">Jashore</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Madrasah">Madrasah</option>
                                    <option value="Technical">Technical</option>
                                </select>

                                @error('hsc_board')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="hsc_roll" class=" col-form-label text-md-end">{{ __('Roll') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="hsc_roll" type="text"
                                    class="form-control @error('hsc_roll') is-invalid @enderror" name="hsc_roll"
                                    value="{{ old('hsc_roll') }}" required>

                                @error('hsc_roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="hsc_reg_no" class=" col-form-label text-md-end">{{ __('Reg. No.') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="hsc_reg_no" type="text"
                                    class="form-control @error('hsc_reg_no') is-invalid @enderror" name="hsc_reg_no"
                                    value="{{ old('hsc_reg_no') }}" required>

                                @error('hsc_reg_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="hsc_gpa" class=" col-form-label text-md-end">{{ __('G.P.A.') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="hsc_gpa" type="text"
                                    class="form-control @error('hsc_gpa') is-invalid @enderror" name="hsc_gpa"
                                    value="{{ old('hsc_gpa') }}" required>

                                @error('hsc_gpa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="hsc_year" class=" col-form-label text-md-end">{{ __('Passing Year') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="hsc_year" type="text"
                                    class="form-control @error('hsc_year') is-invalid @enderror" name="hsc_year"
                                    value="{{ old('hsc_year') }}" required>

                                @error('hsc_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 border">
                            <h4 class="text-center mt-2 text-info">Government Admission Test</h4>
                            <div class="col-md-2 mb-2">
                                <label for="govt_exam_name"
                                    class=" col-form-label text-md-end">{{ __('Course Name') }}<span
                                        class= "text-danger">*</span></label>
                                <select class="form-select" name="govt_exam_name" id="govt_exam_name" required>
                                    <option selected disabled>Select Course</option>
                                    <option value="Diploma in Nursing Science & Midwifery">Diploma in Nursing Science &
                                        Midwifery</option>
                                    <option value="Diploma in Midwifery">Diploma in Midwifery</option>
                                    <option value="BSc Nursing (Post Basic)">BSc Nursing (Post Basic)</option>
                                    <option value="BSc Nursing (Basic)">BSc Nursing (Basic)</option>
                                </select>

                                @error('govt_exam_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="govt_roll" class=" col-form-label text-md-end">{{ __('Roll') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="govt_roll" type="text"
                                    class="form-control @error('govt_roll') is-invalid @enderror" name="govt_roll"
                                    value="{{ old('govt_roll') }}" required>

                                @error('govt_roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="govt_score" class=" col-form-label text-md-end">{{ __('Score') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="govt_score" type="number" step="1"
                                    class="form-control @error('govt_score') is-invalid @enderror" name="govt_score"
                                    value="{{ old('govt_score') }}" required>

                                @error('govt_score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="govt_serial" class=" col-form-label text-md-end">{{ __('Serial No.') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="govt_serial" type="number" step="1"
                                    class="form-control @error('govt_serial') is-invalid @enderror" name="govt_serial"
                                    value="{{ old('govt_serial') }}" required>

                                @error('govt_serial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="govt_user_id" class=" col-form-label text-md-end">{{ __('User ID') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="govt_user_id" type="text"
                                    class="form-control @error('govt_user_id') is-invalid @enderror" name="govt_user_id"
                                    value="{{ old('govt_user_id') }}" required>

                                @error('govt_user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="govt_password" class=" col-form-label text-md-end">{{ __('Password') }}<span
                                        class= "text-danger">*</span></label>
                                <input id="govt_password" type="text"
                                    class="form-control @error('govt_password') is-invalid @enderror"
                                    name="govt_password" value="{{ old('govt_password') }}" required>

                                @error('govt_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nationality"
                                class="col-md-3 col-form-label text-md-end">{{ __('Nationality') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <input id="nationality" type="text"
                                    class="form-control @error('nationality') is-invalid @enderror" name="nationality"
                                    value="{{ old('nationality') }}" required>

                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="religion" class="col-md-3 col-form-label text-md-end">{{ __('Religion') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <select class="form-select" name="religion" id="religion" required>
                                    <option selected disabled>Select Religion</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Buddhism">Buddhism</option>
                                    <option value="Others">Others</option>
                                </select>

                                @error('religion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="marital_status"
                                class="col-md-3 col-form-label text-md-end">{{ __('marital Status') }}<span
                                    class= "text-danger">*</span></label>

                            <div class="col-md-8">
                                <input id="marital_status" type="text"
                                    class="form-control @error('marital_status') is-invalid @enderror"
                                    name="marital_status" value="{{ old('marital_status') }}" required>

                                @error('marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image"
                                class="col-md-3 col-form-label text-md-end">{{ __('Photo (300x300)') }}</label>

                            <div class="col-md-8">
                                <input type="file" class="@error('image') is-invalid @enderror image" id="image"
                                    name="image" value="{{ old('image') }}" />
                                <div id="image-error" class="alert alert-danger" style="display: none;"></div>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <small class="w-100 text-danger">Photo must be 300 x 300 pixel (width x height)[.jpg
                                    format] and file size not more than 100 KB(min.4KB)</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signature"
                                class="col-md-3 col-form-label text-md-end">{{ __('Signature (300x80)') }}</label>

                            <div class="col-md-8">
                                <input type="file" class="@error('image') is-invalid @enderror signature"
                                    id="signature" name="signature" value="{{ old('signature') }}" />
                                <div id="signature-error" class="alert alert-danger" style="display: none;"></div>
                                @error('signature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <small class="w-100 text-danger">Signature must be 300 x 80 pixel (width x height)[.jpg
                                    format] and file size not more than 60 KB(min.4KB)</small>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Apply') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script src="{{ asset('/backend/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            jQuery('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                todayBtn: 'linked'
            });
        })
        $(document).ready(function() {
            $('#division').on('change', function() {
                var division_id = this.value;
                $.ajax({
                    url: '{{ url('get-district') }}/' + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data)
                        $('#district').find('option').remove();
                        $('#upazila').find('option').remove();
                        $("#district").append(data);
                        $("#upazila").append(
                            '<option selected disabled>Select District First</option>');
                    }
                });
            })
            $('#district').on('change', function() {
                var district_id = this.value;
                $.ajax({
                    url: '{{ url('get-upazila') }}/' + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data)
                        $('#upazila').find('option').remove();
                        $("#upazila").append(data);
                    }
                });
            })
        })
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var valid = true;
                // Reset previous error messages
                $('#image-error').hide().text('');
                $('#signature-error').hide().text('');

                var image = $('#image')[0].files[0];
                var signature = $('#signature')[0].files[0];

                // Function to validate image dimensions, format, and file size
                function validateImage(file, expectedWidth, expectedHeight, maxSize, minSize,
                errorElement) {
                    return new Promise((resolve, reject) => {
                        if (file.type !== 'image/jpeg') {
                            $(errorElement).text('File must be in .jpg format').show();
                            valid = false;
                            return reject();
                        }

                        if (file.size > maxSize || file.size < minSize) {
                            $(errorElement).text(
                                `File size must be between ${minSize / 1024} KB and ${maxSize / 1024} KB`
                                ).show();
                            valid = false;
                            return reject();
                        }

                        var img = new Image();
                        img.src = URL.createObjectURL(file);
                        img.onload = function() {
                            if (img.width !== expectedWidth || img.height !== expectedHeight) {
                                $(errorElement).text(
                                    `Dimensions should be ${expectedWidth}x${expectedHeight}`
                                    ).show();
                                valid = false;
                                reject();
                            } else {
                                resolve();
                            }
                        };
                        img.onerror = function() {
                            $(errorElement).text('Error loading image').show();
                            valid = false;
                            reject();
                        };
                    });
                }

                // Validate image and signature dimensions, format, and file size
                var imageValidation = image ? validateImage(image, 300, 300, 100 * 1024, 4 * 1024,
                    '#image-error') : Promise.resolve();
                var signatureValidation = signature ? validateImage(signature, 300, 80, 60 * 1024, 4 * 1024,
                    '#signature-error') : Promise.resolve();

                // Check both validations
                Promise.all([imageValidation, signatureValidation])
                    .then(() => {
                        if (valid) {
                            $('form').off('submit').submit(); // Re-submit the form if valid
                        }
                    })
                    .catch(() => {
                        // Prevent form submission if not valid
                        e.preventDefault();
                    });
            });


            if (window.File && window.FileList && window.FileReader) {
                $("#image").on("change", function(e) {
                    var files = e.target.files;
                    for (var i = 0; i < files.length; i++) {
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#image");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(files[i]);
                    }
                });

                $("#signature").on("change", function(e) {
                    var files = e.target.files;
                    for (var i = 0; i < files.length; i++) {
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#signature");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(files[i]);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API");
            }
        });
    </script>
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-datepicker.min.css') }}">
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
@endpush

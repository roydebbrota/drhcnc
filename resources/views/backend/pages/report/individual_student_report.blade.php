<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @font-face {
            font-family: 'Nikosh';
            src: url('fonts/Nikosh.ttf') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: 'Arial';
            src: url('fonts/arial.ttf') format('truetype');
            font-weight: bold;
        }

        body {
            font-family: 'Nikosh', sans-serif;
        }
    </style>
</head>

<body>
    <p>বাংলা টেক্সট সঠিকভাবে প্রদর্শন হবে।</p>
    <p>English example</p>
</body>

</html>






{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;

        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: green;
        }

        .header p {
            margin: 2px 0;
        }

        .section-title {
            background-color: yellow;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }

        .terms {
            margin-top: 20px;
        }

        .terms p {
            margin-bottom: 5px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="application-form">
        <div class="header">
            <h1>Dr. Hassan Choudhury Nursing College</h1>
            <p>355 East Rampura, DIT Road, Rampura, Dhaka-1219</p>
            <p>Cell: 01780798899</p>
            <p>E-mail: drmdkamrulhassanchoudhury52@gmail.com</p>
        </div>
        <div class="section-title">Application Form</div>
        <div class="form-group">
            <label style="font-weight: 800">Application for:</label>
            <spen>{{ $student->course_name }}</span>
        </div>
        <div class="form-group">
            <span>
                <label style="font-weight: 800">Applicant Name (English):</label>
                <spen>{{ $student->name }}
            </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <span style="text-align: right;">
                <label style="font-weight: 800">Applicant Name (Bangla):</label>
                <spen>{{ $student->name_bangla }}
            </span>
            </span>
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Father's Name:</label>
            <spen>{{ $student->father }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="font-weight: 800">Mother's Name:</label>
                <spen style="margin-right: 5px">{{ $student->mother }}</span>
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Contact No. (Applicant):</label>
            <spen>{{ $student->phone }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="font-weight: 800">Contact No. (Father):</label>
                <spen style="margin-right: 5px">{{ $student->father_phone }}</span>
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Religion:</label>
            <spen>{{ $student->religion }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="font-weight: 800">{{ $student->nid_birth_reg }}:</label>
                <spen>{{ $student->nid_birth_reg_num }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label style="font-weight: 800">Nationality:</label>
                    <spen>{{ $student->nationality }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Date Of Birth:</label>
            <spen>{{ $student->date_of_birth }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="font-weight: 800">Blood Group:</label>
                <spen>{{ $student->blood_group }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Marital Status:</label>
            <spen>{{ $student->marital_status }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="font-weight: 800">Email:</label>
                <spen>{{ $student->email }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Present Address:</label>
            <spen>{{ $student->present_address }}</span>
        </div>
        <div class="form-group">
            <label style="font-weight: 800">Permanent Address:</label>
            <spen>
                {{ 'Village: ' .
                    $student->village .
                    ', Post Office: ' .
                    $student->post_office .
                    '-' .
                    $student->post_code .
                    ', Thana:
                                                                ' .
                    $student->thana .
                    ', Upazila: ' .
                    $student->upazila_name .
                    ', District: ' .
                    $student->district_name .
                    ', District: ' .
                    $student->division_name }}</span>
        </div>

        <div class="section-title">Educational Qualification</div>
        <div class="form-group">
            <label style="font-weight: 800">{{ 'Name of Exam :' . $student->ssc_exam_name }}</label>
            <spen>
                {{ '- Board: ' .
                    $student->ssc_board .
                    ', Roll: ' .
                    $student->ssc_roll .
                    ', Reg No:
                                                                ' .
                    $student->ssc_reg_no .
                    ', GPA: ' .
                    $student->ssc_gpa .
                    ', Passing Year: ' .
                    $student->ssc_year }}</span>
        </div>
        <div class="form-group">
            <label style="font-weight: 800">{{ 'Name of Exam :' . $student->hsc_exam_name }}</label>
            <spen>
                {{ '- Board: ' .
                    $student->hsc_board .
                    ', Roll: ' .
                    $student->hsc_roll .
                    ', Reg No:
                                                                ' .
                    $student->hsc_reg_no .
                    ', GPA: ' .
                    $student->hsc_gpa .
                    ', Passing Year: ' .
                    $student->hsc_year }}</span>
        </div>
        <div class="section-title">{{ 'Government Admission Test (' . $student->govt_exam_name . ')' }}</div>
        <div class="form-group">
            <spen>
                {{ 'Roll: ' .
                    $student->govt_roll .
                    ', Score: ' .
                    $student->govt_score .
                    ', Serial No:
                                                                ' .
                    $student->govt_serial .
                    ', User ID: ' .
                    $student->govt_user_id .
                    ', Password: ' .
                    $student->govt_password }}</span>
        </div>
        <div class="terms">
            <p>Terms and Condition:</p>
            <spen style="color: red;"> * I undersigned certify that, any willful misstatement described here may lead to
                my dismissal of
                admission.<br>
                * Admission fee not refundable and academic cost will be paid within the time.<br>
                * I will obey the institutional rules and regulation, if I break booked ticket then can't leave<br>
                * You have to paid full payment whatever you have committed to pay on admission.
                </span>
        </div>
        <div style="margin-top: 100px; ">
            <p style="float: left; margin: 0 10px 0 0; width: 30%; ">Signature of Guardian</p>
            <p style="float: left; margin: 0 10px 0 0; width: 30%; ">Signature of Applicant</p>
            <p style="float: right; margin: 0 0 0 0; width: 40%;">Signature of Director/Principal</p>
        </div>
    </div>
</body>

</html> --}}

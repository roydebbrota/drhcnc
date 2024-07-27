<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        th,
        td {
            border: 1px solid gray;
            padding: 1px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="application-form">
        <div class="header">
            {{-- <img src="{{ asset('/frontend/img/logo.ico') }}" style="width:50px; height:auto" alt="Logo"> --}}
            <h1>Dr. Hassan Choudhury Nursing College</h1>
            <p>355 East Rampura, DIT Road, Rampura, Dhaka-1219</p>
            <p>Cell: 01780798899</p>
            <p>E-mail: drmdkamrulhassanchoudhury52@gmail.com</p>
        </div>
        {{-- <div class="section-title">{{ 'Paymant details of ' . $student->name }}</div> --}}
        {{-- <form> --}}
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Session</th>
                    <th>Phone</th>
                    <th>Father's Pnone</th>
                    <th>District</th>
                    <th>Blood Group</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->course_name }}</td>
                    <td>{{ $student->session . '-' . $student->session + 1 }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->father_phone }}</td>
                    <td>{{ $student->district_name }}</td>
                    <td>{{ $student->blood_group }}</td>
                </tr>
            </tbody>
        </table>
        <div class="section-title">{{ 'Paymant details of ' . $student->name }}</div>
        <table>
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Month</th>
                    <th>Note</th>
                    <th>Entry date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fees as $fee)
                    <tr>
                        <td>{{ $fee->amount }}</td>
                        <td>{{ $fee->fees_type_name }}</td>
                        <td>{{ date('j M Y', strtotime($fee->month)) }}</td>
                        <td>{{ $fee->note }}</td>
                        <td>{{ date('j M Y', strtotime($fee->created_at)) }}</td>
                    </tr>
                @empty
                @endforelse

                <tr>
                    <td>{{'Tuition ='. $tuition }}</td>
                    <td>{{'Exam ='. $exam }}</td>
                    <td>{{'Reg: ='. $registration }}</td>
                    <td>{{'Hostel ='. $hostel}}</td>
                    <th>{{'Others ='. $others }}</th>
                </tr>
                <tr>
                    <td>{{'Total amount ='. $fee->sum('amount') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

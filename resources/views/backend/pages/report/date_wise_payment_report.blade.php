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
        <div class="section-title">
            {{ 'Paymant details from ' . date('j M Y', strtotime($startDate)) . ' to ' . date('j M Y', strtotime($endDate)) }}
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Father name</th>
                    <th>Phone</th>
                    <th>Father's Phone</th>
                    <th>Course name</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Note</th>
                    <th>Entry date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td>{{ $report->student_name }}</td>
                        <td>{{ $report->father }}</td>
                        <td>{{ $report->phone }}</td>
                        <td>{{ $report->father_phone }}</td>
                        <td>{{ $report->course_name }}</td>
                        <td>{{ $report->amount }}</td>
                        <td>{{ date('j M Y', strtotime($report->month)) }}</td>
                        <td>{{ $report->note }}</td>
                        <td>{{ date('j M Y', strtotime($report->created_at)) }}</td>
                    </tr>
                @empty
                @endforelse
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ 'Total Amount =' }}</td>
                    <td>{{ $reports->sum('amount') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

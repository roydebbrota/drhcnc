<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .page {
            background: white;
            display: block;
            margin: 0 0;
            padding: 1px 1px;
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
    <div class="page">
        <div>
            <p style="text-align: center">D. Hasan Chowdhury Nursing College</p>
            <h6 style="text-align: center">{{ 'General information of session ' . $session . '-' . $session + 1 }}</h6>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Course Name</th>
                    <th>Session</th>
                    <th>Phone</th>
                    <th>Father's Pnone</th>
                    <th>District</th>
                    <th>Blood Group</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->name }}</td>
                        <td>{{ $report->father }}</td>
                        <td>{{ $report->course_name }}</td>
                        <td>{{ $report->session . '-' . $report->session + 1 }}</td>
                        <td>{{ $report->phone }}</td>
                        <td>{{ $report->father_phone }}</td>
                        <td>{{ $report->district_name }}</td>
                        <td>{{ $report->blood_group }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justice & Co. - Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f9;
        }
        h1 {
            color: #243447;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #243447;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Justice & Co. Law Associates</h1>
    <h2>Employee Directory</h2>

    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->department->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

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

        h1 { color: #243447; }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

        .btn {
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add { background: #198754; }
        .edit { background: #0d6efd; }
        .delete { background: #dc3545; }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            margin-bottom: 15px;
        }

        form { display: inline; }
    </style>
</head>

<body>

    <h1>Justice & Co. Law Associates</h1>

    <div class="top-bar">
        <h2>Employee Directory</h2>

        <a href="{{ route('employees.create') }}" class="btn add">
            + Add Employee
        </a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->department->name }}</td>

                    <td>
                        <a href="{{ route('employees.edit', $employee) }}"
                           class="btn edit">
                            Edit
                        </a>

                        <form action="{{ route('employees.destroy', $employee) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this employee?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn delete">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

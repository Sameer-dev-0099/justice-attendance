
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Today's Attendance</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                @php
                    $attendance = $employee->attendances->first();
                @endphp

                <tr>
                    <td>{{ $employee->name }}</td>

                    <td>
                        {{ $attendance?->check_in_at?->format('h:i A') ?? '—' }}
                    </td>

                    <td>
                        {{ $attendance?->check_out_at?->format('h:i A') ?? '—' }}
                    </td>

                    <td>
                        <form action="{{ route('attendance.check-in', $employee) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm"
                                {{ $attendance?->check_in_at ? 'disabled' : '' }}>
                                Check-in
                            </button>
                        </form>

                        <form action="{{ route('attendance.check-out', $employee) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm"
                                {{ !$attendance?->check_in_at || $attendance?->check_out_at ? 'disabled' : '' }}>
                                Check-out
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

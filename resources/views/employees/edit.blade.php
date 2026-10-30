<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
</head>
<body>

    <h1>Edit Employee</h1>

    <form action="{{ route('employees.update', $employee) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Employee Name:</label>
            <input type="text" name="name"
                   value="{{ old('name', $employee->name) }}" required>

            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Employee Email:</label>
            <input type="email" name="email"
                   value="{{ old('email', $employee->email) }}" required>

            @error('email')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Department:</label>

            <select name="department_id" required>
                <option value="">Select Department</option>

                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

            @error('department_id')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Update Employee</button>
    </form>

    <br>

    <a href="{{ route('employees.index') }}">Back to Employees</a>

</body>
</html>
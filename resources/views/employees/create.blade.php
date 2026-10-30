<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee - Justice & Co.</title>
</head>
<body>

    <h1>Add New Employee</h1>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div>
            <label>Employee Name:</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >

            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Employee Email:</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >

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
                    <option
                        value="{{ $department->id }}"
                        {{ old('department_id') == $department->id ? 'selected' : '' }}
                    >
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

            @error('department_id')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Save Employee</button>

    </form>

    <br>

    <a href="{{ route('employees.index') }}">Back to Employees</a>

</body>
</html>
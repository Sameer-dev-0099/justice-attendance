
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submit Leave Request</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leave-requests.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date"
                class="form-control" value="{{ old('start_date') }}" required>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date"
                class="form-control" value="{{ old('end_date') }}" required>
        </div>

        <div class="mb-3">
            <label>Reason</label>
            <textarea name="reason" class="form-control"
                required>{{ old('reason') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Submit Request
        </button>
    </form>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave History - {{ $employee->name }}</h2>

    @forelse($leaveRequests as $leave)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    <strong>Start Date:</strong>
                    {{ $leave->start_date->format('d M Y') }}
                </p>

                <p>
                    <strong>End Date:</strong>
                    {{ $leave->end_date->format('d M Y') }}
                </p>

                <p>
                    <strong>Reason:</strong>
                    {{ $leave->reason }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ ucfirst($leave->status) }}
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No leave history found.
        </div>
    @endforelse
</div>
@endsection

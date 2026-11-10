
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pending Leave Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($leaveRequests as $leave)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $leave->employee->name }}</h5>

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

                <span class="badge bg-warning">
                    {{ ucfirst($leave->status) }}
                </span>

                <div class="mt-3">
                    <form action="{{ route('leave-requests.approve', $leave) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success">
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('leave-requests.reject', $leave) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger">
                            Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No pending leave requests found.
        </div>
    @endforelse
</div>
@endsection

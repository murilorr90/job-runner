@extends('layout')

@section('content')
    <div class="d-flex justify-content-around align-items-center mb-3">
        <h1 class="align-center">Job Dashboard</h1>
        <div>
            <a href="{{ route('examples') }}" class="btn btn-sm btn-outline-primary">Add random Job</a>
            <a href="{{ route('logs.view') }}" class="btn btn-sm btn-outline-warning">Logs</a>
            <a href="{{ route('error_logs.view') }}" class="btn btn-sm btn-outline-danger">Error logs</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Class</th>
            <th>Method</th>
            <th>Params</th>
            <th>Status</th>
            <th>Retry Count</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($jobs as $job)
            <tr>
                <td>
                    @if($job->high_priority)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                        </svg>
                    @endif
                    {{ $job->id }}
                </td>
                <td>{{ $job->class }}</td>
                <td>{{ $job->method }}</td>
                <td>{{ json_encode($job->params) }}</td>
                <td>
                    <span class="badge text-bg-{{ $job->status_class }}">{{ $job->status }}</span></td>
                </td>
                <td>{{ $job->retry_count }}</td>
                <td>{{ $job->seconds }}</td>
                <td>
                    @if($job->status === 'failed')
                        <form action="{{ route('retry') }}" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Retry</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        setInterval(function() {
            location.reload();
        }, 1000);
    </script>
@endsection

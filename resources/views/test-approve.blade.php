<!DOCTYPE html>
<html>
<head>
    <title>Test Approve Application</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Approve Application</h1>
    
    <h2>Current Application Status:</h2>
    @php
        $application = App\Models\Application::find(3);
        if ($application) {
            echo "Application ID: " . $application->id . "<br>";
            echo "Current Status: " . ($application->status ? 'Approved' : 'Pending') . "<br>";
            echo "Job ID: " . $application->job_id . "<br>";
            echo "User: " . $application->user->full_name . "<br>";
        } else {
            echo "Application not found!";
        }
    @endphp
    
    <h2>Test Approve:</h2>
    <form action="{{ route('superuser.applications.approve', 3) }}" method="POST">
        @csrf
        <button type="submit" onclick="return confirm('Approve application 3?')">
            Approve Application 3
        </button>
    </form>
    
    <h2>Messages:</h2>
    @if(session('success'))
        <div style="color: green; font-weight: bold;">
            SUCCESS: {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="color: red; font-weight: bold;">
            ERROR: {{ session('error') }}
        </div>
    @endif
    
    <p><a href="{{ route('superuser.jobs.applications', 6) }}">Back to Applications List</a></p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Output</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-around align-items-center mb-3">
        <h1 class="align-center">Log Output</h1>
        <div>
            <a href="{{ url('/') }}" class="btn btn-sm btn-outline-primary">Back to Dashboard</a>
        </div>
    </div>

    <pre style="white-space: pre-wrap; word-wrap: break-word;">{{ $logs }}</pre>
</div>

</body>
</html>

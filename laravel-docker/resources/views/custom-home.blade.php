<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Re Writer</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="text-center">
            <h1>Welcome to Our App</h1>
            <p>Start your journey with us</p>
            <a href="{{ url('/user/login')}}" class="btn btn-primary btn-lg mr-3">Login</a>
            <a href="{{ url('/user/registration') }}" class="btn btn-secondary btn-lg">Register</a>
        </div>
    </div>

    <!-- Link Bootstrap JS (jQuery and Popper.js are required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

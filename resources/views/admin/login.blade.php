<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Admin Login</h2>
            @if (session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <label for="pin">Admin PIN</label>
                <input type="password" name="pin" id="pin" required placeholder="Enter Admin PIN">
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

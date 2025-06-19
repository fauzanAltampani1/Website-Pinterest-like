<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    
    <title>Login - ArtSpot</title>
</head>

<body>

    <div class="container">
        <div class="logo">
            <h1>Welcome to ArtSpot</h1>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="inputs">
                <label>Email
                    <input type="email" name="email" id="email" required placeholder="Email" value="{{ old('email') }}">
                </label>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
                <label>Password
                    <input type="password" name="password" id="password" required placeholder="Password">
                </label>
                <div class="middle">
                    <button type="submit" id="login-button">Log in</button>
                    <h3>OR</h3>
                    <div class="signup">
                        <button class="signup-button" onclick="window.location.href='{{ route('register') }}'">Sign up</button>
                    </div>
                    @if (session('error'))
    <div class="error-message">
        <span class="error-icon">⚠️</span>
        {{ session('error') }}
    </div>
@endif

                </div>
            </div>
        </form>
        <div class="description">
            <small>
                <p> By continuing, you agree to ArtSpot's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                </p>
                <p class="sign-up">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
            </small>
        </div>
    </div>
</body>

</html>

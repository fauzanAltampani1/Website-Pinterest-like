<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>Register - ArtSpot</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <h1>Create Your Account</h1>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="inputs">
                <label for="username">User Name
                    <input type="text" name="username" id="username" required placeholder="Your Full Name" value="{{ old('username') }}">
                </label>
                @error('username')
                    <div>{{ $message }}</div>
                @enderror
                <label for="email">Email
                    <input type="email" name="email" id="email" required placeholder="Your Email" value="{{ old('email') }}">
                </label>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
                <label for="password">Password
                    <input type="password" name="password" id="password" required placeholder="Create a Password">
                </label>
                <label for="password_confirmation">Confirm Password
                    <input type="password" name="password_confirmation" id="confirm-password" required placeholder="Confirm Your Password">
                </label>
                <div class="middle">
                    <input type="submit" value="Sign Up" id="signup-button">
                    <h3>OR</h3>
                    <p>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
                </div>
            </div>
        </form>
        <div class="description">
            <small>
                <p> By signing up, you agree to ArtSpot's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                </p>
            </small>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clinic Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('doctors/assets/css/style.css') }}">
</head>
<body>
<div class="wrapper">
    <h1>Clinic login</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('doctors.login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            @error('email') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
        </div>

        <button type="submit" class="btn-primary">Sign in</button>
    </form>

      <p class="switch-auth">
        Don’t have an account?
        <a href="{{ route('doctor.register.create') }}" class="link-login">
            Register your clinic
        </a>
    </p>

</div>
</body>
</html>

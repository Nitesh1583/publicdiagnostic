<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        
    </style>
</head>
<body>

<div class="wrapper">
    {{-- Left side: Sign in --}}
    <div class="left">
        <!-- <h2 class="title">Public Diagnostic Admin Login</h2> -->

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="form-group">
                <input type="email" name="email" class="form-input" placeholder="Email Address" required autofocus>
            </div>

            <div class="form-group password-group">
                <input type="password" name="password" class="form-input" placeholder="Password" required>
                <a href="#" class="forgot-link">Forgot your password?</a>
            </div>

            <div class="actions-row">
                <button type="submit" class="btn-primary">SIGN IN</button>
                
            </div>
        </form>
    </div>

    {{-- Right side: gradient --}}
    <div class="right">
        <div class="overlay-text">
            <h3>Welcome to Admin Login <br> Public Diagnostic </h3>
            <p>Secure access for clinics, labs and doctors to manage patients and reports.</p>
            <!-- <img src="{{ asset('admin/assets/images/admin-login-picture.jpg') }}"/> -->
        </div>
    </div>
</div>

{{-- Font Awesome icons --}}
<script src="https://kit.fontawesome.com/a2e0e6ad5c.js" crossorigin="anonymous"></script>

</body>
</html>

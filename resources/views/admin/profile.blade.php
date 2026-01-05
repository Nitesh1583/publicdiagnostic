<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/profile.css') }}">
</head>
<body>
    <div class="profile-page">
    <a href="{{ route('admin.dashboard') }}" class="back-btn">
        ← Back to Dashboard
    </a>
    <div class="profile-wrapper">

        {{-- LEFT: PROFILE INFO --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Profile information</div>
                    <div class="card-subtitle">Update your account details.</div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="avatar">
                
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Full name</label>
                       
                        <input id="name" type="text" name="name" 
                            value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" name="email" 
                            value="{{ old('email', $user->email) }}" required>
                       
                        @error('email') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone number</label>
                       
                        <input id="phone" type="text" name="phone" 
                            value="{{ old('phone', $user->phone ?? '') }}">
                        @error('phone') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary">Save profile</button>
            </form>
        </div>

        {{-- RIGHT: CHANGE PASSWORD --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Change password</div>
                    <div class="card-subtitle">Keep your account secure.</div>
                </div>
            </div>

            @if(session('success_password'))
                <div class="alert alert-success">{{ session('success_password') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.profile.password') }}">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current password</label>
                    <input id="current_password" type="password" name="current_password" required>
                    @error('current_password') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">New password</label>
                    <input id="password" type="password" name="password" required>
                    @error('password') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm new password</label>
                    <input id="password_confirmation" type="password"
                           name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-primary">Update password</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

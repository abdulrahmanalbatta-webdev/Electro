<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}">
</head>

<body>
    <div class="container">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h2 id="title">Reset Password</h2>
                    <p id="subtitle">Enter your new password</p>
                </div>

                <form id="resetForm" method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $request->email) }}" >
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label" id="newPasswordLabel">New Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" class="form-control" id="newPassword" placeholder="••••••••"
                                >
                            @error('password')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label" id="confirmPasswordLabel">Confirm New
                            Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="••••••••"
                                >
                            {{-- <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i> --}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Reset Password</button>
                </form>

                <div class="auth-link">
                    <a href="{{ route('login') }}" id="backLink">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

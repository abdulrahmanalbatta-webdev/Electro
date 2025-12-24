{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/auth.css') }}">
</head>

<body>
    <div class="container">
        <div class="auth-container">
            <div class="auth-card">
                <div class="alert alert-success">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                </div>
                <div class="auth-header">
                    <h2 id="title">Forgot Password?</h2>
                    <p id="subtitle">No worries, we'll send you reset instructions</p>
                </div>

                <div class="info-box">
                    <p id="infoText">Enter your email address and we'll send you a link to reset your password.</p>
                </div>

                <form id="forgotForm" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label" id="emailLabel">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="john@example.com">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitBtn">Send Reset Link</button>
                </form>

                <div class="auth-link">
                    <a href="{{route('login')}}" id="backLink">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

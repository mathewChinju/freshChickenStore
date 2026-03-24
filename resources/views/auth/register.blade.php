<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Register') }} – {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">{{ __('Register') }}</div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}"
                                           required autocomplete="name" autofocus>
                                    @error('name')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}"
                                           required autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn btn-primary w-100">{{ __('Register') }}</button>

                                <hr>
                                <p class="text-center text-muted mb-0 small">
                                    Already have an account?
                                    <a href="{{ route('login') }}">Login</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

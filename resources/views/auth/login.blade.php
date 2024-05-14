<x-layouts.auth class="container-tight">
    <x-slot:title>
        {{ __('Login') }}
    </x-slot>

    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>

            <form action="{{ route('auth.authenticate') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email address') }}</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="john.doe@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('Your password') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check">
                    <input type="checkbox" name="remember_me" id="remember-me" class="form-check-input">
                    <label for="remember-me" class="form-check-label">{{ __('Remember me on this device') }}</label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        {{ __("Don't have account yet?") }} <a href="{{ route('auth.registration') }}">Register</a>
    </div>
</x-layouts.auth>

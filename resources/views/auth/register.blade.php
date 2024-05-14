<x-layouts.auth class="container-narrow">
    <x-slot:title>{{ __('Registration') }}</x-slot>

    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Register new account</h2>

            <form action="{{ route('auth.register') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Full name') }}</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="John Doe">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email address') }}</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="john.doe@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('Secure password') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="password-confirmation" class="form-label">{{ __('Confirm password') }}</label>
                        <input type="password" name="password_confirmation" id="password-confirmation"
                            class="form-control" placeholder="{{ __('Re-type password') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="identity-number" class="form-label">{{ __('Identity number') }}</label>
                    <input type="text" name="identity_number" id="identity-number"
                        class="form-control @error('identity_number') is-invalid @enderror"
                        placeholder="{{ __('Input No. KTP') }}">
                    @error('identity_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone-number" class="form-label">{{ __('Phone number') }}</label>
                    <input type="text" name="phone_number" id="phone-number"
                        class="form-control @error('phone_number') is-invalid @enderror" placeholder="+62">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                        placeholder="Full address" rows="5"></textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn">Reset</button>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        {{ __('Already have account?') }} <a href="{{ route('auth.login') }}">Login</a>
    </div>

    @push('scripts')
        <script type="text/javascript">
            window.addEventListener('load', function() {
                window.IMask && window.IMask(document.getElementById('phone-number'), {
                    mask: '+{62}000000000000',
                })

                window.IMask && window.IMask(document.getElementById('identity-number'), {
                    mask: '0000000000000000',
                })
            });
        </script>
    @endpush
</x-layouts.auth>

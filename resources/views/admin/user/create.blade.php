<x-layouts.admin>
    <x-slot:title>{{ __('Create New User') }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Create') }}
        </x-slot>

        <x-slot:title>
            {{ __('New User') }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <form action="{{ route('admin.users.store') }}" class="col" method="post" enctype="multipart/form-data"
            x-data="createUser">
            <div class="row row-cards">
                @csrf

                <div class="col-lg-8">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('User Information') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="name">{{ __('Full name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="{{ __('John Doe') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="email">{{ __('Email address') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="{{ __('john.doe@example.com') }}" autocomplete="off">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" autocomplete="off">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Role') }}</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="role" value="admin" id="role"
                                    class="form-selectgroup-input" checked x-model="role">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">{{ __('Admin') }}</span>
                                        <span class="d-block text-secondary">{{ __('User can manage site.') }}</span>
                                    </div>
                                </div>
                            </label>
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="role" value="customer" class="form-selectgroup-input"
                                    x-model="role">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">{{ __('Customer') }}</span>
                                        <span class="d-block text-secondary">{{ __('User can rent.') }}</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div x-cloak x-transition x-show="showCustomerDataForm">
                        <div class="mb-2">
                            <h3 class="h3 mb-0">{{ __('Customer Information') }}</h3>
                        </div>

                        <div class="mb-2">
                            <label for="identity-number" class="form-label required">{{ __('Identity number') }}</label>
                            <input type="text" name="customer_identity_number" id="identity-number"
                                class="form-control @error('customer_identity_number') is-invalid @enderror"
                                placeholder="{{ __('Input No. KTP') }}">
                            @error('customer_identity_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="phone-number" class="form-label required">{{ __('Phone number') }}</label>
                            <input type="text" name="customer_phone_number" id="phone-number"
                                class="form-control @error('customer_phone_number') is-invalid @enderror" placeholder="+62">
                            @error('customer_phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="address" class="form-label required">{{ __('Address') }}</label>
                            <textarea name="customer_address" id="address" class="form-control @error('customer_address') is-invalid @enderror"
                                placeholder="Full address" rows="5"></textarea>
                            @error('customer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('Profile Picture') }}</h3>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="avatar">{{ __('Choose image') }}</label>
                        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png"
                            class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </x-admin.body>

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
</x-layouts.admin>

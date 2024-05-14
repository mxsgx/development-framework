<x-layouts.admin>
    <x-slot:title>{{ __('Create New Customer') }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Create') }}
        </x-slot>

        <x-slot:title>
            {{ __('New Customer') }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <form action="{{ route('admin.customers.store') }}" class="col" method="post" x-data="createCustomer">
            <div class="row row-cards">
                @csrf

                <div class="col-lg-8">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('Customer Information') }}</h3>
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
                        <label for="identity-number" class="form-label required">{{ __('Identity number') }}</label>
                        <input type="text" name="identity_number" id="identity-number"
                            class="form-control @error('identity_number') is-invalid @enderror"
                            placeholder="{{ __('Input No. KTP') }}">
                        @error('identity_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone-number" class="form-label required">{{ __('Phone number') }}</label>
                        <input type="text" name="phone_number" id="phone-number"
                            class="form-control @error('phone_number') is-invalid @enderror" placeholder="+62">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label required">{{ __('Address') }}</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                            placeholder="Full address" rows="5"></textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('User Options') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="create_user" x-model="createUser"
                                value="1">
                            <span class="form-check-label">
                                {{ __('Create new user') }}
                            </span>
                            <span class="form-check-description">
                                {{ __('Enter new user information.') }}
                            </span>
                        </label>
                    </div>

                    <div class="mb-3" x-cloak x-transition x-show="!createUser">
                        <div class="hr-text">or</div>

                        <label for="user" class="form-label">{{ __('Link to existing user') }}</label>
                        <select name="user_id" id="user"
                            class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">{{ __('Please select') }}</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    data-custom-properties="{{ $user->avatar_url ? '<span class="avatar avatar-xs" style="background-image: url(' . $user->avatar_url . ')"></span>' : '<span class="avatar avatar-xs">?</span>' }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div x-cloak x-transition x-show="createUser">
                        <div class="mb-2">
                            <h3 class="h3 mb-0">{{ __('User Credentials') }}</h3>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="email">{{ __('Email address') }}</label>
                            <input type="email" class="form-control @error('user_email') is-invalid @enderror"
                                name="user_email" id="email" placeholder="{{ __('john.doe@example.com') }}"
                                autocomplete="off">
                            @error('user_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('user_password') is-invalid @enderror"
                                name="user_password" id="password" autocomplete="off">
                            @error('user_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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

            document.addEventListener('DOMContentLoaded', function() {
                var el;

                window.TomSelect && (new TomSelect(el = document.getElementById('user'), {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                }));
            });
        </script>
    @endpush
</x-layouts.admin>

<x-layouts.admin>
    <x-slot:title>{{ __('Edit :name Customer', ['name' => $customer->name]) }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Edit') }}
        </x-slot>

        <x-slot:title>
            {{ __(':name Customer', ['name' => $customer->name]) }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <form action="{{ route('admin.customers.update', ['customer' => $customer]) }}" class="col" method="post">
            <div class="row row-cards">
                @csrf
                @method('PATCH')

                <div class="col-lg-8">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('Customer Information') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="name">{{ __('Full name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="{{ __('John Doe') }}" value="{{ $customer->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="identity-number" class="form-label required">{{ __('Identity number') }}</label>
                        <input type="text" name="identity_number" id="identity-number"
                            class="form-control @error('identity_number') is-invalid @enderror"
                            placeholder="{{ __('Input No. KTP') }}" value="{{ $customer->identity_number }}">
                        @error('identity_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone-number" class="form-label required">{{ __('Phone number') }}</label>
                        <input type="text" name="phone_number" id="phone-number"
                            class="form-control @error('phone_number') is-invalid @enderror" placeholder="+62"
                            value="{{ $customer->phone_number }}">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label required">{{ __('Address') }}</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                            placeholder="Full address" rows="5">{{ $customer->address }}</textarea>
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
                        <label for="user" class="form-label">{{ __('Link to existing user') }}</label>
                        <select name="user_id" id="user"
                            class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">{{ __('Please select') }}</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    data-custom-properties="{{ $user->avatar_url ? '<span class="avatar avatar-xs" style="background-image: url(' . $user->avatar_url . ')"></span>' : '<span class="avatar avatar-xs">?</span>' }}" @selected($user->id === $customer->user_id)>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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

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
        <form action="{{ route('admin.users.update', ['user' => $user]) }}" class="col" method="post" enctype="multipart/form-data">
            <div class="row row-cards">
                @csrf
                @method('PATCH')

                <div class="col-lg-8">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('User Information') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="name">{{ __('Full name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="{{ __('John Doe') }}" value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="email">{{ __('Email address') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="{{ __('john.doe@example.com') }}" autocomplete="off"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Role') }}</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="role" value="admin" id="role"
                                    class="form-selectgroup-input" @checked($user->role->value === 'admin')>
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
                                    @checked($user->role->value === 'customer')>
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

                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('Change Password') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">{{ __('New Password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" autocomplete="off">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-2">
                        <h3 class="h3 mb-0">{{ __('Profile Picture') }}</h3>
                    </div>

                    <div class="mb-3">
                        @if ($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" class="w-50 mb-2 object-fit-cover">
                        @endif

                        <label class="form-label" for="avatar">{{ __('Choose image') }}</label>
                        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png"
                            class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
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
</x-layouts.admin>

<x-layouts.admin>
    <x-slot:title>{{ __('Create a Brand') }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Create') }}
        </x-slot>

        <x-slot:title>
            {{ __('New Brand') }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <div class="col">
            <form action="{{ route('admin.brands.store') }}" method="post" enctype="multipart/form-data"
                x-data="logoPreview">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">{{ __('Brand name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" placeholder="{{ __('example: Mitsubishi') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <template x-if="logoUrl">
                    <div class="mb-3">
                        <p class="form-label">{{ __('Preview') }}</p>
                        <img :src="logoUrl" class="avatar avatar-xl rounded object-fit-cover">
                    </div>
                </template>

                <div class="mb-3">
                    <label class="form-label" for="logo">{{ __('Logo') }}</label>
                    <input type="file" id="logo" name="logo" accept="image/jpeg,image/png"
                        class="form-control @error('logo') is-invalid @enderror" x-on:change="showLogoPreview">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-hint">{{ __('Recommendation: Logo dimensions must be 1:1 ratio') }}</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <a href="{{ route('admin.brands.index') }}" class="btn">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </x-admin.body>
</x-layouts.admin>

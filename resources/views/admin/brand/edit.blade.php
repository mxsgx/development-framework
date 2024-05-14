<x-layouts.admin>
    <x-slot:title>{{ __('Edit :name Brand', ['name' => $brand->name]) }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Edit') }}
        </x-slot>

        <x-slot:title>
            {{ __(':name Brand', ['name' => $brand->name]) }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <div class="col">
            <form action="{{ route('admin.brands.update', ['brand' => $brand]) }}" method="post"
                enctype="multipart/form-data" x-data="logoPreview">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">{{ __('Brand name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" placeholder="{{ __('example: Mitsubishi') }}" value="{{ $brand->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <p class="form-label">{{ __('Preview') }}</p>

                    <div class="d-flex align-items-center gap-2">

                        @if ($brand->logo_url)
                            <img src="{{ $brand->logo_url }}" class="avatar avatar-xl rounded object-fit-cover">
                        @else
                            <span class="avatar avatar-xl rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-photo">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 8h.01" />
                                    <path
                                        d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                </svg>
                            </span>
                        @endif

                        <template x-if="logoUrl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-right">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7l5 5l-5 5" />
                                <path d="M13 7l5 5l-5 5" />
                            </svg>
                        </template>

                        <template x-if="logoUrl">
                            <img :src="logoUrl" class="avatar avatar-xl rounded object-fit-cover">
                        </template>
                    </div>
                </div>

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
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <a href="{{ route('admin.brands.index') }}" class="btn">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </x-admin.body>
</x-layouts.admin>

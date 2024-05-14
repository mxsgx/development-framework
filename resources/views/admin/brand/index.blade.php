<x-layouts.admin>
    <x-slot:title>{{ __('Manage Brands') }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Manage') }}
        </x-slot>

        <x-slot:title>
            {{ __('Brands') }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <div class="col-lg-8 mb-2">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th class="text-center">{{ __('Logo') }}</th>
                                <th class="text-center">{{ __('Cars with Brand') }}</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td class="text-center">
                                        @if ($brand->logo_url)
                                            <span class="avatar"
                                                style="background-image: url({{ $brand->logo_url }})"></span>
                                        @else
                                            <span class="avatar">?</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-secondary">
                                        {{ $brand->cars_count }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.brands.edit', ['brand' => $brand]) }}">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary">
                                        {{ __('No brands') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $brands->links('pagination.card-footer') }}
            </div>
        </div>

        <div class="col-lg-4">
            <h3 class="h2">Create a brand</h3>

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
                    <button type="reset" class="btn" x-on:click="clearPreview">{{ __('Reset') }}</button>
                </div>
            </form>
        </div>
    </x-admin.body>
</x-layouts.admin>

<x-layouts.admin>
    <x-slot:title>{{ __('Manage Brands') }}</x-slot>

    <div x-data="indexBrand">
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
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.brands.destroy', ['brand' => $brand]) }}"
                                                    class="text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger"
                                                    x-on:click="confirmDelete">{{ __('Delete') }}</a>
                                                <a
                                                    href="{{ route('admin.brands.edit', ['brand' => $brand]) }}">{{ __('Edit') }}</a>
                                            </div>
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

                <form action="{{ route('admin.brands.store') }}" method="post" enctype="multipart/form-data">
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

        <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
            <form class="modal-dialog modal-sm modal-dialog-centered" role="document" :action="deleteUrl"
                method="post">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v4" />
                            <path
                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                            <path d="M12 16h.01" />
                        </svg>
                        <h3>{{ __('Are you sure?') }}</h3>
                        <div class="text-secondary">
                            {{ __("Do you really want to delete this item? What you've done cannot be undone.") }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        @method('DELETE')

                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-danger w-100">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>

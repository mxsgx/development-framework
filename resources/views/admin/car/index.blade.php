<x-layouts.admin>
    <x-slot:title>{{ __('Manage Cars') }}</x-slot>

    <div x-data="indexCar">
        <x-admin.header>
            <x-slot:pretitle>
                {{ __('Manage') }}
            </x-slot>

            <x-slot:title>
                {{ __('Cars') }}
            </x-slot>

            <x-slot:actions>
                <div class="btn-list">
                    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>

                        {{ __('Add new car') }}
                    </a>
                    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary d-sm-none btn-icon"
                        aria-label="{{ __('Add new car') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                    </a>
                </div>
            </x-slot>
        </x-admin.header>

        <x-admin.body>
            <div class="col">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th class="w-1"></th>
                                    <th>{{ __('Brand') }}</th>
                                    <th>{{ __('Details') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cars as $car)
                                    <tr>
                                        <td>
                                            @if ($car->thumbnail_url)
                                                <img src="{{ $car->thumbnail_url }}" style="max-width: unset;"
                                                    width="160px" height="90px" class="object-fit-cover">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-photo-question text-secondary">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M15 8h.01" />
                                                    <path
                                                        d="M15 21h-9a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5.5" />
                                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" />
                                                    <path d="M19 22v.01" />
                                                    <path
                                                        d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                                                </svg>
                                            @endif
                                        </td>
                                        <td>{{ $car->brand->name }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @if ($car->isAvailable())
                                                    <small>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-check text-success">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12l5 5l10 -10" />
                                                        </svg>
                                                        {{ __('Available') }}
                                                    </small>
                                                @else
                                                    <small>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-x text-danger">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg>

                                                        {{ __('Unavailable') }}
                                                    </small>
                                                @endif

                                                @if ($car->with_driver)
                                                    <small class="mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-steering-wheel text-secondary">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                            <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path d="M12 14l0 7" />
                                                            <path d="M10 12l-6.75 -2" />
                                                            <path d="M14 12l6.75 -2" />
                                                        </svg>

                                                        {{ __('With Driver') }}
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-secondary">
                                            <div class="d-flex flex-column">
                                                <small>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-car">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path
                                                            d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
                                                    </svg>

                                                    {{ __('IDR :price', ['price' => $car->base_price]) }}
                                                </small>

                                                @if ($car->with_driver)
                                                    <small class="mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-steering-wheel">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                            <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path d="M12 14l0 7" />
                                                            <path d="M10 12l-6.75 -2" />
                                                            <path d="M14 12l6.75 -2" />
                                                        </svg>

                                                        {{ __('IDR :price', ['price' => $car->driver_price]) }}
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.cars.destroy', ['car' => $car]) }}"
                                                    class="text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger"
                                                    x-on:click="confirmDelete">{{ __('Delete') }}</a>
                                                <a href="{{ route('admin.cars.edit', ['car' => $car]) }}">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary">
                                            {{ __('No cars') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $cars->links('pagination.card-footer') }}
                </div>
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
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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

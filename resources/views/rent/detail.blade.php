<x-layouts.common>
    <x-slot:title>{{ config('app.name') }}</x-slot>

    <x-admin.header class="text-white">
        <x-slot:pretitle>{{ __('Welcome to') }}</x-slot>
        <x-slot:title>{{ config('app.name') }}</x-slot>

        <x-slot:actions>
            <div class="btn-list">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>

                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary d-sm-none btn-icon"
                    aria-label="{{ __('Dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                </a>
            </div>
        </x-slot>
    </x-admin.header>

    <x-admin.body class="row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 my-2">
                            <p class="h3 text-secondary">{{ __('Brand Merk') }}</p>
                            <p class="h1 mb-0">
                                {{ $car->brand->name }}
                            <p>
                        </div>
                        <div class="col-lg-4 my-2">
                            <p class="h3 text-secondary">{{ __('Transmission Type') }}</p>
                            <p class="h1 mb-0">
                                {{ $car->transmission_type->name }}
                            <p>
                        </div>
                        <div class="col-lg-4 my-2">
                            <p class="h3 text-secondary">{{ __('Color') }}</p>
                            <p class="h1 mb-0">
                                {{ str($car->color)->upper() }}
                            <p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @if ($car->imagePreviews->count() > 0)
                        <div class="mb-2">
                            <h3>{{ __('Previews') }}</h3>
                        </div>

                        <div id="carousel-indicators-thumb" class="carousel slide carousel-fade mb-4"
                            data-bs-ride="carousel">
                            <div class="carousel-indicators carousel-indicators-thumb">
                                @foreach ($car->imagePreviews as $image)
                                    <button type="button" data-bs-target="#carousel-indicators-thumb"
                                        data-bs-slide-to="{{ $loop->index }}"
                                        class="ratio ratio-4x3 @if ($loop->first) active @endif"
                                        style="background-image: url({{ $image->url }})"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($car->imagePreviews as $image)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img class="d-block w-100" src="{{ $image->url }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-2">
                        <h3>{{ __('Detail') }}</h3>
                    </div>

                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                {{ __('Name') }}
                            </div>
                            <div class="datagrid-content">
                                {{ $car->name }}
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                {{ __('Vehicle Year') }}
                            </div>
                            <div class="datagrid-content">
                                {{ $car->vehicle_year }}
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                {{ __('Total Seat(s)') }}
                            </div>
                            <div class="datagrid-content">
                                {{ $car->total_seat }}
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                {{ __('Total Baggage(s)') }}
                            </div>
                            <div class="datagrid-content">
                                {{ $car->total_baggage }}
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                {{ __('Driver Availability') }}
                            </div>
                            <div class="datagrid-content">
                                {{ $car->with_driver ? __('Driver Available') : __('Driver Unavailable') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form class="col-lg-4" method="post" action="{{ '#' }}">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h3>{{ __('Pricing') }}</h3>
                    </div>

                    <div class="d-flex justify-content-between mb-0">
                        <p class="fw-bold mb-0">
                            {{ __('Base') }}
                        </p>
                        <span>{{ __('IDR :price/day', ['price' => $car->base_price]) }}</span>
                    </div>

                    @if ($car->with_driver)
                        <div class="d-flex justify-content-between mt-2">
                            <p class="fw-bold mb-0">
                                {{ __('Driver') }}
                            </p>
                            <span>{{ __('IDR :price/day', ['price' => $car->driver_price]) }}</span>
                        </div>
                    @endif

                    <div class="mb-2 mt-3">
                        <h3>{{ __('Rent this car') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label for="start-date" class="form-label required">{{ __('Start date') }}</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                    </path>
                                    <path d="M16 3v4"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M4 11h16"></path>
                                    <path d="M11 15h1"></path>
                                    <path d="M12 15v3"></path>
                                </svg>
                            </span>
                            <input class="form-control" id="start-date" name="start_date"
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="end-date" class="form-label required">{{ __('End date') }}</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                    </path>
                                    <path d="M16 3v4"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M4 11h16"></path>
                                    <path d="M11 15h1"></path>
                                    <path d="M12 15v3"></path>
                                </svg>
                            </span>
                            <input class="form-control" id="end-date" name="end_date"
                                value="{{ now()->addDays(1)->format('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">{{ __('Service(s)') }}</div>
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="with_driver"
                                @disabled(!$car->with_driver)>
                            <span class="form-check-label">{{ __('With Driver') }}</span>
                        </label>
                    </div>

                    <div class="mb-3">
                        <h3>{{ __('Summary') }}</h3>
                    </div>

                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th>{{ __('Services') }}</th>
                                <th class="text-center" style="width: 1%">{{ __('Day(s)') }}</th>
                                <th class="text-end" style="width: 1%">{{ __('Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('Base') }}</td>
                                <td class="text-center">1</td>
                                <td class="text-end">{{ $car->base_price }}</td>
                            </tr>
                            @if ($car->with_driver)
                                <tr>
                                    <td>{{ __('Driver') }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-end">{{ $car->driver_price }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="2" class="strong text-end">{{ __('Total') }}</td>
                                <td class="text-end">{{ $car->base_price + $car->driver_price }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-full">{{ __('Booking Now') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </x-admin.body>

    @push('scripts')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                window.Litepicker && (new Litepicker({
                    element: document.getElementById('start-date'),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                }));

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('end-date'),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                }));
            });
        </script>
    @endpush
</x-layouts.common>

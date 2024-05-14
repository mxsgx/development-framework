<x-layouts.admin>
    <x-slot:title>{{ __('Edit Car') }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Edit') }}
        </x-slot>

        <x-slot:title>
            {{ __('Car') }}
        </x-slot>
    </x-admin.header>

    <x-admin.body>
        <form action="{{ route('admin.cars.update', ['car' => $car]) }}" class="col" method="post"
            enctype="multipart/form-data">
            <div class="row row-cards">
                <div class="col-lg-8">
                    <div class="row row-cards">
                        <div class="col-12">
                            <h3 class="h3 mb-0">{{ __('Basic Information') }}</h3>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="name" class="form-label required">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" id="name" value="{{ $car->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            @csrf
                            @method('PATCH')
                            <label for="brand" class="form-label required">{{ __('Brand') }}</label>
                            <select name="brand_id" id="brand" class="form-select">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        data-custom-properties="{{ $brand->logo_url ? '<span class="avatar avatar-xs" style="background-image: url(' . $brand->logo_url . ')"></span>' : '<span class="avatar avatar-xs">?</span>' }}"
                                        @selected($brand->id == $car->brand_id)>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="plate-number" class="form-label required">{{ __('Plate number') }}</label>
                            <input type="text" class="form-control @error('plate_number') is-invalid @enderror"
                                name="plate_number" id="plate-number" placeholder="{{ __('example: AB1234CD') }}"
                                value="{{ $car->plate_number }}">
                            @error('plate_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="vehicle-year" class="form-label required">{{ __('Vehicle year') }}</label>
                            <input type="number" class="form-control @error('vehicle_year') is-invalid @enderror"
                                name="vehicle_year" id="vehicle-year" placeholder="{{ __('example: 2018') }}"
                                value="{{ $car->vehicle_year }}">
                            @error('vehicle_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="color" class="form-label required">{{ __('Color') }}</label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror"
                                name="color" id="color" placeholder="{{ __('example: RED') }}"
                                value="{{ $car->color }}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <h3 class="h3 mb-0">{{ __('Car Specification') }}</h3>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="total-seat" class="form-label required">{{ __('Total seat') }}</label>
                            <input type="number" class="form-control @error('total_seat') is-invalid @enderror"
                                name="total_seat" id="total-seat" placeholder="{{ __('example: 1') }}"
                                value="{{ $car->total_seat }}">
                            @error('total_seat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="total-baggage" class="form-label required">{{ __('Total baggage') }}</label>
                            <input type="number" class="form-control @error('total_baggage') is-invalid @enderror"
                                name="total_baggage" id="total-baggage" placeholder="{{ __('example: 1') }}"
                                value="{{ $car->total_baggage }}">
                            @error('total_baggage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">{{ __('Transmission type') }}</label>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-row">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="transmission_type" value="automatic"
                                            id="transmission-type" class="form-selectgroup-input"
                                            @checked($car->transmission_type->value == 'automatic')>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="d-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-letter-a-small">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 16v-6a2 2 0 1 1 4 0v6" />
                                                    <path d="M10 13h4" />
                                                </svg>
                                                <span>{{ __('Automatic') }}</span>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="transmission_type" value="manual"
                                            class="form-selectgroup-input" @checked($car->transmission_type->value == 'manual')>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="d-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-letter-m-small">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 16v-8l3 5l3 -5v8" />
                                                </svg>
                                                <span>{{ __('Manual') }}</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h3 class="h3 mb-0">{{ __('Pricing') }}</h3>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label class="form-label required" for="base-price">{{ __('Base Price') }}
                                <small>{{ __('per day') }}</small></label>
                            <div class="input-group input-group-flat @error('base_price') is-invalid @enderror">
                                <span class="input-group-text px-3">IDR</span>
                                <input type="number"
                                    class="form-control ps-0 @error('base_price') is-invalid @enderror"
                                    placeholder="500000" name="base_price" id="base-price"
                                    value="{{ $car->base_price }}">
                            </div>
                            @error('base_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-check form-switch mb-0 @error('with_driver') is-invalid @enderror">
                                <input class="form-check-input @error('with_driver') is-invalid @enderror"
                                    type="checkbox" id="with-driver" name="with_driver" value="1"
                                    @checked($car->with_driver)>
                                <span class="form-check-label">{{ __('With Driver') }}</span>
                            </label>
                            @error('with_driver')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label class="form-label" for="driver-price">{{ __('Driver Price') }}
                                <small>{{ __('per day') }}</small><small
                                    class="text-danger ms-1">{{ __('* required if With Driver is enabled') }}</small></label>
                            <div class="input-group input-group-flat @error('driver_price') is-invalid @enderror">
                                <span class="input-group-text px-3">IDR</span>
                                <input type="number"
                                    class="form-control ps-0 @error('driver_price') is-invalid @enderror"
                                    placeholder="25000" name="driver_price" id="driver-price"
                                    value="{{ $car->driver_price }}">
                            </div>
                            @error('driver_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="col-12 mb-2">
                        <h3 class="h3 mb-0">{{ __('Settings') }}</h3>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('Availability') }}</label>
                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" name="status" value="available" id="status"
                                        class="form-selectgroup-input" @checked($car->status->value == 'available')>
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content">
                                            <span
                                                class="form-selectgroup-title strong mb-1">{{ __('Available') }}</span>
                                            <span
                                                class="d-block text-secondary">{{ __('Ready for rent and will display it on catalog.') }}</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" name="status" value="unavailable"
                                        class="form-selectgroup-input" @checked($car->status->value == 'unavailable')>
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content">
                                            <span
                                                class="form-selectgroup-title strong mb-1">{{ __('Unavailable') }}</span>
                                            <span
                                                class="d-block text-secondary">{{ __("Vehicle is not available, on rent, don't show up.") }}</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <h3 class="h3 mb-0">{{ __('Media') }}</h3>
                    </div>

                    <div class="col-12">
                        @if ($car->thumbnail_url)
                            <img src="{{ $car->thumbnail_url }}" class="w-50 mb-2 object-fit-cover">
                        @endif
                        <label class="form-label" for="previews">{{ __('Choose image') }}</label>
                        <input type="file" id="previews" name="previews[]" accept="image/jpeg,image/png"
                            class="form-control @error('previews') is-invalid @enderror">
                        @error('previews')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <hr>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-admin.body>

    @push('scripts')
        <script type="text/javascript">
            window.addEventListener('load', function() {
                window.IMask && window.IMask(document.getElementById('vehicle-year'), {
                    mask: '0000',
                })
            });
            document.addEventListener('DOMContentLoaded', function() {
                var el;

                window.TomSelect && (new TomSelect(el = document.getElementById('brand'), {
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

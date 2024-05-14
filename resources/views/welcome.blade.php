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
                        <div class="col-lg-3 my-2">
                            <div class="form-label">{{ __('Driver Availability') }}</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="with_driver" value="1"
                                        @checked(request()->get('with_driver') === '1')>
                                    <span class="form-check-label">{{ __('With Driver') }}</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="with_driver" value="0"
                                        @checked(request()->get('with_driver') === '0')>
                                    <span class="form-check-label">{{ __('Without Driver') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 my-2">
                            <label class="form-label">{{ __('Total Baggage(s)') }}</label>
                            <input type="number" class="form-control" name="total_baggage">
                        </div>
                        <div class="col-lg-3 my-2">
                            <label class="form-label">{{ __('Total Seat(s)') }}</label>
                            <input type="number" class="form-control" name="total_seat">
                        </div>
                        <div class="col-lg-3 my-2">
                            <label class="form-label sr-only">{{ __('Action') }}</label>
                            <button type="submit" class="btn btn-primary w-full h-full">{{ __('Search') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="row row-cards">
                @forelse ($cars as $car)
                    <div class="col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 align-items-center d-flex mb-lg-0 mb-2">
                                        <img src="{{ $car->thumbnail_url }}" class="w-full object-fit-cover"
                                            style="height: 120px">
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="h2">{{ $car->name }}</p>
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-armchair">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 11a2 2 0 0 1 2 2v2h10v-2a2 2 0 1 1 4 0v4a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                <path d="M5 11v-5a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v5" />
                                                <path d="M6 19v2" />
                                                <path d="M18 19v2" />
                                            </svg>
                                            {{ __('Total Seat(s): :seat', ['seat' => $car->total_seat]) }}
                                        </p>
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-luggage">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M6 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                                <path d="M9 6v-1a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1" />
                                                <path d="M6 10h12" />
                                                <path d="M6 16h12" />
                                                <path d="M9 20v1" />
                                                <path d="M15 20v1" />
                                            </svg>
                                            {{ __('Total Baggage(s): :baggage', ['baggage' => $car->total_baggage]) }}
                                        </p>
                                        <p>
                                            @if ($car->with_driver)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-steering-wheel">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M12 14l0 7" />
                                                    <path d="M10 12l-6.75 -2" />
                                                    <path d="M14 12l6.75 -2" />
                                                </svg>
                                                {{ __('With Driver') }}
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-steering-wheel-off">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M20.04 16.048a9 9 0 0 0 -12.083 -12.09m-2.32 1.678a9 9 0 1 0 12.737 12.719" />
                                                    <path d="M10.595 10.576a2 2 0 1 0 2.827 2.83" />
                                                    <path d="M12 14v7" />
                                                    <path d="M10 12l-6.75 -2" />
                                                    <path d="M15.542 11.543l5.208 -1.543" />
                                                    <path d="M3 3l18 18" />
                                                </svg>
                                                {{ __('Without Driver') }}
                                            @endif
                                        </p>
                                        <a href="{{ route('rent.detail', ['car' => $car]) }}"
                                            class="btn btn-primary w-full">{{ __('Rent') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </x-admin.body>
</x-layouts.common>

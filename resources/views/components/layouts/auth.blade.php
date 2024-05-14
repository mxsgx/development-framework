<x-layouts.base>
    <x-slot:title>{{ $title ?? '' }}</x-slot>

    <div class="d-flex flex-column h-100">
        <div class="page page-center">
            <div {{ $attributes->merge(['class' => 'container py-4']) }}>
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" title="{{ config('app.name') }}">
                        <img src="{{ asset('storage/assets/svg/city-driver.svg') }}" width="256px" alt="Illustration">
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.base>

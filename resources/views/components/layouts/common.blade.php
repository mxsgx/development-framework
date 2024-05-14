<x-layouts.base>
    <x-slot:title>{{ $title ?? '' }}</x-slot>

    <div class="page">
        <x-common.navigation />

        <div class="page-wrapper">
            {{ $slot }}
        </div>
    </div>
</x-layouts.base>

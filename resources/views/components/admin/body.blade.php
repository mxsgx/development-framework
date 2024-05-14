<div class="page-body">
    <div class="container-xl">
        <div {{ $attributes->merge(['class' => 'row row-cards']) }}>
            {{ $slot }}
        </div>
    </div>
</div>

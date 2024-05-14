<div {{ $attributes->merge(['class' => 'page-header d-print-none']) }}>
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                @if ($pretitle)
                    <div class="page-pretitle">{{ $pretitle }}</div>
                @endif

                <h2 class="page-title">{{ $title ?? __('Page Title') }}</h2>
            </div>

            @if ($actions ?? false)
                <div class="col-auto ms-auto d-print-none">{{ $actions }}</div>
            @endif
        </div>
    </div>
</div>

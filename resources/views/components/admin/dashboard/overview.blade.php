@props([
    'top',
    'bottom',
])

<div class="col-sm-6 col-lg-3">
    <div class="card card-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="bg-primary text-white avatar">
                        @if ($icon ?? false)
                            {{ $icon }}
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-question-mark">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4" />
                                <path d="M12 19l0 .01" />
                            </svg>
                        @endif
                    </span>
                </div>
                <div class="col">
                    <div class="font-weight-medium">
                        {{ $top }}
                    </div>
                    <div class="text-secondary">
                        {{ $bottom }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

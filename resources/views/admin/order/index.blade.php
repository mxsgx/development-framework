<x-layouts.admin>
    <x-slot:title>{{ __('Manage Transactions') }}</x-slot>

    <div>
        <x-admin.header>
            <x-slot:pretitle>
                {{ __('Manage') }}
            </x-slot>

            <x-slot:title>
                {{ __('Transactions') }}
            </x-slot>
        </x-admin.header>

        <x-admin.body>
            <div class="col-lg-8 mb-2">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Customer') }}</th>
                                    <th class="text-center">{{ __('Car') }}</th>
                                    <th class="text-center">{{ __('Date') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->customer->name }}</td>
                                        <td class="text-center">
                                            {{ $order->car->name }}
                                        </td>
                                        <td class="text-center text-secondary">
                                            {{ $order->start_date->diffInDays($order->end_date) }} days
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ '#' }}"
                                                   class="text-primary">{{ __('Process') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-secondary">
                                            {{ __('No orders') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $orders->links('pagination.card-footer') }}
                </div>
            </div>
        </x-admin.body>
    </div>
</x-layouts.admin>

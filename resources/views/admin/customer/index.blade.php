<x-layouts.admin>
    <x-slot:title>{{ __('Manage Customers') }}</x-slot>

    <x-admin.header>
        <x-slot:pretitle>
            {{ __('Manage') }}
        </x-slot>

        <x-slot:title>
            {{ __('Customers') }}
        </x-slot>

        <x-slot:actions>
            <div class="btn-list">
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>

                    {{ __('Create new customer') }}
                </a>
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary d-sm-none btn-icon"
                    aria-label="{{ __('Create new customer') }}">
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

    <x-admin.body>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone Number') }}</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td class="text-secondary">
                                        {{ $customer->user ? $customer->user->email : '-' }}
                                    </td>
                                    <td class="text-secondary">
                                        {{ $customer->phone_number }}
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.customers.edit', ['customer' => $customer]) }}">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary">
                                        {{ __('No customers') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $customers->links('pagination.card-footer') }}
            </div>
        </div>
    </x-admin.body>
</x-layouts.admin>

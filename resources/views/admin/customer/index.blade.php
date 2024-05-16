<x-layouts.admin>
    <x-slot:title>{{ __('Manage Customers') }}</x-slot>

    <div x-data="indexCustomer">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>

                        {{ __('Create new customer') }}
                    </a>
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary d-sm-none btn-icon"
                        aria-label="{{ __('Create new customer') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
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
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.customers.destroy', ['customer' => $customer]) }}"
                                                    class="text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger"
                                                    x-on:click="confirmDelete">{{ __('Delete') }}</a>
                                                <a
                                                    href="{{ route('admin.customers.edit', ['customer' => $customer]) }}">Edit</a>
                                            </div>
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

        <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
            <form class="modal-dialog modal-sm modal-dialog-centered" role="document" :action="deleteUrl"
                method="post">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v4" />
                            <path
                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                            <path d="M12 16h.01" />
                        </svg>
                        <h3>{{ __('Are you sure?') }}</h3>
                        <div class="text-secondary">
                            {{ __("Do you really want to delete this item? What you've done cannot be undone.") }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        @method('DELETE')

                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-danger w-100">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>

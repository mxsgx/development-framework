<x-layouts.admin>
    <x-slot:title>{{ __('Manage Users') }}</x-slot>

    <div x-data="indexUser">
        <x-admin.header>
            <x-slot:pretitle>
                {{ __('Manage') }}
            </x-slot>

            <x-slot:title>
                {{ __('Users') }}
            </x-slot>

            <x-slot:actions>
                <div class="btn-list">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>

                        {{ __('Create new user') }}
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-sm-none btn-icon"
                        aria-label="{{ __('Create new user') }}">
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
                        <table class="table table-vcenter card-table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th class="w-1"></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th></th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            @if ($user->avatar_url)
                                                <span class="avatar"
                                                    style="background-image: url({{ $user->avatar_url }})"></span>
                                            @else
                                                <span class="avatar">?</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-secondary">
                                            {{ $user->role->name }}
                                        </td>
                                        <td class="text-secondary">
                                            @if ($user->isCustomer())
                                                @if (!$user->customer)
                                                    <small class="badge bg-red-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg>

                                                        {{ __('Customer Data') }}
                                                    </small>
                                                @elseif (!$user->customer->isDataCompleted())
                                                    <small class="badge bg-yellow-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-mark">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 19v.01" />
                                                            <path d="M12 15v-10" />
                                                        </svg>

                                                        {{ __('Customer Data') }}
                                                    </small>
                                                @elseif($user->customer->isDataCompleted())
                                                    <small class="badge bg-green-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12l5 5l10 -10" />
                                                        </svg>

                                                        {{ __('Customer Data') }}
                                                    </small>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.users.destroy', ['user' => $user]) }}"
                                                    class="text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger"
                                                    x-on:click="confirmDelete">{{ __('Delete') }}</a>
                                                <a href="{{ route('admin.users.edit', ['user' => $user]) }}">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary">
                                            {{ __('No users') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links('pagination.card-footer') }}
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
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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

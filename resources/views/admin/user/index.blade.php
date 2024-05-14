<x-layouts.admin>
    <x-slot:title>{{ __('Manage Users') }}</x-slot>

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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>

                    {{ __('Create new user') }}
                </a>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-sm-none btn-icon"
                    aria-label="{{ __('Create new user') }}">
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
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
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
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
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
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
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
                                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}">Edit</a>
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
</x-layouts.admin>

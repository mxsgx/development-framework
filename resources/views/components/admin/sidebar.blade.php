<aside {{ $attributes->merge(['class' => 'navbar navbar-vertical navbar-expand-lg', 'data-bs-theme' => 'dark']) }}>
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('storage/assets/png/logo-dark.png') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>

        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 show" data-bs-toggle="dropdown"
                    aria-label="{{ __('Open user menu') }}" aria-expanded="true">
                    <span class="avatar avatar-rounded avatar-sm"
                        style="background-image: url({{ auth()->user()->avatar_url }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name }}</div>
                        <div class="mt-1 small text-secondary">{{ auth()->user()->role->name }} </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" data-bs-popper="static">
                    @if (Route::has('telescope') && auth()->user()->isAdmin())
                        <a href="{{ route('telescope') }}" class="dropdown-item">Telescope</a>
                    @endif
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('auth.logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <div class="navbar-collapse collapse" id="sidebar-menu">
            <div class="navbar-nav pt-lg-3">
                <div class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M13.45 11.55l2.05 -2.05" />
                                <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Dashboard') }}</span>
                    </a>
                </div>

                <div class="nav-item dropdown {{ Route::is('admin.brands.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ Route::is('admin.brands.*') ? 'show' : '' }}" href="#"
                        data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.brands.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-badge-tm">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M6 9h4" />
                                <path d="M8 9v6" />
                                <path d="M13 15v-6l2 3l2 -3v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Brands') }}
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.brands.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ Route::is('admin.brands.index') ? 'active' : '' }}"
                            href="{{ route('admin.brands.index') }}">
                            {{ __('Manage brands') }}
                        </a>
                        <a class="dropdown-item {{ Route::is('admin.brands.create') ? 'active' : '' }}"
                            href="{{ route('admin.brands.create') }}">
                            {{ __('Add new brand') }}
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown {{ Route::is('admin.cars.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ Route::is('admin.cars.*') ? 'show' : '' }}" href="#"
                        data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.cars.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-car">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Cars') }}
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.cars.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ Route::is('admin.cars.index') ? 'active' : '' }}"
                            href="{{ route('admin.cars.index') }}">
                            {{ __('Manage cars') }}
                        </a>
                        <a class="dropdown-item {{ Route::is('admin.cars.create') ? 'active' : '' }}"
                            href="{{ route('admin.cars.create') }}">
                            {{ __('Add new car') }}
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown {{ Route::is('admin.users.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ Route::is('admin.users.*') ? 'show' : '' }}" href="#"
                        data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.users.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Users') }}
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.users.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ Route::is('admin.users.index') ? 'active' : '' }}"
                            href="{{ route('admin.users.index') }}">
                            {{ __('Manage users') }}
                        </a>
                        <a class="dropdown-item {{ Route::is('admin.users.create') ? 'active' : '' }}"
                            href="{{ route('admin.users.create') }}">
                            {{ __('Create new user') }}
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown {{ Route::is('admin.customers.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ Route::is('admin.customers.*') ? 'show' : '' }}"
                        href="#" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.customers.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Customers') }}
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.customers.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ Route::is('admin.customers.index') ? 'active' : '' }}"
                            href="{{ route('admin.customers.index') }}">
                            {{ __('Manage customers') }}
                        </a>
                        <a class="dropdown-item {{ Route::is('admin.customers.create') ? 'active' : '' }}"
                            href="{{ route('admin.customers.create') }}">
                            {{ __('Create new customer') }}
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-license">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                <path d="M9 7l4 0" />
                                <path d="M9 11l4 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Orders') }}
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.orders.index') }}">
                            {{ __('Transactions') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.orders.create') }}">
                            {{ __('Make new order') }}
                        </a>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ '#' }}" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                <path d="M18 14v4h4" />
                                <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                                <path
                                    d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M8 11h4" />
                                <path d="M8 15h3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Report') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>

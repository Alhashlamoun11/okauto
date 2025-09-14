<header class="header fixed-header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo m-0" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="@lang('image')" /></a>
            <button class="navbar-toggler header-button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" type="button" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="offcanvas offcanvas-start border-0" id="offcanvasDarkNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <a class="logo navbar-brand" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="@lang('image')" /></a>
                    <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    
                    <ul class="navbar-nav w-100 justify-content-lg-center nav-menu align-items-lg-center">
                        <li class="navbar-nav__bar"></li>
                        <li class="language dropdown d-lg-none">
                            @include($activeTemplate . 'partials.language')
                        </li>
                        <li class="language dropdown d-lg-none">
                            
                        </li>
                        <li class="nav-item {{ menuActive('home') }}">
                            <a class="nav-link" href="{{ route('home') }}" aria-current="page">@lang('Home')</a>
                        </li>
                        @php
                            $pages = App\Models\Page::where('tempname', $activeTemplate)
                                ->where('is_default', Status::NO)
                                ->get();
                        @endphp
                        @foreach ($pages as $k => $data)
                            <li class="nav-item @if ($data->slug == Request::segment(1)) active @endif">
                                <a class="nav-link" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                            </li>
                        @endforeach
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                @lang('Vehicles')
                                <span class="nav-item__icon"><i class="las la-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu header-dropdown">
                                @foreach ($vehicleTypes as $vehicleType)
                                    <li class="dropdown-menu__list">
                                        <a class="dropdown-item dropdown-menu__link" href="{{ route('vehicles', $vehicleType->slug) }}">{{ __($vehicleType->name) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item {{ menuActive('blog') }}">
                            <a class="nav-link" href="{{ route('blog') }}">@lang('Blog')</a>
                        </li>
                        <li class="nav-item {{ menuActive('contact') }}">
                            <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>
                        <li class="nav-item d-lg-none mt-4">
                            <div class="header-right d-lg-none">
                                <div class="header-button flex-align gap-3">
                                    @auth
                                        <a class="btn btn-outline--base-two" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                                        <a class="btn btn--gradient" href="{{ route('user.logout') }}">@lang('Logout')</a>
                                    @else
                                        <a class="btn btn-outline--base-two" href="{{ route('user.login') }}">@lang('Login')</a>
                                        <a class="btn btn--gradient" href="{{ route('user.register') }}">@lang('Register')</a>
                                    @endauth
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
<div class="header-right d-none d-lg-block">
    @auth
    <div class="header-button flex-align gap-3">
        {{-- Notifications --}}
        <div class="language dropdown">
            <a class="btn dropdown-toggle" style="padding:0;" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i style="color:black" class="las la-bell fs-4"></i>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger" id="notificationBadge">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-2 shadow" aria-labelledby="notificationDropdown" style="color:black;width: 400px;max-width:400px; max-height: 400px; overflow-y: auto;">
                @forelse(auth()->user()->unreadNotifications->take(9) as $notification)
                    <li style="padding:5px;color:black;" class="mb-1 small border-bottom pb-1">
                        {{ $notification->title ?? 'Notification' }}
                        <br>
                        <small style="color:black!important;" class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </li>
                @empty
                    <li style="color:black!important;" class="text-center text-muted" id="noNotifications">@lang('No Notifications')</li>
                @endforelse
                @if(auth()->user()->unreadNotifications->count() > 0)
                <li class="text-center mt-2">
                    <button class="btn btn-sm btn--gradient" id="markAllReadBtn" @if(auth()->user()->unreadNotifications->count() == 0) disabled @endif>
                        @lang('Mark All as Read')
                    </button>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const markAllReadBtn = document.getElementById('markAllReadBtn');
    const notificationBadge = document.getElementById('notificationBadge');
    const noNotifications = document.getElementById('noNotifications');

    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function () {
            fetch('{{ route('user.notifications.markAllRead') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove all notification items
                    const notificationList = document.querySelectorAll('.dropdown-menu li:not(:last-child):not(#noNotifications)');
                    notificationList.forEach(item => item.remove());
                    
                    // Show "No Notifications" message if hidden
                    if (noNotifications) {
                        noNotifications.style.display = 'block';
                    }
                    
                    // Hide badge and disable button
                    if (notificationBadge) {
                        notificationBadge.remove();
                    }
                    markAllReadBtn.disabled = true;
                } else {
                    alert('Failed to mark notifications as read: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while marking notifications as read.');
            });
        });
    }
});</script>
    @endauth
</div>
            <div class="header-right d-none d-lg-block">
                <div class="header-button flex-align gap-3">
                    <div class="language dropdown d-none d-lg-flex">
                        @include($activeTemplate . 'partials.language')
                    </div>
                    @auth
                        <a class="btn btn-outline--base-two" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                        <a class="btn btn--gradient" href="{{ route('user.logout') }}">@lang('Logout')</a>
                    @else
                        <a class="btn btn-outline--base-two" href="{{ route('user.login') }}">@lang('Login')</a>
                        <a class="btn btn--gradient" href="{{ route('user.register') }}">@lang('Register')</a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>

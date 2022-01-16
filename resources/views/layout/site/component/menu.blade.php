<div class="row mb-3 justify-content-md-center">

    <div class="col-2 px-1">
        <a href="{{ route('Site-HomeGetShow') }}" class="text-decoration-none">
            <div
                class="card rounded-3 {{ isset($menu_active) && $menu_active == 'home' ? 'menu-active' : 'menu-groupe' }} shadow-sm">
                <div class="card-body text-center text-truncate rounded-3 p-1">
                    <i class="mdi mdi-home mdi-{{ Browser::isMobile() ? 24 : 36 }}px d-block"></i>
                    <span class="d-none d-md-block fw-bold">{{ __('site.label.dashboard') }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-2 px-1">
        <a href="{{ route('Site-SubscriptionGetShow') }}" class="text-decoration-none">
            <div
                class="card rounded-3 {{ isset($menu_active) && $menu_active == 'subscription' ? 'menu-active' : 'menu-groupe' }} shadow-sm">
                <div class="card-body text-center text-truncate rounded-3 p-1">
                    <i class="mdi mdi-buffer mdi-{{ Browser::isMobile() ? 24 : 36 }}px d-block"></i>
                    <span class="d-none d-md-block fw-bold">{{ __('site.label.suscribe') }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-2 px-1">
        <a href="{{ route('Site-PointGetShow') }}" class="text-decoration-none">
            <div
                class="card rounded-3 {{ isset($menu_active) && $menu_active == 'point' ? 'menu-active' : 'menu-groupe' }} shadow-sm">
                <div class="card-body text-center text-truncate rounded-3 p-1">
                    <i class="mdi mdi-star-circle mdi-{{ Browser::isMobile() ? 24 : 36 }}px d-block"></i>
                    <span class="d-none d-md-block fw-bold">{{ __('site.label.point') }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-2 px-1">
        <a href="{{ route('Site-OrderGetShow') }}" class="text-decoration-none">
            <div
                class="card rounded-3 {{ isset($menu_active) && $menu_active == 'order' ? 'menu-active' : 'menu-groupe' }} shadow-sm">
                <div class="card-body text-center text-truncate rounded-3 p-1">
                    <i class="mdi mdi-shopping mdi-{{ Browser::isMobile() ? 24 : 36 }}px d-block"></i>
                    <span class="d-none d-md-block fw-bold">{{ __('site.label.order') }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-2 px-1">
        <a href="{{ route('Site-TicketGetShow') }}" class="text-decoration-none">
            <div
                class="card rounded-3 {{ isset($menu_active) && $menu_active == 'ticket' ? 'menu-active' : 'menu-groupe' }} shadow-sm">
                <div class="card-body text-center text-truncate rounded-3 p-1">
                    <i class="mdi mdi-lifebuoy mdi-{{ Browser::isMobile() ? 24 : 36 }}px d-block"></i>
                    <span class="d-none d-md-block fw-bold">{{ __('site.label.ticket') }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-2 px-1">
        <a href="{{ route('Site-NotificationGetShow') }}" class="text-decoration-none">
            <div
                class="card rounded-3 {{ isset($menu_active) && $menu_active == 'notification' ? 'menu-active' : 'menu-groupe' }} shadow-sm">
                <div class="card-body text-center text-truncate rounded-3 p-1">
                    <i class="mdi mdi-bell mdi-{{ Browser::isMobile() ? 24 : 36 }}px d-block"></i>
                    <span class="d-none d-md-block fw-bold">{{ __('site.label.notification') }}</span>
                </div>
            </div>
        </a>
    </div>

</div>
<div class="sticky-top bg-white border-bottom">
    <div class="container">
        <div class="row">

            <div class="col-4 col-sm-4 col-md-9">
                <a class="navbar-brand" href="{{ route('Site-HomeGetShow') }}">
                    <img class="{{ !Browser::isMobile() ? 'h-70px' : 'h-54' }}"
                        src="{{ cdn_asset('/dist/all/img/logo/logo.png') }}" alt="logo winihost">
                </a>
            </div>

            <div class="col-8 col-sm-8 col-md-3 align-self-center text-end pe-0">

                <div class="d-flex justify-content-around">

                    @if (App::getLocale() == 'en')
                    <a href="{{ route('PreferenceGetLanguage',['local'=>'fr']) }}" class="text-decoration-none my-1"
                        title="Frensh">
                        <img src="{{ cdn_asset('/dist/all/img/flag/fr.png') }}" class="rounded h-18px w-27px"
                            alt="langue">
                    </a>
                    @else
                    <a href="{{ route('PreferenceGetLanguage',['local' => 'en']) }}" class="my-1 text-decoration-none"
                        title="English">
                        <img src="{{ cdn_asset('/dist/all/img/flag/gb.png') }}" class="rounded h-18px w-27px "
                            alt="langue">
                    </a>
                    @endif

                    <div class="dropdown">
                        <a class="mdi mdi-currency-eur mdi-24px dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach (session('UserSession.app_info.currency') as $iso => $currency)
                            <li>
                                <a class="dropdown-item" href="{{ route('PreferenceGetcurrency', ['iso' => $iso]) }}">
                                    {{ $currency['name'] }} ({{ $currency['symbol'] }})
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ route('Site-CartGetShow') }}" class="text-decoration-none"
                        title="{{ __('site.label.cart') }}">
                        <i class="mdi mdi-cart mdi-24px"></i>
                        @if (session('UserSession.profil.cart'))
                        <span class="badge rounded-pill bg-danger badge-float">
                            {{ session('UserSession.profil.cart') ?? '-' }}
                        </span>
                        @endif
                    </a>

                    <a href="{{ route('Site-NotificationGetShow') }}" class="text-decoration-none"
                        title="{{ __('site.label.notification') }}">
                        <i class="mdi mdi-bell mdi-24px"></i>
                        @if (session('UserSession.profil.notification'))
                        <span class="badge rounded-pill bg-danger badge-float">
                            {{ session('UserSession.profil.notification') ?? '-' }}
                        </span>
                        @endif
                    </a>

                    <div class="dropdown">
                        <span class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false" title="{{ __('site.label.my_account') }}">
                            <i class="mdi mdi-account-circle mdi-24px"></i>
                        </span>
                        <ul class="dropdown-menu dropdown-content-position bg-f0f0f0"
                            aria-labelledby="dropdownMenuButton">
                            <li class="text-truncate">
                                <a class="dropdown-item fw-bold" href="{{ route('Site-HomeGetShow') }}">
                                    <i class="mdi mdi-account"></i>
                                    {{ __('site.label.my_account') }}
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('Site-SubscriptionGetShow') }}">
                                    <i class="mdi mdi-buffer"></i>
                                    {{ __('site.label.suscribe') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('Site-PointGetShow') }}">
                                    <i class="mdi mdi-star-circle"></i>
                                    {{ __('site.label.point') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('Site-OrderGetShow') }}">
                                    <i class="mdi mdi-cart"></i>
                                    {{ __('site.label.order') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('Site-TicketGetShow') }}">
                                    <i class="mdi mdi-lifebuoy"></i>
                                    {{ __('site.label.ticket') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('Site-NotificationGetShow') }}">
                                    <i class="mdi mdi-bell"></i>
                                    {{ __('site.label.notification') }}
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger fw-bold" href="{{ route('Auth-LogoutGetShow') }}">
                                    <i class="mdi mdi-power"></i>
                                    {{ __('site.label.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
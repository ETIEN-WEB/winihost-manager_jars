<div class="card {{ Browser::isMobile() ? 'mb-3' : 'mb-5' }}">
    <div class="card-body py-2">
        <div class="container">
            <div class="row">

                <div class="col-md-2 align-self-center">
                    <a href="https://{{ config('myconfig.APP_BASE_URL') }}" title="Logo WiniHost" target="blank">
                        <img src="{{ cdn_asset('/dist/all/img/logo/logo.png') }}" alt="Logo WiniHost"
                            class="rounded mx-auto d-block" height="70px" width="173px" title="Logo WiniHost"
                            loading="eager">
                    </a>
                </div>
                <div class="col-md-9 align-self-center">
                    <h1 class="text-secondary text-center {{ Browser::isMobile() ? 'fs-3' : null }}">
                        &nbsp; Manager - {{ session('UserSession.app_info.name') }} &nbsp;
                    </h1>
                    <div class="text-center">
                        <span class="d-none d-md-block">
                            {{ __('site.auth.header.need_help') }} :
                            <br>
                        </span>
                        <a href="https://api.whatsapp.com/send?text=&phone={{ session('UserSession.app_info.contact_phone.whatsapp') }}"
                            class="fw-bold text-success text-decoration-none" target="blank">
                            <i class="mdi mdi-whatsapp text-success"></i>
                            {{ session('UserSession.app_info.contact_phone.whatsapp') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-1 align-self-center text-center">

                    <span class="d-none d-lg-block"> {{ __('site.auth.header.language') }}<br> </span>

                    @if (App::getLocale() == 'en')
                    <a href="{{ route('PreferenceGetLanguage',['local' => 'fr']) }}" class="my-1 text-decoration-none"
                        title="Français">
                        <img src="{{ cdn_asset('/dist/all/img/flag/fr.png') }}" class="rounded h-18px w-25px"
                            alt="langue" title="Flag Fr" loading="eager" width="25px" height="18px">
                    </a>
                    @else
                    <a href="{{ route('PreferenceGetLanguage',['local' => 'en']) }}" class="my-1 text-decoration-none"
                        title="English">
                        <img src="{{ cdn_asset('/dist/all/img/flag/gb.png') }}" class="rounded h-18px w-25px"
                            alt="langue" title="Flag En" loading="eager" width="25px" height="18px">
                    </a>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
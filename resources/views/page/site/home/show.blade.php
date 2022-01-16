@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">

    <div class="col-md-4">

        @include('layout.site.component.profil-cover')

        <div class="card shadow">
            <div class="card-body p-0">
                <nav>
                    <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="true">{{ __('site.label.profile') }}</button>
                        <button class="nav-link" id="nav-security-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-security" type="button" role="tab" aria-controls="nav-security"
                            aria-selected="false">{{ __('site.label.security') }}</button>
                        <button class="nav-link" id="nav-session-tab" data-bs-toggle="tab" data-bs-target="#nav-session"
                            type="button" role="tab" aria-controls="nav-session" aria-selected="false">{{
                            __('site.label.session') }}</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade p-3 show active" id="nav-profile" role="tabpanel"
                        aria-labelledby="nav-home-tab">

                        <a href="#" class="fs-6 d-block text-center text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#sponsorCodeModal" title="Partager mon lien de parrainage">
                            <span class="text-dark">
                                <i class="mdi mdi-account-group"></i>
                                <u>Code {{ __('site.label.sponsorship') }}</u> :
                            </span>
                            <b>{{ session('UserSession.profil.code_sponsor') }}</b>
                        </a>

                        <hr>

                        <form action="{{ route('Site-ProfilePostUpdate') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input name="photo" type="file" accept="image/*" class="form-control rounded-pill mb-2">

                            <input name="first_name" type="text" class="form-control rounded-pill mb-2"
                                value="{{ session('UserSession.profil.first_name') }}"
                                placeholder="{{ __('site.input.placeholder.first_name') }}" required>

                            <input name="last_name" type="text" class="form-control rounded-pill mb-2"
                                value="{{ session('UserSession.profil.last_name') }}"
                                placeholder="{{ __('site.input.placeholder.last_name') }}" required>

                            <div class="input-group mb-2">
                                <span class="input-group-text" id="basic-addon1"
                                    style="border-radius: 50rem 0rem 0rem 50rem !important;">
                                    <img src="{{ session('UserSession.profil.country.flag') }}" style="width: 30px">
                                </span>
                                <input type="text" class="form-control" aria-describedby="basic-addon1"
                                    value="{{ session('UserSession.profil.country.name.' . app()->getLocale()) }}"
                                    required readonly disabled style="border-radius: 0rem 50rem 50rem 0rem !important;">
                            </div>

                            <input name="city" type="text" class="form-control rounded-pill mb-2"
                                value="{{ session('UserSession.profil.city') }}"
                                placeholder="{{ __('site.input.placeholder.city') }}" required>

                            <input name="phone" type="text" class="form-control rounded-pill mb-2"
                                value="{{ session('UserSession.profil.phone') }}"
                                placeholder="{{ __('site.input.placeholder.phone') }}" required>

                            <div class="text-center">

                                <a href="#" class="d-block mx-auto" data-bs-toggle="modal"
                                    data-bs-target="#profilPlusModal">
                                    {{ __('site.label.more_info') }}
                                </a>

                            </div>

                            <button type="submit" class="btn btn-info d-block mx-auto rounded-pill mt-3">
                                <i class="mdi mdi-account-edit"></i>
                                {{ __('site.label.update') }}
                            </button>

                        </form>
                    </div>
                    <div class="tab-pane fade p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                        <form action="{{ route('Site-ProfilePostPassword') }}" method="POST">
                            @csrf
                            <input name="old_password" type="password" class="form-control rounded-pill mb-2"
                                placeholder="{{ __('site.input.placeholder.password_current') }}" autocomplete="false"
                                required>

                            <input name="password" type="password" class="form-control rounded-pill mb-2"
                                placeholder="{{ __('site.input.placeholder.password_new') }}" autocomplete="false"
                                required>

                            <button type="submit" class="btn btn-info d-block mx-auto rounded-pill mt-4">
                                <i class="mdi mdi-lock-open"></i>
                                {{ __('site.label.update') }}
                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade p-3" id="nav-session" role="tabpanel" aria-labelledby="nav-session-tab">
                        <button class="btn btn-danger d-block mx-auto rounded-pill my-4" data-bs-toggle="modal"
                            data-bs-target="#sessionModal">
                            <i class="mdi mdi-history"></i>
                            {{ __('site.wording.show_session_history') }}
                            ({{ count($session_list) }})
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow  mt-3 mb-3">
            <div class="card-header text-center"></div>
            <div class="card-body px-0" style="text-align: center; overflow: scroll">
                <iframe
                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FWiniHost&tabs=timeline&height=306&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=518564245522169"
                    height="306" style="border:none; overflow:hidden" scrolling="yes" frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
        </div>

    </div>

    <div class="col-md-8">

        <div class="card shadow mb-3">
            <div class="card-header bg-secondary text-center py-3">
                <span class="fs-4 fw-bold text-white">
                    {{ __('site.wording.at_your_service') }}
                </span>

                <a href="{{ route('Site-TicketGetShow') }}"
                    class="btn btn-outline-light rounded-pill float-end d-none d-md-block">
                    {{ __('site.label.help') }} ?
                </a>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="card shadow mb-3">
                            <a href="{{ route('Site-HostingGetShow') }}" class="text-decoration-none text-dark">
                                <div class="card-body text-center">
                                    <span class="fw-bold fs-2 d-block">
                                        {{ count($hosting_list) ?? '-' }}
                                    </span>
                                    <span class="fw-bold d-block text-truncate">
                                        {{ __('site.label.hosting') }}(s)
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="card shadow mb-3">
                            <a href="{{ route('Site-DomainGetShow') }}" class="text-decoration-none text-dark">
                                <div class="card-body text-center">
                                    <span class="fw-bold fs-2 d-block">
                                        {{ count($domain_list) ?? '-' }}
                                    </span>
                                    <span class="fw-bold d-block text-truncate">
                                        {{ __('site.label.domain') }}(s)
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="card shadow mb-3">
                            <a href="{{ route('Site-TicketGetShow') }}" class="text-decoration-none text-dark">
                                <div class="card-body text-center">
                                    <span class="fw-bold fs-2 d-block">
                                        {{ session('UserSession.profil.ticket_open') }}
                                    </span>
                                    <span class="fw-bold d-block text-truncate">
                                        {{ __('site.label.ticket') }}(s) {{ __('site.label.open') }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="card shadow mb-3">
                            <a href="{{ route('Site-OrderGetShow') }}" class="text-decoration-none text-dark">
                                <div class="card-body text-center">
                                    <span class="fw-bold fs-2 d-block">
                                        {{ count($order_list) ?? '-' }}
                                    </span>
                                    <span class="fw-bold d-block text-truncate">
                                        {{ __('site.label.order') }}(s)
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="card border-danger mb-3">
                            <div class="card-body text-center">
                                <span class="d-block">
                                    {{ __('site.wording.service_expire_30_days') }}
                                </span>

                                <span class="fs-1 fw-bold d-block text-danger my-3">
                                    {{ $domain_expired + $hosting_expired }}
                                </span>

                                <div class="row">
                                    <div class="col-6">
                                        <span class="d-block fw-bold">
                                            {{ __('site.label.domain') }}(s)
                                        </span>
                                        <span class="d-block">
                                            {{ $domain_expired }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-block fw-bold text-truncate">
                                            {{ __('site.label.hosting') }}(s)
                                        </span>
                                        <span class="d-block">
                                            {{ $hosting_expired }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer p-0">
                                <a href="{{ route('Site-CartGetRenewAll', ['services' => 'domain,hosting']) }}"
                                    class="btn btn-outline-danger w-100">
                                    {{ __('site.wording.renew_your_services') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-success mb-3">
                            <div class="card-body text-center">
                                <span class="d-block">
                                    {!! __('site.wording.point_available') !!}
                                </span>

                                <span class="fs-1 fw-bold d-block text-success my-3">
                                    {{ session('UserSession.profil.point') }}
                                </span>

                                <div class="row">
                                    <div class="col-6">
                                        <span class="d-block fw-bold">
                                            {{ __('site.label.amount') }}
                                        </span>
                                        <span class="d-block">
                                            {{ Helpy::formatPrice($point_detail['amount']) }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-block fw-bold text-truncate">
                                            {{ __('site.label.exchange_rate') }}
                                        </span>
                                        <span class="d-block">
                                            {{ Helpy::formatNumber($point_detail['rate'], app()->getLocale()) }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer p-0">
                                <a href="{{ route('Site-ServiceGetDetail', ['service' => 'point']) }}"
                                    class="btn btn-outline-success w-100">
                                    {{ __('site.label.buy_credit') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-primary mb-3">
                            <div class="card-body text-center">
                                <span class="d-block">
                                    {{ __('site.wording.number_ticket_total') }}
                                </span>

                                <span class="fs-1 fw-bold d-block text-primary my-3">
                                    {{ count($ticket_list) }}
                                </span>

                                <div class="row">
                                    <div class="col-6">
                                        <span class="d-block fw-bold">
                                            {{ __('site.label.ticket') }}(s) {{ __('site.label.open') }}
                                        </span>
                                        <span class="d-block">
                                            {{ session('UserSession.profil.ticket_open') }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-block fw-bold">
                                            {{ __('site.label.ticket') }}(s) {{ __('site.label.closed') }}(s)
                                        </span>
                                        <span class="d-block">
                                            {{ count($ticket_list) - session('UserSession.profil.ticket_open') }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer p-0">
                                <a href="{{ route('Site-TicketGetShow') }}" class="btn btn-outline-primary w-100">
                                    {{ __('site.label.show_ticket') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-dark mb-3">
                            <div class="card-body text-center">
                                <span class="d-block">
                                    {{ __('site.wording.monitoring_site_domain') }}
                                </span>

                                <span class="fs-1 fw-bold d-block text-dark my-3">
                                    {{ count($monitoring_list) }}
                                </span>

                                <div class="row">
                                    <div class="col-6">
                                        <span class="d-block fw-bold">
                                            {{ __('site.label.normal') }}
                                        </span>
                                        <span class="d-block">
                                            {{ collect($monitoring_list)->where('status', '=', '200')->count() }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-block fw-bold">
                                            {{ __('site.label.error') }}
                                        </span>
                                        <span class="d-block">
                                            {{ collect($monitoring_list)->where('status', '!=', '200')->count() }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer p-0">
                                <a href="#" class="btn btn-outline-dark w-100">
                                    {{ __('site.label.show_monitoring') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-secondary">
                <b class="text-white">{{ __('site.label.domain') }} {{ __('site.label.watcher') }}</b>
                <a href="{{ route('Site-WatcherGetShow') }}"
                    class="btn btn-sm btn-outline-light rounded-pill float-end d-none d-md-block">
                    {{ __('site.label.show') }}
                </a>
            </div>
            <div class="card-body">

                @forelse (collect($watcher_list)->sortByDesc('updated')->take(3) as $value)
                <div class="row">
                    <div class="col-md-4 py-1 {{ Browser::isMobile() ? 'text-center' : null }}">
                        <b class="text-primary">
                            {{ $value['domain'] }}
                        </b>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 py-1 text-center">
                        <span class="text-{{ $value['status'] == true ? 'success' : 'danger' }}">
                            {{ $value['status'] == true ? __('site.label.available') : __('site.label.unavailable') }}
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 py-1 text-center">
                        {{ Helpy::localDatetime($value['updated'], app()->getLocale()) }}
                    </div>
                    <div class="col-md-2 py-1">
                        @if ($value['status'] == true)
                        <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $value['subscribe']['service']['uuid'], 'package' => $value['subscribe']['package']['uuid'], 'detail' => $value['domain']]) }}"
                            class="btn btn-warning btn-sm w-100 text-dark">
                            <i class="mdi mdi-cart-arrow-down"></i> {{ __('site.label.cart') }}
                        </a>
                        @else
                        <button class="btn btn-light btn-sm w-100 text-dark disabled">
                            <i class="mdi mdi-cart-arrow-down"></i> {{ __('site.label.cart') }}
                        </button>
                        @endif
                    </div>
                </div>
                <hr class="{{ $loop->last ? 'd-none' : null }}">
                @empty
                <div class="text-danger text-center">
                    {{ __('site.wording.no_data_available') }}
                </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

<!-- Modal Profil Plus -->
<div class="modal fade" id="profilPlusModal" tabindex="-1" aria-labelledby="profilPlusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="profilPlusModalLabel">
                    {{ __('site.label.profile') }} : {{ __('site.label.more_info') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Site-ProfilePostUpdate') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4 pb-3">
                            <strong class="text-secondary">
                                {{ __('site.label.gender') }}
                            </strong>
                        </div>
                        <div class="col-8 pb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="homme" value="m" {{
                                    in_array(session('UserSession.profil.gender'), ['m', null]) ? 'checked' : null }}>
                                <label class="form-check-label" for="homme">
                                    {{ __('site.label.man') }}
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="femme" value="f" {{
                                    session('UserSession.profil.gender')=='f' ? 'checked' : null }}>
                                <label class="form-check-label" for="femme">
                                    {{ __('site.label.woman') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-4 pt-2">
                            <strong class="text-secondary">
                                {{ __('site.label.birth_date') }}
                            </strong>
                        </div>
                        <div class="col-8">
                            <input type="date" name="birth_date" class="form-control"
                                value="{{ session('UserSession.profil.birth_date') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="mdi mdi-close"></i>
                            {{ __('site.label.close') }}
                        </button>
                        <button type="submit" class="btn btn-info btn-sm">
                            <i class="mdi mdi-account-edit"></i>
                            {{ __('site.label.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal session -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">
                    {{ __('site.label.my_sessions') }} ({{ count($session_list) }})
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach ($session_list as $session)
                <div class="card mb-2 shadow border border-secondary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                IP : <b>{{ $session['ip'] }}</b>
                                @if ($session['country'])
                                <br>
                                <img src="{{ cdn_asset('/dist/all/img/flag/'. strtolower($session['country_code']) .'.png') }}"
                                    class="rounded h-18px w-27px" alt="langue">
                                {{ $session['country'] }} <br>
                                ( {{ $session['city'] }} )
                                @endif
                            </div>
                            <div class="col-md-2 text-center">
                                <i class="mdi mdi-responsive text-secondary"></i>
                                {{ ucfirst($session['device_type']) }} <br>
                                {{ $session['device_model'] }}
                            </div>
                            <div class="col-md-2 text-center">
                                <i class="mdi mdi-window-restore text-secondary"></i>
                                {{ $session['platforme'] }}
                            </div>
                            <div class="col-md-2 text-center">
                                <i class="mdi mdi-lock-pattern text-secondary"></i>
                                {{ $session['browser'] }}
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="text-secondary">
                                    <i class="mdi mdi-clock-check-outline"></i>
                                    {{ $session['created'] }}
                                </div>
                                <div class="text-success fw-bold">
                                    <i class="mdi mdi-clock-alert-outline"></i>
                                    {{ $session['expired'] }}
                                </div>
                            </div>
                            <div class="col-md-1">
                                @if (!$session['my_session'])
                                <form action="{{ route('Site-SessionPostDelete', ['uuid' => $session['uuid']]) }}"
                                    method="POST" id="{{ $session['uuid'] }}">
                                    @csrf
                                </form>
                                <button class="btn btn-outline-danger btn-sm w-100 BtnDeleteSession"
                                    data-uuid="{{ $session['uuid'] }}">
                                    <i class="mdi mdi-delete"></i>
                                    Supp.
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('.BtnDeleteSession').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this));
    });
</script>
@endsection
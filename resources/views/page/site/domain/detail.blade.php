@extends('layout.site.master')

@section('style')

@endsection

@section('content')

@include('layout.site.component.domain-detail-header')

<div class="row">

    <div class="col-md-4">

        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.label.screenshot') }}
                </h5>
                <i class="float-end small" style="font-size: 10px;">
                    {{ __('site.label.since') }} 15 min
                </i>
            </div>
            <div class="card-body">
                <img class="img-fluid img-thumbnail mx-auto d-block mb-2" src="{{ $domain_detail['screenshot'] }}"
                    style="height: 150px">
            </div>
        </div>

        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.label.my_domain') }}
                </h5>
            </div>

            <div class="card-body">
                {{ __('site.label.status') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $domain_detail['status'] ?? '---' }}
                    <i class="mdi mdi-cloud-check float-end mdi-24px {{ $domain_detail['status'] == 'active' ? 'text-success' : 'text-danger'  }}"
                        title="{{ $domain_detail['status'] }}" style="position: absolute;right: 13px; top: 3px;"></i>
                </li>
                <br>
                {{ __('site.label.created') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $domain_detail['created'] ? Helpy::localDatetime($domain_detail['created'], app()->getLocale()) : '---' }}
                </li>
                <br>
                {{ __('site.label.expired') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    @if ($domain_detail['expired'])
                    {{ Helpy::localDatetime($domain_detail['expired'], app()->getLocale()) }}
                    @if ($domain_detail['registrar_self'])
                    <a href="{{ route('Site-DomainGetRenew', ['uuid' => $domain_detail['uuid']]) }}"
                        class="btn btn-sm btn-warning border border-white rounded-pill float-end text-dark"
                        style="position: absolute;right: 13px; top: 5px;">
                        <i class="mdi mdi-history"></i>
                        <span class="d-none d-md-inline">{{ __('site.label.renew') }}</span>
                    </a>
                    @endif
                    @else
                    ---
                    @endif
                </li>
                <br>
                {{ __('site.label.hosting') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded">
                    <strong>
                        {{ $domain_detail['hosting']['name'] ?  $domain_detail['hosting']['name'] : '---' }}
                    </strong>
                    @if (!(session('UserSession.domain.hosting') > now()))
                    <i class="mdi mdi-server-network float-end mdi-24px" title="{{ __('site.label.change_hosting') }}"
                        style="position: absolute;right: 13px; top: 3px; cursor: pointer" data-bs-toggle="modal"
                        data-bs-target="#hostingModal"></i>
                    <div class="modal fade" id="hostingModal" tabindex="-1" aria-labelledby="hostingModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hostingModalLabel">
                                        <i class="mdi mdi-server-network"></i>
                                        {{ __('site.label.change_hosting') }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form
                                        action="{{ route('Site-DomainPostHosting', ['uuid' => $domain_detail['uuid']]) }}"
                                        method="POST" class="row">

                                        @csrf

                                        <div class="form-group col-md-12">
                                            <label class="fw-bold" for="hosting">{{ __('site.label.hosting') }}</label>
                                            <select name="hosting" id="selectHosting" class="form-control mb-3"
                                                required>
                                                <option value="x">-- {{ __('site.label.hosting') }} ---</option>
                                                @foreach ($hosting_list as $hosting)
                                                <option
                                                    {{ $hosting['uuid'] == $domain_detail['hosting']['uuid'] ? 'selected' : null }}
                                                    value="{{ $hosting['uuid'] }}">
                                                    {{ $hosting['name'] }} &nbsp;&nbsp;
                                                    {{ !Browser::isMobile() ? '[' . $hosting['server']['name'] . ']' : null }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4 fw-bold">
                                            DNS reset
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input name="reset" class="form-check-input" type="radio"
                                                    name="resetDNS" value="true" id="resetDnsTrue">
                                                <label class="form-check-label" for="resetDnsTrue">
                                                    Oui
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input name="reset" class="form-check-input" type="radio"
                                                    name="resetDnsFalse" value="false" id="resetDnsFalse" checked>
                                                <label class="form-check-label" for="resetDnsFalse">
                                                    Non
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <div class="alert alert-danger small mb-0 my-2 d-none" id="resetDnsAlert">
                                                <i class="mdi mdi-alert-circle"></i>
                                                Si vous acceptez la reinitialisation des entreés DNS, toutes les entrées
                                                seront supprimé et remplacer par les entrées par defaut pointant vers le
                                                nouveau serveur
                                            </div>
                                        </div>

                                        <hr class="mt-3">

                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                                                <i class="mdi mdi-chevron-left"></i>
                                                {{ __('site.label.cancel') }}
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="mdi mdi-check"></i>
                                                {{ __('site.label.validate') }}
                                            </button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                </li>
            </div>
        </div>

        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.label.serveur_dns') }}
                </h5>
                <a href="https://dnschecker.winihost.com/?domain={{ $domain_detail['domain'] }}&record=ns"
                    class="btn btn-sm btn-light rounded-pill float-end text-dark"
                    style="position: absolute;right: 13px; top: 5px;" target="blank"
                    title="Check {{ __('site.label.dns_propagation') }}">
                    <i class="mdi mdi-magnify"></i>
                </a>
            </div>
            <div class="card-body">
                @foreach ($domain_detail['nameserver'] as $key => $dns)
                {{ __('site.label.serveur_dns') }} {{ strtoupper($key) }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold mb-2">
                    {{ $dns }}
                </li>
                @endforeach
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-2">
                <a href="#" class="badge bg-success rounded-pill p-2 text-white" data-bs-toggle="modal"
                    data-bs-target="#DnsSslModal" title="{{ __('site.label.ssl_connection') }}">
                    <i class="mdi mdi-server-security mdi-18px"></i>
                </a>
                <div class="modal fade" id="DnsSslModal" tabindex="-1" aria-labelledby="DnsSslModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DnsSslModalLabel">
                                    <i class="mdi mdi-server-security text-success"></i>
                                    {{ __('site.label.ssl_connection') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form action="{{ route('Site-Domain-DnsPostSsl', ['uuid' => $domain_detail['uuid']]) }}"
                                    method="POST">
                                    @csrf

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="off" value="off"
                                            {{ $domain_detail['dns_ssl'] == 'off' ? 'checked' : null }}>
                                        <label class="form-check-label" for="off">Off</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="flexible"
                                            value="flexible"
                                            {{ $domain_detail['dns_ssl'] == 'flexible' ? 'checked' : null }}>
                                        <label class="form-check-label" for="flexible">Flexible</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="full" value="full"
                                            {{ $domain_detail['dns_ssl'] == 'full' ? 'checked' : null }}>
                                        <label class="form-check-label" for="full">Full</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="strict"
                                            value="strict"
                                            {{ $domain_detail['dns_ssl'] == 'strict' ? 'checked' : null }}>
                                        <label class="form-check-label" for="strict">Strict</label>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="mdi mdi-close"></i>
                                            {{ __('site.label.cancel') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="mdi mdi-check"></i>
                                            {{ __('site.label.validate') }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2">
                <a href="#" class="badge bg-warning rounded-pill p-2 text-white" data-bs-toggle="modal"
                    data-bs-target="#DnsHttpsModal" title="{{ __('site.label.https_redirect') }}">
                    <i class="mdi mdi-axis-z-arrow-lock mdi-18px text-dark"></i>
                </a>
                <div class="modal fade" id="DnsHttpsModal" tabindex="-1" aria-labelledby="DnsHttpsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DnsHttpsModalLabel">
                                    <i class="mdi mdi-axis-z-arrow-lock text-warning"></i>
                                    {{ __('site.label.https_redirect') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form
                                    action="{{ route('Site-Domain-DnsPostHttps', ['uuid' => $domain_detail['uuid']]) }}"
                                    method="POST">
                                    @csrf

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="off" value="off"
                                            {{ $domain_detail['dns_https'] == 'off' ? 'checked' : null }}>
                                        <label class="form-check-label" for="off">Off</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="on" value="on"
                                            {{ $domain_detail['dns_https'] == 'on' ? 'checked' : null }}>
                                        <label class="form-check-label" for="on">On</label>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="mdi mdi-close"></i>
                                            {{ __('site.label.cancel') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="mdi mdi-check"></i>
                                            {{ __('site.label.validate') }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2">
                <a href="#" class="badge bg-primary rounded-pill p-2 text-white" data-bs-toggle="modal"
                    data-bs-target="#DnsCacheModal"
                    title="{{ __('site.label.empty_cache') }} : 
                    {{ $domain_detail['dns_cache'] ? Helpy::localDatetime($domain_detail['dns_cache'], app()->getLocale()) : '---' }}">
                    <i class="mdi mdi-broom mdi-18px"></i>
                </a>
                <div class="modal fade" id="DnsCacheModal" tabindex="-1" aria-labelledby="DnsCacheModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DnsCacheModalLabel">
                                    <i class="mdi mdi-broom text-primary"></i>
                                    {{ __('site.label.empty_cache') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form
                                    action="{{ route('Site-Domain-DnsPostCache', ['uuid' => $domain_detail['uuid']]) }}"
                                    method="POST">
                                    @csrf

                                    <small class="text-muted d-block">
                                        Vider il ya :
                                        {{ $domain_detail['dns_cache'] ? Helpy::localDatetime($domain_detail['dns_cache'], app()->getLocale()) : '---' }}
                                    </small>

                                    <span class="fs-5">
                                        Voulez vous vider le cache ?
                                    </span>

                                    <hr>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="mdi mdi-close"></i>
                                            {{ __('site.label.cancel') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="mdi mdi-check"></i>
                                            {{ __('site.label.validate') }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2">
                <a href="#" class="badge bg-secondary rounded-pill p-2 text-white" data-bs-toggle="modal"
                    data-bs-target="#DnsDevmodeModal" title="{{ __('site.label.dev_mode') }}">
                    <i class="mdi mdi-developer-board mdi-18px"></i>
                </a>
                <div class="modal fade" id="DnsDevmodeModal" tabindex="-1" aria-labelledby="DnsDevmodeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DnsDevmodeModalLabel">
                                    <i class="mdi mdi-developer-board text-secondary"></i>
                                    {{ __('site.label.dev_mode') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form
                                    action="{{ route('Site-Domain-DnsPostDevmode', ['uuid' => $domain_detail['uuid']]) }}"
                                    method="POST">
                                    @csrf

                                    <small class="text-muted d-block mb-3">
                                        En mode Dev, les le cache est désactivé
                                    </small>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="off" value="off"
                                            {{ $domain_detail['dns_devmode'] == 'off' ? 'checked' : null }}>
                                        <label class="form-check-label" for="off">Off</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="value" id="on" value="on"
                                            {{ $domain_detail['dns_devmode'] == 'on' ? 'checked' : null }}>
                                        <label class="form-check-label" for="on">On</label>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="mdi mdi-close"></i>
                                            {{ __('site.label.cancel') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="mdi mdi-check"></i>
                                            {{ __('site.label.validate') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2">
                <a href="#" class="badge bg-dark rounded-pill p-2 text-white" data-bs-toggle="modal"
                    data-bs-target="#DnsMinifyModal" title="{{ __('site.label.file_minify') }}">
                    <i class="mdi mdi-folder-zip-outline mdi-18px"></i>
                </a>
                <div class="modal fade" id="DnsMinifyModal" tabindex="-1" aria-labelledby="DnsMinifyModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DnsMinifyModalLabel">
                                    <i class="mdi mdi-folder-zip-outline text-dark"></i>
                                    {{ __('site.label.file_minify') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form
                                    action="{{ route('Site-Domain-DnsPostMinify', ['uuid' => $domain_detail['uuid']]) }}"
                                    method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            <strong>CSS</strong> :
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="css" id="off"
                                                    value="off"
                                                    {{ $domain_detail['dns_minify']['css'] == 'off' ? 'checked' : null }}>
                                                <label class="form-check-label" for="off">Off</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="css" id="on"
                                                    value="on"
                                                    {{ $domain_detail['dns_minify']['css'] == 'on' ? 'checked' : null }}>
                                                <label class="form-check-label" for="on">On</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            <strong>HTML</strong> :
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="html" id="off"
                                                    value="off"
                                                    {{ $domain_detail['dns_minify']['html'] == 'off' ? 'checked' : null }}>
                                                <label class="form-check-label" for="off">Off</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="html" id="on"
                                                    value="on"
                                                    {{ $domain_detail['dns_minify']['html'] == 'on' ? 'checked' : null }}>
                                                <label class="form-check-label" for="on">On</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            <strong>JS</strong> :
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="js" id="off"
                                                    value="off"
                                                    {{ $domain_detail['dns_minify']['js'] == 'off' ? 'checked' : null }}>
                                                <label class="form-check-label" for="off">Off</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="js" id="on"
                                                    value="on"
                                                    {{ $domain_detail['dns_minify']['js'] == 'on' ? 'checked' : null }}>
                                                <label class="form-check-label" for="on">On</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="mdi mdi-close"></i>
                                            {{ __('site.label.cancel') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="mdi mdi-check"></i>
                                            {{ __('site.label.validate') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2">
                <form id="{{ $domain_detail['uuid'] }}"
                    action="{{ route('Site-DomainPostDelete', ['uuid' => $domain_detail['uuid']]) }}" method="POST">
                    @csrf
                    <a href="#" class="badge bg-danger rounded-pill p-2 text-white BtnDeleteItem"
                        data-uuid="{{ $domain_detail['uuid'] }}"
                        data-text="{{ __('site.wording.do_you_want_to_delete_domain') }}"
                        title="{{ __('site.label.delete') }}">
                        <i class="mdi mdi-delete mdi-18px"></i>
                    </a>
                </form>
            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.label.dns_entries') }}
                </h5>
                <a href="{{ route('Site-Domain-RecordGetCreate', ['uuid' => $domain_detail['uuid']]) }}"
                    class="mdi mdi-plus-box mdi-24px text-white" title="{{ __('site.label.add') }}"
                    style="position: absolute;right: 7px;top: 4px;">
                </a>
            </div>
            <div class="card-body">

                <div class=" d-none d-md-block">
                    <div class="row">
                        <div class="col-md-1 text-center fw-bold text-primary">
                            {{ __('site.label.ssl') }}
                        </div>
                        <div class="col-md-3 fw-bold text-primary">
                            {{ __('site.label.name') }}
                        </div>
                        <div class="col-md-2 fw-bold text-truncate text-primary">
                            {{ __('site.label.type') }}
                        </div>
                        <div class="col-md-3 fw-bold text-primary">
                            {{ __('site.label.content') }}
                        </div>
                        <div class="col-md-2 fw-bold text-center text-primary">
                            {{ __('site.label.priority') }}
                        </div>
                        <div class="col-md-1 fw-bold text-primary">

                        </div>
                    </div>
                    <hr class="border border-dark border-2 border-end-0 border-bottom-0 border-start-0">
                </div>

                @forelse ($domain_record as $record)

                <div class="row">
                    <div class="col-md-1 {{ Browser::isMobile() ? 'text-star' : 'text-center' }}">
                        @if ($record['proxiable'])
                        <small class="text-muted d-dm-inline d-md-none">{{ __('site.label.ssl') }} :</small>
                        <span class="mdi mdi-lock mdi-24px {{ $record['proxied'] ? 'text-success' : 'text-warning' }}"
                            title="{{ __('site.label.ssl') }}"></span>
                        @endif
                    </div>
                    <div class="col-md-3 text-truncate">
                        <small class="text-muted d-dm-inline d-md-none">{{ __('site.label.name') }} :</small>
                        <span class="{{ Browser::isMobile() ? 'fw-bold' : null }}">{{ $record['name'] }}</span>
                    </div>
                    <div class="col-md-2 text-truncate">
                        <small class="text-muted d-dm-inline d-md-none">{{ __('site.label.type') }} :</small>
                        <strong>{{ $record['type'] }}</strong>
                    </div>
                    <div class="col-md-3 text-truncate">
                        <small class="text-muted d-dm-inline d-md-none">{{ __('site.label.content') }} :</small>
                        <span class="{{ Browser::isMobile() ? 'fw-bold' : null }}">{{ $record['content'] }}</span>
                    </div>
                    <div class="col-8 col-sm-8 col-md-2 {{ Browser::isMobile() ? 'text-star' : 'text-center' }}">
                        @if ($record['priority'])
                        <small class="text-muted d-dm-inline d-md-none">{{ __('site.label.priority') }} :</small>
                        <strong>{{ $record['priority'] }}</strong>
                        @endif
                    </div>
                    <div class="col-md-1 text-center">

                        <a href="{{ route('Site-Domain-RecordGetEdite', ['uuid' => $domain_detail['uuid'], 'item' => $record['uuid']]) }}"
                            class="mdi mdi-square-edit-outline mdi-18px {{ Browser::isMobile() ? 'me-3' : null }}"
                            title="{{ __('site.label.edit') }}"></a>

                        <form id="{{ $record['uuid'] }}"
                            action="{{ route('Site-Domain-RecordPostDelete', ['uuid' => $domain_detail['uuid'], 'item' => $record['uuid']]) }}"
                            method="POST" class="d-inline">
                            @csrf
                            <a href="#" class="mdi mdi-delete text-danger mdi-18px BtnDeleteItem"
                                data-uuid="{{ $record['uuid'] }}"
                                data-text="{{ __('site.wording.do_you_want_to_delete_record') }}"
                                title="{{ __('site.label.delete') }}">
                            </a>
                        </form>

                    </div>
                </div>

                {!! !$loop->last ? '
                <hr>' : null !!}

                @empty

                <button type="button" class="list-group-item list-group-item-action">
                    <div class="text-danger text-center">
                        {{ __('site.wording.no_data_available') }}
                    </div>
                </button>

                @endforelse

            </div>
        </div>

    </div>

</div>


@endsection

@section('scripts')

<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('.BtnDeleteItem').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this), $(this).data('text'));
    });

    var resetDnsTrue = document.getElementById('resetDnsTrue');
    if (resetDnsTrue) {
        resetDnsTrue.addEventListener('change', (e) => {
            document.getElementById('resetDnsAlert').classList.remove('d-none')
        });
    }
    
    var resetDnsFalse = document.getElementById('resetDnsFalse');
    if (resetDnsFalse) {
        resetDnsFalse.addEventListener('change', (e) => {
            document.getElementById('resetDnsAlert').classList.add('d-none')
        });
    }
    
</script>

@endsection
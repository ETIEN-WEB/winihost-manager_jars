@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <h2 class="mb-3">
            <i class="mdi mdi-server-network"></i>
            {{ $hosting_detail['name'] }}
        </h2>
    </div>
    <div class="col-4 text-end">
        <a href="{{ route('Site-HostingGetShow') }}" class="badge bg-danger text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
        </a>
    </div>
</div>

<div class="row">

    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary">
                <h5 class="card-title text-white my-2">
                    {{ __('site.label.my_hosting') }}
                </h5>
            </div>
            <div class="card-body">
                {{ __('site.label.server') }} ({{ $hosting_detail['server']['name'] }})
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['server']['ip'] }}
                </li>
                <br>
                {{ __('site.label.package') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['service']['name'][app()->getLocale()] }} :
                    {{ $hosting_detail['package']['name'] ?? '-' }}
                    @if ($hosting_detail['package']['name'])
                    <a href="#"
                        class="btn btn-sm btn-warning border border-white rounded-pill float-end text-dark {{ Browser::isMobile() ? 'btn-sm' : null }}"
                        style="position: absolute;right: 13px; top: 5px;">
                        <i class="mdi mdi-diamond-stone"></i>
                        <span class="d-none d-md-inline">{{ __('site.label.migrated') }}</span>
                    </a>
                    @endif
                </li>
                <br>
                {{ __('site.label.created') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{  Helpy::localDatetime($hosting_detail['created'], app()->getLocale()) }}
                </li>
                <br>
                {{ __('site.label.expired') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['expired'] == null ? __('site.label.unlimited') : Helpy::localDatetime($hosting_detail['expired'], app()->getLocale()) }}
                    @if ($hosting_detail['expired'])
                    <a href="{{ route('Site-HostingGetRenew', ['uuid' => $hosting_detail['uuid']]) }}"
                        class="btn btn-sm btn-warning border border-white rounded-pill float-end text-dark {{ Browser::isMobile() ? 'btn-sm' : null }}"
                        style="position: absolute;right: 13px; top: 5px;">
                        <i class="mdi mdi-history"></i>
                        <span class="d-none d-md-inline">{{ __('site.label.renew') }}</span>
                    </a>
                    @endif
                </li>
                <br>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary">
                <h5 class="card-title text-white my-2">
                    {{ __('site.label.useful_information') }}
                </h5>
            </div>
            <div class="card-body">
                Hôte FTP (Port 21)
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['server']['name'] }}
                </li>
                <br>
                Hôte Database (Port 3306)
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['server']['name'] }}
                </li>
                <br>
                Hôte SMTP (Port 587)
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['server']['name'] }}
                </li>
                <br>
                Hôte POP3 (Port 110)
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $hosting_detail['server']['name'] }}
                </li>
                <br>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary">
                <h5 class="card-title text-white my-2">
                    {{ __('site.label.access_panel') }}
                </h5>
            </div>
            <div class="card-body">
                {{ __('site.label.link') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded text-truncate fw-bold">
                    <a href="{{ $hosting_detail['server']['panel_url'] }}" class="text-secondary" target="blank">
                        {{ $hosting_detail['server']['panel_url'] }}
                    </a>
                    <a href="{{ $hosting_detail['server']['panel_url'] }}" target="_blank"
                        class="btn btn-primary btn-sm rounded float-right mdi-24px"
                        style="position: absolute; right: 13px; top: 5px;">
                        <i class="mdi mdi-open-in-new"></i>
                    </a>
                </li>
                <br>
                {{ __('site.label.username') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    <strong class="text-primary">{{ $hosting_detail['name'] }}</strong>
                </li>
                <br>
                {{ __('site.label.status') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    <span class="{{ $hosting_detail['status'] == true ? 'text-success' : 'text-danger' }}">
                        {{ $hosting_detail['status'] == true ? __('site.label.active') : __('site.label.inactive') }}
                    </span>
                </li>
                <br>
                {{ __('site.label.app_port') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    <strong class="">{{ $hosting_detail['app_port'] ?? '----' }}</strong>
                </li>
                <br>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

@endsection
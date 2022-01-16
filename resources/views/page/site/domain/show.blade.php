@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-7">
        <a href="{{ route('Site-ServiceGetDetail', ['service' => 'domain']) }}"
            class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.buy') }}
        </a>
        |
        <a href="{{ route('Site-DomainGetCreate') }}" class="badge bg-secondary text-decoration-none text-white">
            <i class="mdi mdi-plus"></i>
            {{ __('site.label.add') }}
        </a>
    </div>
    <div class="col-5 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($domain_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.domain') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-3">
                {{ __('site.label.name') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.expired') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.created') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.hosting') }}
            </div>
            <div class="col-md-1 text-center">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>
    @forelse (collect($domain_list)->sortByDesc('created') as $domain)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-3 text-truncate">
                <a href="https://{{ $domain['domain'] }}" class="text-primary fw-bold text-decoration-none"
                    target="blank">
                    {{ $domain['domain'] }}
                    <i class="mdi mdi-open-in-new"></i>
                </a>
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-calendar-alert d-sm-block d-md-none"></i>
                {{ $domain['expired'] ?  Helpy::localDatetime($domain['expired'], app()->getLocale()) : '---' }}
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-calendar-check d-sm-block d-md-none"></i>
                {{ Helpy::localDatetime($domain['created'], app()->getLocale()) }}
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-server-network"></i>
                <strong>{{ $domain['hosting']['name'] ?? '-' }}</strong>
            </div>
            <div class="col-4 col-sm-4 col-md-1 text-center">
                <span class="badge {{ $domain['status'] == 'active' ? 'bg-success' : 'bg-danger' }}">
                    {{ $domain['status'] == 'active' ? __('site.label.active') : __('site.label.inactive') }}
                </span>
            </div>
            <div class="col-8 col-sm-8 col-md-2 text-end">
                @if ($domain['registrar_self'])
                <a href="{{ route('Site-DomainGetRenew', ['uuid' => $domain['uuid']]) }}"
                    class="btn btn-warning text-dark {{ Browser::isMobile() ? 'btn-sm' : null }}"
                    title="{{ __('site.label.renew') }}">
                    <i class="mdi mdi-history"></i>
                </a>
                @endif
                <a href="{{ route('Site-DomainGetDetail', ['uuid' => $domain['uuid']]) }}"
                    class="btn btn-outline-dark {{ Browser::isMobile() ? 'btn-sm' : null }}"
                    title="{{ __('site.label.show') }}">
                    <i class="mdi mdi-eye"></i>
                    {{ __('site.label.show') }}
                </a>
            </div>
        </div>
    </button>

    @empty

    <button type="button" class="list-group-item list-group-item-action">
        <div class="text-danger text-center">
            {{ __('site.wording.no_data_available') }}
        </div>
    </button>

    @endforelse
</div>


@endsection

@section('scripts')

@endsection
@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-5">
        <a href="{{ route('Site-ServiceGetDetail', ['service' => 'web-perso']) }}"
            class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.buy') }}
        </a>
    </div>
    <div class="col-7 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($hosting_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.hosting') }}(s)</span>
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
                {{ __('site.label.package') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.expired') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.created') }}
            </div>
            <div class="col-md-1 text-center">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>
    @forelse (collect($hosting_list)->sortByDesc('created') as $hosting)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-3 text-truncate">
                <i class="mdi mdi-server-network d-sm-block d-md-none"></i>
                <strong class="text-primary">
                    {{ $hosting['name'] }}
                </strong>
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-buffer d-sm-block d-md-none"></i>
                {{ $hosting['service']['name'][app()->getLocale()] }} :
                {{ $hosting['package']['name'] ?? '-' }}
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-calendar-alert d-sm-block d-md-none"></i>
                {{ $hosting['expired'] == null ? __('site.label.unlimited') : Helpy::localDatetime($hosting['expired'], app()->getLocale()) }}
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-calendar-check d-sm-block d-md-none"></i>
                {{ Helpy::localDatetime($hosting['created'], app()->getLocale()) }}
            </div>
            <div class="col-4 col-sm-4 col-md-1 text-center">
                <span class="badge {{ $hosting['status'] == true ? 'bg-success' : 'bg-danger' }}">
                    {{ $hosting['status'] == true ? __('site.label.active') : __('site.label.inactive') }}
                </span>
            </div>
            <div class="col-8 col-sm-8 col-md-2 text-end">
                @if ($hosting['expired'])
                <a href="{{ route('Site-HostingGetRenew', ['uuid' => $hosting['uuid']]) }}"
                    class="btn btn-warning text-dark {{ Browser::isMobile() ? 'btn-sm' : null }}"
                    title="{{ __('site.label.renew') }}">
                    <i class="mdi mdi-history"></i>
                </a>
                @endif
                <a href="{{ route('Site-HostingGetDetail', ['uuid' => $hosting['uuid']]) }}"
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
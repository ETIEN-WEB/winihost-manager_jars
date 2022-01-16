@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <a href="{{ route('Site-MonitoringPostCreate') }}" class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.add') }}
        </a>
    </div>
    <div class="col-6 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($monitoring_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.monitoring') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-5">
                {{ __('site.label.url') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.method') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.header') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.update') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>
    @forelse (collect($monitoring_list)->sortByDesc('created') as $monitoring)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-5">
                <a href="https://{{ $monitoring['url'] }}" class="text-primary fw-bold text-decoration-none"
                    target="blank">
                    <i class="mdi mdi-open-in-new"></i>
                    {{ $monitoring['url'] }}
                </a>
            </div>
            <div class="col-md-1">
                <i class="mdi mdi-earth d-inline d-sm-inline d-md-none"></i>
                {{ $monitoring['method'] }}
            </div>
            <div class="col-md-1">
                <i class="mdi mdi-earth d-inline d-sm-inline d-md-none"></i>
                {{ $monitoring['header'] }}
            </div>
            <div class="col-md-2">
                <i class="mdi mdi-clock-outline"></i>
                {{ Carbon\Carbon::parse($monitoring['updated'])->diffForHumans() }}
            </div>
            <div class="col-md-1">
                <h6>
                    <i class="mdi mdi-check-circle d-inline d-sm-inline d-md-none"></i>
                    <span class="badge {{ $monitoring['status'] == true ? 'bg-success' : 'bg-danger' }}">
                        {{ $monitoring['status'] == true ? __('site.label.active') : __('site.label.inactive') }}
                    </span>
                </h6>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{ route('Site-MonitoringGetDetail', ['uuid' => $monitoring['uuid']]) }}"
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
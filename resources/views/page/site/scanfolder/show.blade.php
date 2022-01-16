@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <a href="{{ route('Site-ServiceGetDetail', ['service' => 'scanfolder']) }}"
            class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.add') }}
        </a>
    </div>
    <div class="col-6 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($scanfolder_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.scanfolder') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="alert alert-info text-center">
    <i class="mdi mdi-bell"></i>
    {{ __('site.wording.scanfolder_info') }}
</div>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-2">
                {{ __('site.label.name') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.expired') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.created') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.quota') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-3 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>

    @forelse (collect($scanfolder_list)->sortByDesc('created') as $scanfolder)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-2">
                <span class="text-primary fw-bold">
                    {{ $scanfolder['name'] }}
                </span>
            </div>
            <div class="col-md-2">
                <span class="">
                    {{ Helpy::localDatetime($scanfolder['expired'], app()->getLocale()) }}
                </span>
            </div>
            <div class="col-md-2">
                <span class="">
                    {{ Helpy::localDatetime($scanfolder['expired'], app()->getLocale()) }}
                </span>
            </div>
            <div class="col-md-2">
                <span>
                    {{ ($scanfolder['quota'] - $scanfolder['available']) }}/{{ $scanfolder['quota'] }}
                </span>
            </div>
            <div class="col-md-1">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.status') }} : </span>
                <span class="badge {{ $scanfolder['status'] == true ? 'bg-success' : 'bg-danger' }}">
                    {{ $scanfolder['status'] == true ? __('site.label.active') : __('site.label.inactive') }}
                </span>
            </div>
            <div class="col-md-3 text-center">
                <a href="{{ route('Site-ScanfolderGetRenew', ['uuid' => $scanfolder['uuid']]) }}"
                    class="btn btn-warning text-dark {{ Browser::isMobile() ? 'btn-sm' : null }}"
                    title="{{ __('site.label.renew') }}">
                    <i class="mdi mdi-history"></i>
                </a>
                <a href="{{ route('Site-ScanfolderGetDetail', $scanfolder['uuid']) }}"
                    class="btn btn-outline-dark {{ Browser::isMobile() ? 'btn-sm' : null }}">
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
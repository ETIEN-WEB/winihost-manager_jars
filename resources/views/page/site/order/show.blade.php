@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <a href="{{ route('Site-ServiceGetShow') }}" class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.our_services') }}
        </a>
    </div>
    <div class="col-6 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($order_list) }}
            <span class="d-none d-sm-none d-md-inline">{{ __('site.label.order') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="alert alert-info small text-center">
    <i class="mdi mdi-bell"></i>
    {{ __('site.wording.order_info_clear') }}
</div>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-4">
                Ref
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.amount') }}
            </div>
            <div class="col-md-1 text-center">
                {{ __('site.label.vat') }}
            </div>
            <div class="col-md-3 text-center">
                {{ __('site.label.date') }}
            </div>
            <div class="col-md-1 text-center">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-1 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>
    @forelse (collect($order_list)->sortByDesc('created') as $value)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-4 text-truncate {{ Browser::isMobile() ? 'text-center' : null }}">
                <strong class="text-secondary">
                    {{ $value['uuid'] }}
                </strong>
            </div>
            <div class="col-md-2 {{ Browser::isMobile() ? 'text-center' : 'text-end' }}">
                {{ Helpy::formatPrice($value['amount']) }}
            </div>
            <div class="col-md-1 text-center">
                {{ Helpy::formatNumber(floatval($value['vat']), app()->getLocale()) }}%
            </div>
            <div class="col-md-3 text-center">
                {{ Helpy::localDatetime($value['created'], app()->getLocale()) }}
            </div>
            <div class="col-md-1 text-center">
                @if (in_array($value['status'], ['Expired', 'Canceled']))
                <strong class="text-danger">
                    {{ $value['status'] }}
                </strong>
                @else
                <strong class="text-success">
                    {{ $value['status'] }}
                </strong>
                @endif
            </div>
            <div class="col-md-1 text-center">
                <a href="{{ route('Site-OrderGetDetail', ['uuid' => $value['uuid']]) }}"
                    class="btn btn-outline-dark rounded-pill w-100 {{ Browser::isMobile() ? 'btn-sm' : null }}">
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
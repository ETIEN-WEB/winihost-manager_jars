@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="my-2">
            {{ __('site.label.order_detail') }}
        </h5>
    </div>
    <div class="card-body">

        <div class="row">

            <div class="col-md-8">
                <div class="card border-3 border-secondary border-bottom-0 border-end-0 border-start-0 shadow mb-3">
                    <div class="card-body">
                        <div class="row {{ Browser::isMobile() ? 'text-center' : null }}">
                            <div class="col-md-8">
                                <span class="d-none d-sm-none d-md-inline">Ref :</span>
                                <strong class="text-primary">
                                    {{ $order_detail['uuid'] }}
                                </strong>
                            </div>
                            <div class="col-md-4">
                                <i class="mdi mdi-calendar-clock"></i>
                                {{ Helpy::localDatetime($order_detail['created'], app()->getLocale()) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-3 text-center">
                                {{ __('site.label.amount') }}
                                <strong class="fw-bold d-block my-2">
                                    {{ Helpy::formatPrice($order_detail['amount']) }}
                                </strong>
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 text-center">
                                {{ __('site.label.promo_code') }}
                                <strong class="fw-bold d-block my-2">
                                    {{ $order_detail['promo_code'] ?? '-' }}
                                </strong>
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 text-center">
                                {{ __('site.label.vat') }}
                                <strong class="fw-bold d-block my-2">
                                    {{ Helpy::formatNumber(floatval($order_detail['vat']), app()->getLocale()) }}%
                                </strong>
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 text-center">
                                {{ __('site.label.amount_vat') }}
                                <strong class="fw-bold d-block my-2">
                                    {{ Helpy::formatPrice($order_detail['amount_tax_include']) }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-3 border-secondary border-bottom-0 border-end-0 border-start-0 shadow mb-3">
                    <div class="card-body text-center">
                        <span class="text-muted d-block">{{ __('site.label.status') }}</span>
                        <span class="fs-3">
                            [ {{ $order_detail['status'] }} ]
                        </span>
                        <br>
                        <a href="{{ $order_detail['link'] }}" target="blank"
                            class="btn btn-success mt-2 mb-2 rounded-pill">
                            <i class="mdi mdi-file-check-outline"></i>
                            Afficher la facture
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-3 border-secondary border-bottom-0 border-end-0 border-start-0 shadow mb-3">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item bg-secondary text-white d-none d-sm-none d-md-block"
                                aria-current="true">
                                <div class="row">
                                    <div class="col-md-1 text-center">
                                        #
                                    </div>
                                    <div class="col-md-3">
                                        {{ __('site.label.service') }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('site.label.price') }}
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{ __('site.label.quantity') }}
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{ __('site.label.duration') }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ __('site.label.total') }}
                                    </div>
                                </div>
                            </li>
                            @foreach ($order_detail['carts'] as $key => $cart)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-1 text-center">
                                        {{ $cart['action']}}
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 text-truncate">
                                        {{ $cart['service']['name'][app()->getLocale()] ?? '-' }} :
                                        {{ $cart['package']['name'] ?? '-' }}
                                        ({{ $cart['detail'] ?? '-' }})
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-2">
                                        {{ Helpy::formatPrice($cart['price']) ?? '-' }}
                                    </div>
                                    <div class="col-5 col-sm-5 col-md-2 text-center">
                                        {{ $cart['quantity'] }}
                                    </div>
                                    <div class="col-5 col-sm-5 col-md-2 text-center">
                                        {{ $cart['price_duration'] == 0 ? __('site.label.unlimited') : $cart['price_duration'] .' '. __('site.label.' . $cart['price_unit']) . '(s)' }}
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-2">
                                        {{ Helpy::formatPrice($cart['price_total']) ?? '-' }}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')

@endsection
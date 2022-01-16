@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="list-group">

    @if ($cart_list)

    <ul class="list-group">
        <li class="list-group-item bg-secondary text-white d-none d-sm-none d-md-block" aria-current="true">
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
                <div class="col-md-1 text-center">
                    {{ __('site.label.quantity') }}
                </div>
                <div class="col-md-2 text-center">
                    {{ __('site.label.duration') }}
                </div>
                <div class="col-md-2">
                    {{ __('site.label.total') }}
                </div>
                <div class="col-md-1">
                    {{ __('site.label.action') }}
                </div>
            </div>
        </li>
        @foreach ($cart_list as $key => $cart)
        <li class="list-group-item">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-1 text-center">
                    <div class="text-primary">{{ $cart['action'] }}</div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 pb-2">
                    {{ $cart['service']['name'][app()->getLocale()] ?? '-' }} :
                    {{ $cart['package']['name'] ?? '-' }}
                    ({{ $cart['detail'] ?? '-' }})
                </div>
                <div class="col-6 col-sm-6 col-md-2 text-center">
                    {{ Helpy::formatPrice($cart['price'], json_decode(Cookie::get('preference'))->currency == 'xof' ? false : true) }}
                </div>
                <div class="col-6 col-sm-6 col-md-1 text-center">
                    <form class="selectCartQuantity"
                        action="{{ route('Site-CartPostUpdate', ['uuid' => $cart['uuid']]) }}" method="POST">
                        @csrf
                        <select name="quantity" class="form-control form-control-sm">
                            <option {{ $cart['quantity'] == 1 ? 'selected' : null }}>1</option>
                            <option {{ $cart['quantity'] == 2 ? 'selected' : null }}>2</option>
                            <option {{ $cart['quantity'] == 3 ? 'selected' : null }}>3</option>
                            <option {{ $cart['quantity'] == 4 ? 'selected' : null }}>4</option>
                            <option {{ $cart['quantity'] == 5 ? 'selected' : null }}>5</option>
                            <option {{ $cart['quantity'] == 6 ? 'selected' : null }}>6</option>
                            <option {{ $cart['quantity'] == 7 ? 'selected' : null }}>7</option>
                            <option {{ $cart['quantity'] == 8 ? 'selected' : null }}>8</option>
                            <option {{ $cart['quantity'] == 9 ? 'selected' : null }}>9</option>
                            <option {{ $cart['quantity'] == 10 ? 'selected' : null }}>10</option>
                        </select>
                    </form>
                </div>
                <div class="col-5 col-sm-5 col-md-2 text-center">
                    {{ $cart['price_duration'] == 0 ? 'Illimité' : $cart['price_duration'] .' '. __('site.label.' . $cart['price_unit']) . '(s)' }}
                </div>
                <div class="col-5 col-sm-5 col-md-2">
                    {{ Helpy::formatPrice($cart['price_total'], json_decode(Cookie::get('preference'))->currency == 'xof' ? false : true) }}
                </div>
                <div class="col-2 col-sm-2 col-md-1">
                    <form id="{{ $cart['uuid'] }}"
                        action="{{ route('Site-CartPostDelete', ['uuid' => $cart['uuid']]) }}" method="POST">
                        @csrf
                        <i class="mdi mdi-delete text-danger mdi-18px btn p-0 BtnDeleteCart"
                            data-uuid="{{ $cart['uuid'] }}" title="{{ __('site.label.delete') }}"></i>
                    </form>
                </div>
            </div>
        </li>
        @endforeach
    </ul>

    <hr class="border border-2 border-dark">

    <div class="row">
        <div class="col-md-8">

            <div class="d-none d-md-block">
                <strong class="d-block">{{ __('site.wording.condition_payment_title') }}</strong>
                <small class="text-muted">
                    {{ __('site.wording.condition_payment_detail') }}
                </small>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card border border-3 border-success border-end-0 border-bottom-0 border-start-0 shadow">
                <div class="card-body text-center">

                    <h6 class="mb-3">
                        <small class="text-muted">{{ __('site.label.subtotal') }} :</small>
                        {{ Helpy::formatPrice(collect($cart_list)->sum('price_total'), true) }}
                    </h6>

                    <form id="checkCodeForm" action="{{ route('Site-CartPostCheckCode') }}" method="POST" class="px-5">
                        @csrf
                        <div class="input-group">

                            <input id="checkCodeInput" name="code" type="text" class="form-control text-center"
                                placeholder="{{ __('site.input.placeholder.promo_code') }}"
                                value="{{ $_GET['code'] ?? null }}" required>
                            <span id="checkCodeCart"
                                class="input-group-text mdi mdi-focus-field mdi-24px px-2 py-0 
                                {{ isset($_GET['code']) && $_GET['code'] == session('UserSession.code_promo.code') ? 'bg-success' : null }}"
                                style="cursor: pointer" title="Appliquer le code promo"></span>
                        </div>
                        <i class="text-danger d-block mb-3 small" id="checkCodeError"></i>
                    </form>

                    <h5 class="mb-3">
                        <small class="text-muted">{{ __('site.label.total') }} :</small>
                        @php
                        $ht = collect($cart_list)->sum('price_total');
                        @endphp
                        {{ Helpy::formatPrice($ht - ($ht * (session('UserSession.code_promo.reduction')/100)), true) }}
                    </h5>

                    <form action="{{ route('Site-OrderPostGenerate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="promo_code" value="{{ $_GET['code'] ?? null }}">
                        <button class="btn btn-success rounded-pill w-100">
                            <i class="mdi mdi-check-all"></i>
                            {{ __('site.wording.generate_order') }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @else

    <div class="alert alert-danger text-center my-5" role="alert">
        <h1 class="alert-heading">
            <i class="mdi mdi-cart mdi-70px"></i>
        </h1>
        <span class="fs-5 fw-bold">{{ __('site.wording.your_basket_is_empty') }}</span>
        <hr>
        {{ __('site.wording.to_place_orders_click_here') }} :
        <br>
        <a class="btn btn-sm btn-warning fw-bold px-4 border border-white shadom"
            href="{{ route('Site-ServiceGetShow') }}">
            <i class="mdi mdi-plus"></i>
            {{ __('site.label.command') }}
        </a>
    </div>

    @endif

</div>

@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('.BtnDeleteCart').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this));
    });
    $('.selectCartQuantity').change(function (e) { 
        e.preventDefault();
        $(this).submit();
    });
    $('#checkCodeCart').click(function (e) { 
        e.preventDefault();
        var code = $('#checkCodeInput').val();
        if (code) {
            $('#checkCodeForm').submit();
        } else {
            $('#checkCodeError').text("{{ __('site.wording.please_enter_promo_code') }}");
        }
        
    });
</script>
@endsection
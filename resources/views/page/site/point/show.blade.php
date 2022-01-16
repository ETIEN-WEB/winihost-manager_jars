@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card shadow border border-secondary mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <strong class="text-secondary">
                            {{ __('site.label.total') }}
                            {{ __('site.label.point') }}(s)
                        </strong>
                        <span class="d-block fs-1">
                            {{ $point_detail['point'] }}
                        </span>
                    </div>
                    <div class="col-md-2 text-center {{ !Browser::isMobile() ? 'pt-3' : null }}">
                        <i
                            class="mdi mdi-spin mdi-star-circle mdi-48px text-warning {{ Browser::isMobile() ? 'mdi-rotate-90' : null }}"></i>
                    </div>
                    <div class="col-md-5 text-center">
                        <strong class="text-secondary">
                            {{ __('site.label.value') }}
                        </strong>
                        <span class="d-block fs-1">
                            {{ Helpy::formatPrice($point_detail['amount']) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5>{{ __('site.label.history') }}</h5>
            </div>
            <div class="card-body">
                @if (!Browser::isMobile())
                <div class="alert alert-secondary fw-bold">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            {{ __('site.label.action') }}
                        </div>
                        <div class="col-md-2 text-center">
                            {{ __('site.label.direction') }}
                        </div>
                        <div class="col-md-2 text-center">
                            {{ __('site.label.point') }}(s)
                        </div>
                        <div class="col-md-2 text-center">
                            {{ __('site.label.amount') }}
                        </div>
                        <div class="col-md-3 text-center">
                            {{ __('site.label.date') }}
                        </div>
                    </div>
                </div>
                @endif
                @forelse (collect($point_detail['history'])->sortByDesc('created_at') as $value)
                <div class="row">
                    <div class="col-md-3 text-center">
                        <b class="text-primary">
                            {{ $value['action'] }}
                        </b>
                    </div>
                    <div class="col-md-2 text-center">
                        @if ($value['direction_operation'] == 'decrement')
                        <i class="mdi mdi-arrow-up-bold text-danger"></i>
                        @else
                        <i class="mdi mdi-arrow-down-bold text-success"></i>
                        @endif
                        {{ $value['direction_operation'] }}
                    </div>
                    <div class="col-md-2 text-center">
                        {{ $value['point'] }}
                    </div>
                    <div class="col-md-2 text-center">
                        {{ Helpy::formatPrice($value['amount']) }}
                    </div>
                    <div class="col-md-3 text-center">
                        {{ Helpy::localDatetime($value['created_at'], app()->getLocale()) }}
                    </div>
                </div>
                <hr>
                @empty
                <div class="text-danger text-center">
                    {{ __('site.wording.no_data_available') }}
                </div>
                @endforelse
            </div>
        </div>

    </div>
    <div class="col-md-4">

        <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
                <b>{{ __('site.label.converter') }}</b>
            </div>
            <div class="card-body">
                <form id="convert_form">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2 id="convert_result" class="mb-3">
                                ...
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <select id="convert_start"
                                class="form-control border border-secondary rounded-pill mb-3 shadow" required>
                                <option value="point">{{ __('site.label.point') }}</option>
                                <option value="amount">{{ __('site.label.amount') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="convert_end"
                                class="form-control border border-secondary rounded-pill mb-3 shadow" required>
                                <option value="amount">{{ __('site.label.amount') }}</option>
                                <option value="point">{{ __('site.label.point') }}</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="number" id="convert_data"
                                class="form-control border border-secondary rounded-pill mb-3 shadow text-center"
                                placeholder="{{ __('site.label.data') }}, Ex : 25600" required>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="convert_btn"
                                class="btn btn-info btn-sm w-100 rounded-pill fw-bold mb-3 shadow">
                                {{ __('site.label.convert') }}
                                <i class="mdi mdi-arrow-right-bold"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <a href="{{ route('Site-ServiceGetDetail', ['service' => 'point']) }}"
            class="btn btn-warning btn-lg w-100 text-dark my-3 border border-dark shadow">
            <i class="mdi mdi-cart"></i>
            {{ __('site.label.buy_credit') }}
        </a>

    </div>
</div>

@endsection

@section('scripts')
<script>
    $('#convert_form').submit(function (e) { 
        e.preventDefault();

        var start = $('#convert_start').val();
        var end = $('#convert_end').val();
        var data = parseFloat($('#convert_data').val());
        var rate = parseFloat("{{ $point_detail['rate'] }}");

        if (start == end) {
            end = (start != 'point') ? 'point' : 'amount';
            $('#convert_end').val(end);
        }

        if (start == 'point') {
            var result = data * rate;
        } else {
            var result = data / rate;
        }
        
        $("#convert_result").text(result);
    });
</script>
@endsection
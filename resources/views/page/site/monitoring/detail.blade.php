@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <h2 class="text-truncate">
            <i class="mdi mdi-radio-tower"></i>
            {{ __('site.label.monitoring') }}
        </h2>
    </div>
    <div class="col-4 text-end">
        <a href="{{ route('Site-MonitoringGetShow') }}" class="badge bg-danger text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
        </a>
    </div>
</div>

<hr>

<div class="row mb-3">
    <div class="col-md-10 pt-3">
        <span class="fs-6">
            <span class="badge bg-success">
                {{ $monitoring_detail['method'] }}
            </span>
        </span>
        {{ $monitoring_detail['url'] }}
        <a href="{{ $monitoring_detail['url'] }}" class="mdi mdi-open-in-new" target="blank"></a>
    </div>
    <div class="col-md-2 pt-3">

        <form id="{{ $monitoring_detail['uuid'] }}"
            action="{{ route('Site-MonitoringPostDelete', ['uuid' => $monitoring_detail['uuid']]) }}" method="POST">
            @csrf
            <a href="{{ route('Site-MonitoringGetEdite', ['uuid' => $monitoring_detail['uuid']]) }}"
                class="text-primary text-decoration-none">
                {{ __('site.label.edit') }}
            </a>
            |
            <a href="#" id="BtnDeleteMonitoring" data-uuid="{{ $monitoring_detail['uuid'] }}"
                class="text-danger text-decoration-none">
                {{ __('site.label.delete') }}
            </a>
        </form>
    </div>
</div>

@if (!Browser::isMobile())

<canvas id="myChart" width="400" height="100" data-my-labels='{{ $statistic_keys }}'
    data-my-datas='{{ $statistic_values }}'></canvas>

<hr>

@endif

<div class="row">
    @foreach ($statistics->reverse() as $date => $code)
    @if ($code != 200)
    <div class="col-md-3">
        <div class="small text-secondary">
            <i class="mdi mdi-access-point-network text-dark"></i>
            {{ Helpy::localDatetime($date, app()->getLocale()) }}
            <span class="badge bg-danger">
                {{ $code }}
            </span>
        </div>
    </div>
    @endif
    @endforeach
</div>

@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ cdn_asset('/dist/all/js/chart/chart.min.js') }}"></script>
<script>
    var ctx = document.getElementById('myChart');
    var labels = JSON.parse(ctx.getAttribute('data-my-labels'));
    var datas = JSON.parse(ctx.getAttribute('data-my-datas'));
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Statu code',
                data: datas,
                borderColor: 'rgb(75, 192, 192)'
            }]
        }
    });

    $('#BtnDeleteMonitoring').click(function (e) { 
        e.preventDefault();
        console.log($(this))
        AlertDeleteItem($(this));
    });
</script>
@endsection
@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <a href="{{ route('Site-MonitoringGetShow') }}" class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
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

<div class="col-md-6 offset-md-3">
    <div class="card border shadow mb-3">
        <div class="card-header bg-secondary text-white">
            <h5 class="card-title text-white my-2 d-inline">
                {{ __('site.wording.edit_monitoring') }}
            </h5>
        </div>
        <div class="card-body">

            <form method="POST" class="row">

                @csrf

                <div class="form-group col-md-12">
                    <label class="fw-bold" for="url">{{ __('site.label.url') }}</label>
                    <input type="url" id="url" name="url" value="{{ old('url') ?? $monitoring_detail['url'] }}"
                        class="form-control mb-2" placeholder="{{ __('site.input.placeholder.url') }}" disabled>
                </div>

                <div class="form-group col-md-12">
                    <label class="fw-bold" for="method">{{ __('site.label.method') }}</label>
                    <select name="method" id="selectmethod" class="form-control mb-2" required>
                        <option {{ $monitoring_detail['method'] == 'GET' ? 'selected' : null }} value="GET">GET</option>
                        <option {{ $monitoring_detail['method'] == 'POST' ? 'selected' : null }} value="POST">POST
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label class="fw-bold" for="status">{{ __('site.label.status') }}</label>
                    <select class="form-control mb-2" name="status" id="status">
                        <option {{ $monitoring_detail['status'] == true ? 'selected' : null }} value="true">
                            {{ __('site.label.active') }}</option>
                        <option {{ $monitoring_detail['status'] == false ? 'selected' : null }} value="false">
                            {{ __('site.label.inactive') }}</option>
                    </select>
                </div>

                <div class="text-center">
                    <a href="{{ route('Site-MonitoringGetShow') }}" class="btn btn-sm btn-danger">
                        <i class="mdi mdi-chevron-left"></i>
                        {{ __('site.label.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-check"></i>
                        {{ __('site.label.validate') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
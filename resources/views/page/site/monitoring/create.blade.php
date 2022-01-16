@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-7">
        <a href="{{ route('Site-MonitoringGetShow') }}" class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
        </a>
    </div>
    <div class="col-5 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($monitoring_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.monitoring') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="row">

    <div class="col-md-6 offset-md-3">
        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.wording.add_new_monitoring') }}
                </h5>
            </div>
            <div class="card-body">

                <form method="POST" class="row">

                    @csrf

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="url">{{ __('site.label.url') }}</label>
                        <input type="url" id="url" name="url" value="{{ old('url') }}" class="form-control mb-2"
                            placeholder="{{ __('site.input.placeholder.url') }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="method">{{ __('site.label.method') }}</label>
                        <select name="method" id="selectmethod" class="form-control mb-2" required>
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
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

</div>

@endsection

@section('scripts')

@endsection
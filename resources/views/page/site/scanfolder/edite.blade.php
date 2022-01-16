@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-7">
        <a href="{{ route('Site-ScanfolderGetShow') }}" class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
        </a>
    </div>
    <div class="col-5 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($scanfolder_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.scanfolder') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="row">

    <div class="col-md-6 offset-md-3">
        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.wording.edit_scanfolder') }}
                </h5>
            </div>
            <div class="card-body">

                <form method="POST" class="row" action="{{ route('Site-ScanfolderPostEdite', $scanfolder_item_detail['uuid']) }}">
                    @csrf
                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="name">{{ __('site.label.name') }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name') ?? $scanfolder_item_detail['name'] }}"
                            class="form-control mb-2" placeholder="{{ __('site.input.placeholder.name') }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="host">Ftp : {{ __('site.label.host') }}</label>
                        <input type="text" id="host" name="host"
                            value="{{ old('host') ?? $scanfolder_item_detail['params']['host'] }}" class="form-control mb-2"
                            placeholder="{{ __('site.input.placeholder.host') }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="user">Ftp : {{ __('site.label.username') }}</label>
                        <input type="text" id="user" name="user"
                            value="{{ old('user') ?? $scanfolder_item_detail['params']['username'] }}"
                            class="form-control mb-2" placeholder="{{ __('site.input.placeholder.username') }}"
                            required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="password">Ftp : {{ __('site.label.password') }}</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                            class="form-control mb-2" placeholder="{{ __('site.input.placeholder.password') }}"
                            required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="port">Ftp : {{ __('site.label.port') }}</label>
                        <input type="number" min="0" id="port" name="port"
                            value="{{ old('port') ?? $scanfolder_item_detail['params']['port'] }}" class="form-control mb-2"
                            placeholder="{{ __('site.input.placeholder.port') }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="root">Ftp {{ __('site.label.path') }}</label>
                        <input type="text" id="root" name="root"
                            value="{{ old('root') ?? $scanfolder_item_detail['params']['root'] }}" class="form-control mb-2"
                            placeholder="{{ __('site.input.placeholder.path') }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="excepts">{{ __('site.label.except') }}</label>
                        <input type="text" id="excepts" name="excepts"
                            value="{{ old('excepts') ?? (isset($scanfolder_item_detail['params']['excepts']) ? implode(', ', $scanfolder_item_detail['params']['excepts']) : null) }}"
                            class="form-control mb-2" placeholder="{{ __('site.input.placeholder.except') }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="status">{{ __('site.label.status') }}</label>
                        <select class="form-control mb-2" name="status" id="status">
                            <option {{ $scanfolder_item_detail['status'] == true ? 'selected' : null }} value="1">
                                {{ __('site.label.active') }}</option>
                            <option {{ $scanfolder_item_detail['status'] == false ? 'selected' : null }} value="0">
                                {{ __('site.label.inactive') }}</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('Site-ScanfolderGetShow') }}" class="btn btn-sm btn-danger">
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

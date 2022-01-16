@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-7">
        <a href="{{ route('Site-ServiceGetDetail', ['service' => 'domain']) }}"
            class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.buy') }}
        </a>
    </div>
    <div class="col-5 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($domain_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.domain') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="row">

    <div class="col-md-6 offset-md-3">
        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.wording.add_new_domain') }}
                </h5>
            </div>
            <div class="card-body">

                <form method="POST" class="row">

                    @csrf

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="domain">{{ __('site.label.domain') }}</label>
                        <input type="text" id="domain" name="domain" value="{{ old('domain') }}"
                            class="form-control mb-2" placeholder="{{ __('site.input.placeholder.domain') }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="hosting">{{ __('site.label.hosting') }}</label>
                        <select name="hosting" id="selectHosting" class="form-control mb-2" required>
                            <option value="x">-- {{ __('site.label.hosting') }} ---</option>
                            @foreach ($hosting_list as $hosting)
                            <option value="{{ $hosting['uuid'] }}">
                                {{ $hosting['name'] }} &nbsp;&nbsp;
                                {{ !Browser::isMobile() ? '[' . $hosting['server']['name'] . ']' : null }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('Site-DomainGetShow') }}" class="btn btn-sm btn-danger">
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
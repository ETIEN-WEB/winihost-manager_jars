@extends('layout.auth.master')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-sm-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">

            <div class="card border border-secondary mb-3">
                <div class="card-header text-center p-3">
                    <h2 class="text-color-blue text-white mb-0">
                        {!! __('site.auth.form.header.activer') !!}
                    </h2>
                </div>
                <div class="card-body">

                    <div class="text-center alert bg-ffe69b">
                        {!! __('site.auth.form.info.activer') !!}
                    </div>

                    <form class="form-horizontal" method="post">

                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                <input name="token_activation" class="form-control text-center fw-bold" type="text"
                                    required placeholder="{{ __('site.input.placeholder.token_activation') }}"
                                    value="{{ old('token_activation') }}">
                                <div class="text-danger mb-2 small">
                                    {{$errors->first('token_activation')}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group account-btn text-center my-3">
                            <div class="col-12">
                                <button class="btn btn-danger" type="submit">
                                    <i class="mdi mdi-check"></i>
                                    {{ __('site.bouton.activer') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <hr>
                    <div class="text-center">
                        <div class="mb-2">
                            <a href="{{ route('Auth-LoginGetShow') }}" class="text-decoration-none">
                                <i class="mdi mdi-account-circle"></i>
                                {{ __('site.auth.form.an_account') }}
                            </a>
                        </div>
                        <div class="">
                            {{ __('site.auth.form.no_account') }}
                            <a href="{{ route('Auth-RegisterGetShow') }}" class="fw-bold text-decoration-none">
                                {{ __('site.auth.form.to_register') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
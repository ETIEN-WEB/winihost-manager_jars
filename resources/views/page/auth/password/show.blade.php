@extends('layout.auth.master')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-sm-12 col-md-8 col-lg-4 offset-md-2 offset-lg-4">

            <div class="card border border-secondary mb-3">
                <div class="card-header text-center p-3">
                    <h2 class="text-color-blue">
                        {{ __('site.auth.form.header.password') }}
                    </h2>
                </div>
                <div class="card-body">

                    <div class="text-center alert bg-ffe69b">
                        {!! __('site.auth.form.info.password') !!}
                    </div>

                    <form class="form-horizontal" method="post">

                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                <input name="email" class="form-control text-center" type="email" required
                                    placeholder="{{ __('site.input.placeholder.email') }}" value="{{old('email')}}">
                                <div class="text-danger mb-2 small">
                                    {{$errors->first('email')}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group account-btn text-center mt-3">
                            <div class="col-12">
                                <button class="btn btn-danger" type="submit">
                                    <i class="mdi mdi-lock"></i>
                                    {{ __('site.label.reset') }}
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
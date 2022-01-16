@extends('layout.auth.master')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-sm-12 col-md-8 col-lg-4 offset-md-2 offset-lg-4">

            <div class="card border border-secondary mb-3">
                <div class="card-header text-center p-3">
                    <h2 class="text-color-blue mb-0">
                        {{ __('site.auth.form.header.password') }}
                    </h2>
                </div>
                <div class="card-body">

                    <form class="form-horizontal" method="post">

                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input name="email" class="form-control mb-2" type="email" required
                                    placeholder="{{ __('site.input.placeholder.email') }}" value="{{ old('email') }}">
                                <span class="text-danger">
                                    {{ $errors->first('email') }}
                                </span>
                            </div>
                            <div class="col-md-12">
                                <input name="password" class="form-control mb-2" type="password" required
                                    placeholder="{{ __('site.input.placeholder.password_new') }}"
                                    value="{{ old('password') }}">
                                <span class="text-danger">
                                    {{ $errors->first('password') }}
                                </span>
                            </div>
                            <div class="col-md-12">
                                <input name="password_confirmation" class="form-control mb-2" type="password" required
                                    placeholder="{{ __('site.input.placeholder.password_confirmation') }}">
                            </div>
                        </div>

                        <div class="form-group account-btn text-center m-t-10">
                            <div class="col-12">

                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">
                                    <i class="mdi mdi-check"></i>
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
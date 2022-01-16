<div class="card border border-secondary mb-3">
    <div class="card-header text-center p-3">
        <h2 class="text-color-blue mb-0">
            {{ __('site.auth.form.header.login') }}
        </h2>
    </div>
    <div class="card-body">
        <form class="form-horizontal"
            action="{{ route('Auth-LoginPostShow' , ['from' => $_GET['from'] ?? null, 'platform' => $_GET['platform'] ?? null, 'autologin' => $_GET['autologin'] ?? null]) }}"
            method="POST" autocomplete="off">
            @csrf
            <div class="form-group row">
                <div class="col-12">
                    <input name="email" class="form-control" type="email" required
                        placeholder="{{ __('site.input.placeholder.email') }}"
                        value="{{ $errors->hasBag('login') ? old('email') : null }}">
                    <div class="text-danger small mb-2">
                        {{ $errors->login->first('email') }}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <input name="password" class="form-control" type="password" autocomplete="false" required
                        placeholder="{{ __('site.input.placeholder.password') }}"
                        value="{{ $errors->hasBag('login') ? old('password') : null }}">
                    <div class="text-danger small mb-2">
                        {{ $errors->login->first('password') }}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="checkbox checkbox-success text-center my-3">
                        <input name="remember" type="checkbox" checked>
                        <label for="checkbox-signup">
                            {{ __('site.input.placeholder.remember_me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group account-btn text-center m-t-10">
                <div class="col-12">
                    <button class="btn btn-danger fw-bold" type="submit">
                        <i class="mdi mdi-lock"></i>
                        {{ __('site.label.login') }}
                    </button>
                </div>
            </div>

        </form>
        <hr>
        <div class="text-center">
            <div class="mb-2">
                <a href="{{ route('Auth-PasswordGetShow') }}" class="text-decoration-none">
                    <i class="mdi mdi-lifebuoy"></i>
                    {{ __('site.auth.form.forgot_password') }}
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
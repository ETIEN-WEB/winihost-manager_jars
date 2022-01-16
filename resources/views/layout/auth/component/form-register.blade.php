<div class="card border border-secondary mb-3">
    <div class="card-header text-center p-3">
        <h2 class="text-color-blue mb-0">
            {{ __('site.auth.form.header.register') }}
        </h2>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('Auth-RegisterPostShow') }}" autocomplete="off">

            @csrf

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <input name="last_name" class="form-control" type="text" required
                            placeholder="{{ __('site.input.placeholder.last_name') }}" value="{{ old('last_name') }}">
                        <div class="text-danger small mb-2">
                            {{ $errors->register->first('last_name') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input name="first_name" class="form-control" type="text" required
                            placeholder="{{ __('site.input.placeholder.first_name') }}" value="{{ old('first_name') }}">
                        <div class="text-danger small mb-2">
                            {{ $errors->register->first('first_name') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input name="email" class="form-control" type="email" required
                            placeholder="{{ __('site.input.placeholder.email') }}"
                            value="{{ $errors->hasBag('register') ? old('email') : null }}">
                        <div class="text-danger small mb-2">
                            {{ $errors->register->first('email') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white p-1">
                                    <img src="{{ cdn_asset('/dist/all/img/flag/ci.png') }}" id="country_flag"
                                        data-cdn="{{ cdn_asset('/dist/all/img/flag/') }}"
                                        class="img-fluid rounded border h-28px w-35px" alt="flag" title="flag"
                                        width="35px" height="28px" loading="eager">
                                </span>
                            </div>
                            <select name="country" class="form-control mb-2" id="country_select" required>
                                @foreach ( $country as $value)
                                <option {{ $value['code'] == 'ci' ? 'selected' : null }} value="{{ $value['code'] }}">
                                    {{ $value['name_'. App::getLocale()] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input name="city" class="form-control" type="text" required
                            placeholder="{{ __('site.input.placeholder.city') }}" value="{{ old('city') }}">
                        <div class="text-danger small mb-2">
                            {{ $errors->register->first('city') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input name="phone" class="form-control" type="number" required
                            placeholder="{{ __('site.input.placeholder.phone') }}" value="{{ old('phone') }}" min="1">
                        <div class="text-danger small mb-2">
                            {{ $errors->register->first('phone') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input name="code_sponsor" class="form-control mb-2" type="text"
                            placeholder="{{ __('site.input.placeholder.code_sponsor') }}"
                            value="{{ isset($_GET['p']) ? $_GET['p'] : old('p') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="password" id="password" class="form-control" type="password" required
                                placeholder="{{ __('site.input.placeholder.password') }}" autocomplete="false"
                                value="{{ $errors->hasBag('register') ? old('password') : null }}"
                                aria-describedby="password-show">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white text-secondary p-0" id="password-show"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ __('site.label.show') }} / {{ __('site.label.hide') }}">
                                    <i id="password-icon" class="mdi mdi-eye mdi-24px px-2"></i>
                                </span>
                            </div>
                        </div>
                        <div class="text-danger small mb-2">
                            {{ $errors->register->first('password') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="checkbox checkbox-success my-3 text-center">
                            <input name="cgu" type="checkbox" checked required>
                            <label for="checkbox-signup" class="mb-0">
                                <a class="text-decoration-none"
                                    href="https://{{ config('myconfig.APP_BASE_URL') }}/termes-et-conditions"
                                    target="blank">
                                    {{ __('site.input.placeholder.cgu') }}
                                </a>
                            </label>
                        </div>
                        <div class="text-danger">
                            {{ $errors->register->first('cgu') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-center">
                        <button class="btn btn-danger fw-bold" type="submit">
                            <i class="mdi mdi-account-circle"></i>
                            {{ __('site.label.register') }}
                        </button>
                    </div>
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
                {{ __('site.auth.form.an_account') }}
                <a href="{{ route('Auth-LoginGetShow') }}" class="text-decoration-none fw-bold">
                    {{ __('site.auth.form.to_login') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    var password = document.getElementById('password');
    var passwordShow = document.getElementById('password-show');
    var passwordIcon = document.getElementById('password-icon');
    passwordShow.addEventListener('click', (e) => {
        var type = password.getAttribute('type');
        if (type == 'password') {
            password.setAttribute('type', 'text'); passwordIcon.classList.remove('mdi-eye'); passwordIcon.classList.add('mdi-eye-off');
        } else {
            password.setAttribute('type', 'password'); passwordIcon.classList.remove('mdi-eye-off'); passwordIcon.classList.add('mdi-eye');
        }
    });
</script>
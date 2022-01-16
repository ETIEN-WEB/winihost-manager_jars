<div class="{{ Browser::isMobile() ? 'fs-5' : 'fs-3' }}">
    {{ __('site.wording.register_your_domain_name') }}
</div>

<hr>

<h3 class="small text-muted">
    {{ __('site.wording.find_your_new_domain_name') }}
</h3>

<form id="search_form" class="bg-secondary rounded {{ Browser::isMobile() ? 'p-2' : 'p-5' }} my-4"
    style="position: relative">
    <input id="search_input" type="text" name="key"
        class="form-control form-control-lg {{ Browser::isMobile() ? null : 'fw-bold text-center' }} text-primary rounded-pill"
        autofocus placeholder="{{ __('site.input.placeholder.domain') }}" value="{{ $_GET['key'] ?? null }}"
        autocomplete="off" required>
    <button id="search_btn" type="submit"
        class="btn btn-danger rounded-pill px-{{ Browser::isMobile() ? '3' : '4' }} float-end"
        style="position: absolute; right: {{ Browser::isMobile() ? '13px; top: 13px;' : '52px; top: 53px;' }}">
        <span id="search_btn_label"> {{ Browser::isMobile() ? null : __('site.label.search')  }}
            <i class="mdi mdi-magnify"></i>
        </span>
        <i id="search_btn_loarder" class="mdi mdi-spin mdi-access-point d-none"></i>
    </button>
</form>

@if (isset($_GET['key']) && !empty($_GET['key']))

<div id="search_one"></div>

<div id="search_favoris" class="d-noned">
    <div class="row alert alert-secondary p-1">
        @foreach (collect($service_detail['packages'])->where('favoris', '=', true) as $favoris)
        <div class="col-6 col-sm-6 col-md-4 col-lg-2 p-1">
            <div class="card">
                <div class="card-body text-center p-1">
                    <strong class="d-block">.{{ $favoris['ext'] }}</strong>
                    <span class="d-block">
                        {{ Helpy::formatPrice($favoris['price'], json_decode(Cookie::get('preference'))->currency == 'xof' ? false : true) }}
                    </span>
                    <div class="search_domain py-2"
                        data-domain="{{ trim(Str::before($_GET['key'], '.')) }}.{{ $favoris['ext'] }}"
                        data-cart="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $favoris['uuid'], 'detail' => trim(Str::before($_GET['key'], '.')) .'.'. $favoris['ext']]) }}">
                        <i class="mdi mdi-spin mdi-24px mdi-access-point text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="row">
    @foreach (collect($service_detail['packages'])->where('favoris', '=', false) as $other)
    <div class="col-md-6">
        <div class="card mb-2">
            <div class="card-body alert-secondary">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 fw-bold text-truncate">
                        {{ trim(Str::before($_GET['key'], '.')) }}.{{ $other['ext'] }}
                    </div>
                    <div class="col-6 col-sm-6 col-md-12 col-lg-3 text-end">
                        {{ Helpy::formatPrice($other['price'], json_decode(Cookie::get('preference'))->currency == 'xof' ? false : true) }}
                    </div>
                    <div class="col-6 col-sm-6 col-md-12 col-lg-3 text-center search_ext">
                        <div class="search_domain"
                            data-domain="{{ trim(Str::before($_GET['key'], '.')) }}.{{ $other['ext'] }}"
                            data-cart="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $other['uuid'], 'detail' => trim(Str::before($_GET['key'], '.')) .'.'. $other['ext']]) }}">
                            <i class="mdi mdi-spin mdi-access-point text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endif


@section('scripts')
<script>
    function Whois(domain, responseHandler) {
        let item = document.querySelector('[data-domain="'+domain+'"]');
        var formdata = new FormData();
        formdata.append("domain", domain);
        fetch("https://api.winihost.com/whois-domain/check", {
            method: 'POST', 
            redirect: 'follow',
            body: formdata
        })
        .then(response => response.text())
        .then((result) => {
            let data = JSON.parse(result);
            responseHandler(item, data.success);
        })
        .catch(error => console.log('error', error));
    }

    function updateStatusWhois(item, status) {
        if (!status) {
            item.innerHTML = `
                <a href="`+ item.getAttribute('data-cart') +`" class="btn btn-warning btn-sm fw-bold border border-white">
                    <i class="mdi mdi-cart"></i> {{ __('site.label.command') }}
                </a>
            `;
        } else {
            item.innerHTML = `
                <a href="#" class="btn btn-secondary disabled btn-sm fw-bold border border-white">
                    <i class="mdi mdi-alert-outline"></i> {{ __('site.label.unavailable') }}
                </a>
            `;
        } 
    }

    var items = document.getElementsByClassName('search_domain');

    Array.from(items).forEach(item => {
        
        var domain = item.getAttribute('data-domain');
        
        // Request vers api.winihost.com
        Whois(domain, (item, status) => {updateStatusWhois(item, status)});
    });

</script>
@endsection
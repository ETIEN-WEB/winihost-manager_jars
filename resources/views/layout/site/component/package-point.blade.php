<div class="row">
    @forelse ($packages as $key => $value)
    @if (Browser::isMobile())
    <div class="col-6 col-sm-6 col-md-4 col-xs-12 p-1">
        <div class="card mb-1 shadow border-warning service-item">
            <img class="card-img-top border-bottom" src="{{ cdn_asset('/dist/all/img/package/' . $value['photo']) }}"
                alt="{{ $value['name'] }}">
            <div class="card-body text-center bg-f0f0f0 px-2 py-1">
                <span class="card-title pricing-card-title fs-6 fw-bold">
                    <span class="text-dark">
                        {{ Helpy::formatPrice($value['price'], json_decode(Cookie::get('preference'))->currency == 'xof' ? false : true) }}
                    </span>
                    <br>
                    <small class="text-muted">
                        {{ $value['price'] / session('UserSession.app_info.point_rate') }}
                        {{ $value['price_unit'] }}
                    </small>
                </span>
                <div class="mt-1">
                    <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
                        class="w-100 btn btn-warning btn-sm">
                        <i class="mdi mdi-cart"></i>
                        {{ __('site.label.add') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-6 col-sm-6 col-md-4 col-xs-12">
        <div class="card mb-4 shadow border-warning service-item">
            <img class="card-img-top border-bottom" src="{{ cdn_asset('/dist/all/img/package/' . $value['photo']) }}"
                alt="{{ $value['name'] }}">
            <div class="card-body text-center bg-f0f0f0">
                <span class="card-title pricing-card-title fs-2">
                    <span class="text-dark">
                        {{ Helpy::formatPrice($value['price'], json_decode(Cookie::get('preference'))->currency == 'xof' ? false : true) }}
                    </span>
                    <br>
                    <small class="text-muted">
                        {{ $value['price'] / session('UserSession.app_info.point_rate') }}
                        {{ $value['price_unit'] }}</small>
                </span>
                <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => ($value['price'] / session('UserSession.app_info.point_rate')) . ' ' . $value['price_unit']]) }}"
                    class="w-100 btn btn-warning fw-bold">
                    <i class="mdi mdi-cart"></i>
                    {{ __('site.label.command') }}
                </a>
            </div>
        </div>
    </div>
    @endif
    @empty
    <div class="col-12">
        <div class="alert alert-danger text-center my-5" role="alert">
            <h1 class="alert-heading">
                <i class="mdi mdi-alert mdi-70px"></i>
            </h1>
            <span class="fs-5 fw-bold">{{ __('site.wording.no_packages_available') }}</span>
            <hr>
            {{ __('site.wording.back_to_list_services') }} :
            <a href="{{ route('Site-ServiceGetShow') }}" class="fw-bold">
                {{ __('site.label.click_here') }}
            </a>
        </div>
    </div>
    @endforelse
</div>
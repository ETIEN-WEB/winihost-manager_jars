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
                    <small class="text-muted">/ {{ __('site.label.' . $value['price_unit']) }}</small>
                </span>
                <div class="mt-1">
                    <button class="btn btn-info btn-sm w-35 btnDetailPackage" data-bs-toggle="modal"
                        data-bs-target="#detail{{ $key }}Modal">
                        <i class="mdi mdi-folder-information-outline"></i>
                    </button>
                    <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
                        class="w-60 btn btn-warning btn-sm">
                        <i class="mdi mdi-cart"></i>
                        {{ __('site.label.add') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detail{{ $key }}Modal" tabindex="-1" aria-labelledby="detail{{ $key }}ModalLabel"
            aria-hidden="true">
            <div class="modal-dialog mx-4">
                <div class="modal-content">
                    <div class="modal-header px-3 py-2">
                        <h5 class="modal-title" id="detail{{ $key }}ModalLabel">
                            {{ $value['name'] }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-3">
                        <ul class="list-unstyled text-secondary mb-0">
                            <li>
                                <span class="badge bg-success fs-5 mb-3">
                                    {{ $value['addons_domains'] }} {{ __('site.label.websites') }}
                                </span>
                            </li>
                            <li>{{ $value['sub_domains'] }} {{ __('site.label.sub_domains') }}</li>
                            <li>{{ $value['disk_quota'] }} MB {{ __('site.label.disk_quota') }}</li>
                            <li>{{ $value['email_accounts'] }} {{ __('site.label.email_accounts') }}</li>
                            <li>{{ $value['databases'] }} {{ __('site.label.databases') }}</li>
                            <li>{{ $value['ftp_accounts'] }} {{ __('site.label.ftp_accounts') }}</li>
                            @if ($value['ssh_access'] == 1)
                            <li class="text-dark">
                                <i class="mdi mdi-monitor-lock"></i>
                                {{ __('site.label.ssh_access') }}
                            </li>
                            @endif
                            <li>
                                <i class="mdi mdi-lock text-success"></i>
                                Certificat SSL gratuit
                            </li>
                            <li class="fw-bold text-danger">
                                <i class="mdi mdi-lifebuoy"></i>
                                {{ __('site.wording.support_technique_24h') }}
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer p-2">
                        <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
                            class="w-100 btn btn-warning btn-sm fw-bold">
                            <i class="mdi mdi-cart"></i>
                            {{ __('site.label.add') }}
                        </a>
                    </div>
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
                    <small class="text-muted">/ {{ __('site.label.' . $value['price_unit']) }}</small>
                </span>
                <ul class="list-unstyled text-secondary mt-3 mb-4">
                    <li>
                        <span class="badge bg-success fs-5 mb-3">
                            {{ $value['addons_domains'] }} {{ __('site.label.websites') }}
                        </span>
                    </li>
                    <li>{{ $value['sub_domains'] }} {{ __('site.label.sub_domains') }}</li>
                    <li>{{ $value['disk_quota'] }} MB {{ __('site.label.disk_quota') }}</li>
                    <li>{{ $value['email_accounts'] }} {{ __('site.label.email_accounts') }}</li>
                    <li>{{ $value['databases'] }} {{ __('site.label.databases') }}</li>
                    <li>{{ $value['ftp_accounts'] }} {{ __('site.label.ftp_accounts') }}</li>
                    @if ($value['ssh_access'] == 1)
                    <li class="text-dark">
                        <i class="mdi mdi-monitor-lock"></i>
                        {{ __('site.label.ssh_access') }}
                    </li>
                    @endif
                    <li>
                        <i class="mdi mdi-lock text-success"></i>
                        {{ __('site.label.free_ssl') }}
                    </li>
                    <li class="fw-bold text-danger">
                        <i class="mdi mdi-lifebuoy"></i>
                        {{ __('site.wording.support_technique_24h') }}
                    </li>
                </ul>
                <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
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
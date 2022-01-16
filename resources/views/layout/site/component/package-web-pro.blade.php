<div class="row">
    @forelse ($packages as $key => $value)
    @if (Browser::isMobile())
    <div class="col-6 col-sm-6 col-md-4 col-xs-12 p-1">
        <div class="card mb-1 shadow border-warning service-item">
            <img class="card-img-top border-bottom" src="{{ cdn_asset('/dist/all/img/package/' . $value['photo']) }}"
                alt="{{ $value['name'] }}">
            <div class="card-body text-center bg-f0f0f0 px-2 py-1">
                <span class="card-title pricing-card-title fs-6 fw-bold">
                    <span class="text-dark">{{ $value['price'] }}</span>
                    <small class="text-dark">FCFA</small>
                    <small class="text-muted">/ {{ $value['price_unit'] }}</small>
                </span>
                <div class="mt-1">
                    <button class="btn btn-info btn-sm w-35 btnDetailPackage" data-bs-toggle="modal"
                        data-bs-target="#detail{{ $key }}Modal">
                        <i class="mdi mdi-folder-information-outline"></i>
                    </button>
                    <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
                        class="w-60 btn btn-warning btn-sm">
                        <i class="mdi mdi-cart"></i>
                        Ajouter
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
                                    {{ $value['addons_domains'] }} Site(s) Web
                                </span>
                            </li>
                            <li>{{ $value['sub_domains'] }} Sous-domaine</li>
                            <li>{{ $value['disk_quota'] }} MB d'espace disque</li>
                            <li>{{ $value['email_accounts'] }} Addresse Email</li>
                            <li>{{ $value['databases'] }} Base de donnée</li>
                            <li>{{ $value['ftp_accounts'] }} Compte FTP</li>
                            @if ($value['ssh_access'] == 1)
                            <li class="text-dark">
                                <i class="mdi mdi-monitor-lock"></i>
                                Accès distant SSH
                            </li>
                            @endif
                            <li>
                                <i class="mdi mdi-lock text-success"></i>
                                Certificat SSL gratuit
                            </li>
                            <li class="fw-bold text-danger">
                                <i class="mdi mdi-lifebuoy"></i>
                                Support Technique 24h/24
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer p-2">
                        <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
                            class="w-100 btn btn-warning btn-sm fw-bold">
                            <i class="mdi mdi-cart"></i>
                            Commander
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
                    <span class="text-dark">{{ $value['price'] }}</span>
                    <small class="text-dark fs-4">FCFA</small>
                    <small class="text-muted">/ {{ $value['price_unit'] }}</small>
                </span>
                <ul class="list-unstyled text-secondary mt-3 mb-4">
                    <li>
                        <span class="badge bg-success fs-5 mb-3">
                            {{ $value['addons_domains'] }} Site(s) Web
                        </span>
                    </li>
                    <li>{{ $value['sub_domains'] }} Sous-domaine</li>
                    <li>{{ $value['disk_quota'] }} MB d'espace disque</li>
                    <li>{{ $value['email_accounts'] }} Addresse Email</li>
                    <li>{{ $value['databases'] }} Base de donnée</li>
                    <li>{{ $value['ftp_accounts'] }} Compte FTP</li>
                    @if ($value['ssh_access'] == 1)
                    <li class="text-dark">
                        <i class="mdi mdi-monitor-lock"></i>
                        Accès distant SSH
                    </li>
                    @endif
                    <li>
                        <i class="mdi mdi-lock text-success"></i>
                        Certificat SSL gratuit
                    </li>
                    <li class="fw-bold text-danger">
                        <i class="mdi mdi-lifebuoy"></i>
                        Support Technique 24h/24
                    </li>
                </ul>
                <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'],'package' => $value['uuid'], 'detail' => $value['detail']]) }}"
                    class="w-100 btn btn-warning fw-bold">
                    <i class="mdi mdi-cart"></i>
                    Commander
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
            <span class="fs-5 fw-bold">Aucune packages disponible</span>
            <hr>
            Retour à la liste des service
            <a href="{{ route('Site-ServiceGetShow') }}" class="fw-bold">ici</a>
        </div>
    </div>
    @endforelse
</div>
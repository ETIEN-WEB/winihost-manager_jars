<div class="row">
    @forelse ($packages as $value)
    <div class="col-md-4">
        <div class="card mb-4 shadow border-warning service-item">
            <img class="card-img-top border-bottom" src="{{ cdn_asset('/dist/all/img/package/' . $value['photo']) }}"
                alt="{{ $value['name'] }}">
            <div class="card-body text-center bg-f0f0f0">
                <h1 class="card-title pricing-card-title">
                    <span class="text-dark">{{ $value['price'] }}</span>
                    <small class="text-dark fs-4">FCFA</small>
                    <small class="text-muted">/ {{ $value['price_unit'] }}</small>
                </h1>
                <ul class="list-unstyled text-secondary mt-3 mb-4">
                    <li>
                        <span class="badge bg-success fs-5 mb-3">
                            {{ $value['email_accounts'] }} Mail(s) Pro
                        </span>
                    </li>
                    <li>{{ $value['disk_quota'] }} MB d'espace disque</li>
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
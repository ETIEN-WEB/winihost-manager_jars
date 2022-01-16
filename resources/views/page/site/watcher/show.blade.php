@extends('layout.site.master')

@section('style')

<style>
    .btndisplay {
        display: inline-block;
        margin-right: 10px;
    }
</style>

@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <a href="#" class="text-danger fw-bold text-decoration-none" data-bs-toggle="modal"
            data-bs-target="#addDomainModal">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.add') }}
        </a>
    </div>
    <div class="col-6 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($watcher_list) }}
            <span class="d-none d-sm-inline">{{ __('site.label.watcher') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="alert alert-info text-center">
    <i class="mdi mdi-bell"></i>
    {{ __('site.wording.watcher_info') }}
</div>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-4">
                {{ __('site.label.name') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.created') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.update') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>

    @forelse (collect($watcher_list)->sortByDesc('created') as $watcher)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-4">
                <span class="text-primary fw-bold">
                    {{ $watcher['domain'] }}
                </span>
            </div>
            <div class="col-md-2">
                <span class="text-{{ $watcher['status'] == true ? 'success' : 'danger' }}">
                    {{ $watcher['status'] == true ? __('site.label.available') : __('site.label.unavailable') }}
                </span>
            </div>
            <div class="col-md-2">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.created') }} : </span>
                {{ Helpy::localDatetime($watcher['created'], app()->getLocale()) }}
            </div>
            <div class="col-md-2">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.update') }} : </span>
                {{ Helpy::localDatetime($watcher['updated'], app()->getLocale()) }}
            </div>
            <div class="col-md-2 text-center">
                @if ($watcher['status'] == true)
                    <a href="{{ route('Site-ServiceGetSubscribe', ['service' => $watcher['subscribe']['service']['uuid'], 'package' => $watcher['subscribe']['package']['uuid'], 'detail' => $watcher['domain']]) }}"
                        class="btn btn-warning btn-sm btndisplay text-dark" title="{{ __('site.label.cart') }}">
                        <i class="mdi mdi-cart-arrow-down"></i>
                    </a>
                    <form id="{{ $watcher['uuid'] }}"
                        action="{{ route('Site-WatcherPostDelete', ['uuid' => $watcher['uuid']]) }}" method="POST" class="btndisplay">
                        @csrf 

                        <a href="#" class="btn btn-danger btn-sm BtnDeleteNotif"
                            data-uuid="{{ $watcher['uuid'] }}"
                            title="{{ __('site.label.delete') }}">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </form>
                @else
                <form id="{{ $watcher['uuid'] }}"
                    action="{{ route('Site-WatcherPostDelete', ['uuid' => $watcher['uuid']]) }}" method="POST">
                    @csrf

                    <a href="#" class="btn btn-danger btn-sm BtnDeleteNotif"
                        data-uuid="{{ $watcher['uuid'] }}"
                        title="{{ __('site.label.delete') }}">
                        <i class="mdi mdi-delete"></i>
                    </a>
                </form>
                @endif
            </div>
        </div>
    </button>

    @empty

    <button type="button" class="list-group-item list-group-item-action">
        <div class="text-danger text-center">
            {{ __('site.wording.no_data_available') }}
        </div>
    </button>

    @endforelse
</div>


<!-- Modal -->
<div class="modal fade" id="addDomainModal" tabindex="-1" aria-labelledby="addDomainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDomainModalLabel">Domaine a surveillé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddDomain" action="{{ route('Site-WatcherPostCreate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="domain" id="InputDomain" type="text" class="form-control"
                            placeholder="Ex : nomdomaine.com ...">
                        <div id="MsgResult" class="small"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button id="BtnAddDomain" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>

<div id="DataSearchDomain" data-endpoint="https://api.winihost.com/whois-domain/check"></div>
<div id="RequestDatas"
    data-subscription="{{ route('Site-ServiceGetSubscribe', ['service' => $service_detail['uuid'], 'package' => 'package_uuid', 'action' => 'purchase', 'detail' => 'domain', 'quantity' => 1]) }}"
    data-extensions="{{ json_encode($service_detail['packages']) }}"></div>


@endsection

@section('scripts')

<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('.BtnDeleteNotif').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this));
    });
 

    // Get Whois data
    function WhoisDomain(domain, callback) {

        var formdata = new FormData();
        formdata.append("domain", domain);
        fetch(DataSearchDomain.getAttribute('data-endpoint'), {
            method: 'POST',redirect: 'follow', body: formdata
        })
        .then(response => response.text())
        .then((result) => {
            let data = JSON.parse(result);
            callback(domain, data);
        })
        .catch(error => console.log('error', error));
    }

    var BtnAddDomain = document.getElementById('BtnAddDomain');
    var InputDomain = document.getElementById('InputDomain');
    var MsgResult = document.getElementById('MsgResult');
    var RequestDatas = document.getElementById('RequestDatas');
    
    if (BtnAddDomain) {
        BtnAddDomain.addEventListener('click', (e) => {

            var domain = InputDomain.value;
            var domain_parts = domain.split(".");

            MsgResult.textContent = '';

            if (domain && domain.length >= 3 && domain_parts.length >=2) {

                MsgResult.innerHTML = `
                    <div class="progress mt-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                            role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                            style="width: 100%">
                        </div>
                    </div>
                `;
                
                WhoisDomain(domain, (domain, data) => {

                    if (data.success == true) {

                        var formAddDomain = document.getElementById('formAddDomain');
                        formAddDomain.submit();

                    } else {

                        var extensions = RequestDatas.getAttribute('data-extensions');
                        var extensions = JSON.parse(extensions);

                        domain_parts.shift();

                        extensions.map((ext) => {
                            if (ext.ext == domain_parts) {

                                var subscription = RequestDatas.getAttribute('data-subscription');
                                var subscription = subscription.replace('package_uuid', ext.uuid);
                                var subscription = subscription.replace('domain', domain);

                                MsgResult.innerHTML = `
                                    <div class="mt-2 text-success fw-bold">
                                        Le domaine est deja disponible :
                                        <a href="`+subscription+`" class="badge bg-warning text-dark p-2">ACHETER</a>
                                    </div>
                                `;
                            }
                        });

                    }
                });
            } else {

                MsgResult.style.color = "red";
                MsgResult.innerHTML = "Veuillez saisir un domaine validé.";
            }
        });
    }

</script>
@endsection
<div class="alert alert-info text-center {{ Browser::isMobile() ? 'fs-6' : 'fs-4' }}">
    Souhaitez-vous ajouter un <strong class="d-block d-sm-block d-md-inline">Autre services ?</strong>
</div>

<div class="text-center">
    <a href="{{ route('Site-ServiceGetShow', ['service' => 'scanfolder']) }}" class="btn btn-warning m-2">
        <i class="mdi mdi-plus-circle"></i>
        Services
        <hr class="m-1">
        <span class="fs-6">Ajouter un nouveau scanfolder</span>
    </a>
    <a href="{{ route('Site-CartGetShow') }}" class="btn btn-success m-2">
        <i class="mdi mdi-cart"></i>
        Mon panier
        <hr class="m-1">
        <span class="fs-6">Afficher pour effectuer le paiement</span>
    </a>
</div>

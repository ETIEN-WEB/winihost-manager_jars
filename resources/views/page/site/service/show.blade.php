@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    @forelse ($service_list as $value)
    @if (Browser::isMobile())
    <div class="col-6 col-sm-6 col-md-4 col-xs-12 p-1">
        <div class="card mb-1 shadow border-warning">
            <a href="{{ route('Site-ServiceGetDetail', ['service' => $value['slug']]) }}">
                <img class="card-img-top" src="{{ cdn_asset('/dist/all/img/service/'. $value['slug'] .'.png') }}"
                    alt="{{ $value['name'][app()->getLocale()] }}">
            </a>
            <div class="card-body px-2 py-1">
                <span class="card-title mb-0 fs-6">
                    {{ $value['name'][app()->getLocale()] }}
                </span>
            </div>
            <div class="card-footer p-1">
                <a href="{{ route('Site-ServiceGetDetail', ['service' => $value['slug']]) }}"
                    class="btn btn-secondary btn-sm w-100">
                    {{ __('site.label.show') }}
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="col-6 col-sm-6 col-md-4 col-xs-12">
        <div class="card mb-4 shadow border-warning">
            <a href="{{ route('Site-ServiceGetDetail', ['service' => $value['slug']]) }}">
                <img class="card-img-top" src="{{ cdn_asset('/dist/all/img/service/'. $value['slug'] .'.png') }}"
                    alt="{{ $value['name'][app()->getLocale()] }}">
            </a>
            <div class="card-body">
                <span class="card-title mb-0 fs-6 fw-bold">
                    {{ $value['name'][app()->getLocale()] }}
                </span>
            </div>
            <div class="card-footer">
                <a href="{{ route('Site-ServiceGetDetail', ['service' => $value['slug']]) }}"
                    class="btn btn-secondary  w-100">
                    {{ __('site.label.show_package') }}
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
            <span class="fs-5 fw-bold">Aucune service disponible</span>
            <hr>
            Retour à la page d'accueil
            <a href="{{ route('Site-HomeGetShow') }}" class="fw-bold">ici</a>
        </div>
    </div>
    @endforelse
</div>

@endsection

@section('scripts')

@endsection
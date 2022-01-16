@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Acceder au FAQ</h5>
                <a href="https://faq.winihost.com"
                    class="btn btn-outline-secondary {{ Browser::isMobile() ? 'btn-sm' : null }}" target="blank">
                    <i class="mdi mdi-vector-link"></i>
                    {{ __('site.label.to_access') }}
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Ouvrir un ticket</h5>
                <a href="{{ route('Site-TicketGetFaq') }}"
                    class="btn btn-outline-secondary {{ Browser::isMobile() ? 'btn-sm' : null }}">
                    <i class="mdi mdi-vector-link"></i>
                    {{ __('site.label.to_open') }}
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Statistiques :</h5>
                <span class="fs-4 text-success">
                    {{ session('UserSession.profil.ticket_open') }}
                    <small>{{ __('site.label.open') }}(s)</small>
                </span> /
                <span class="fs-4 text-danger">
                    {{ count($ticket_list) - session('UserSession.profil.ticket_open') }}
                    <small>{{ __('site.label.closed') }}(s)</small>
                </span>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-2">
                {{ __('site.label.code') }}
            </div>
            <div class="col-md-3">
                {{ __('site.label.object') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.type') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.priority') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.date') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.status') }}
            </div>
            <div class="col-md-1 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>
    @forelse (collect($ticket_list)->sortByDesc('created') as $value)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-2">
                <strong class="text-primary">{{ $value['code'] }}</strong>
            </div>
            <div class="col-md-3">
                <strong>{{ $value['object'] }}</strong>
            </div>
            <div class="col-md-2">
                {{ __('site.label.' . $value['type']) }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.' . $value['priority']) }}
            </div>
            <div class="col-md-2">
                {{ Helpy::localDatetime($value['created'], app()->getLocale()) }}
            </div>
            <div class="col-md-1">
                @if ($value['closed']['date'] == null)
                <h6><span class="badge bg-success">{{ __('site.label.open') }}</span></h6>
                @else
                <h6><span class="badge bg-danger">{{ __('site.label.close') }}</span></h6>
                @endif
            </div>
            <div class="col-md-1 text-center">
                <a href="{{ route('Site-TicketGetDetail', ['uuid' => $value['uuid']]) }}"
                    class="btn btn-outline-dark rounded-pill w-100 {{ Browser::isMobile() ? 'btn-sm' : null }}">
                    {{ __('site.label.show') }}
                </a>
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

@endsection

@section('scripts')

@endsection
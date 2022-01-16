@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <form id="delete-all-notif" action="{{ route('Site-NotificationPostEmpty') }}" method="POST">
            @csrf
            <a href="#" class="text-danger fw-bold text-decoration-none BtnDeleteNotifAll" data-uuid="delete-all-notif">
                <i class="mdi mdi-broom"></i>
                {{ __('site.label.delete_all') }}
            </a>
        </form>
    </div>
    <div class="col-6 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ collect($notification_list)->where('view', '=', null)->count() }} /
            {{ count($notification_list) }}
        </strong>
    </div>
</div>

<hr>

<div class="alert alert-info small text-center">
    <i class="mdi mdi-bell"></i>
    {{ __('site.wording.notification_info_clear') }}
</div>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-6">
                {{ __('site.label.object') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.received_on') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.seen_on') }}
            </div>
            <div class="col-md-2 text-center">
                {{ __('site.label.action') }}
            </div>
        </div>
    </li>

    @forelse (collect($notification_list)->sortByDesc('created') as $value)

    <button type="button"
        class="list-group-item list-group-item-action list-group-item-{{ $value['view'] == null ? 'secondary' : 'light' }}">
        <div class="row">
            <div class="col-md-6 text-truncate">
                <i class="mdi mdi-email mdi-18px text-success"></i>
                <strong>{{ $value['object'] }}</strong>
            </div>
            <div class="col-md-2 text-center">
                <span class="d-sm-block d-md-none">{{ __('site.label.received_on') }} :</span>
                {{ Helpy::localDatetime($value['created'], app()->getLocale()) }}
            </div>
            <div class="col-md-2 text-center">
                <span class="d-sm-block d-md-none">{{ __('site.label.seen_on') }} :</span>
                {{ $value['view'] ? Helpy::localDatetime($value['view'], app()->getLocale()) : '---' }}
            </div>
            <div class="col-md-2 text-center">
                <form id="{{ $value['uuid'] }}"
                    action="{{ route('Site-NotificationPostDelete', ['uuid' => $value['uuid']]) }}" method="POST">
                    @csrf
                    <a href="{{ route('Site-NotificationGetDetail', ['uuid' => $value['uuid']]) }}"
                        class="btn btn-outline-primary {{ Browser::isMobile() ? 'btn-sm' : null }} w-25"
                        title="{{ __('site.label.show') }}">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a href="#"
                        class="btn btn-outline-danger {{ Browser::isMobile() ? 'btn-sm' : null }} w-25 BtnDeleteNotif"
                        title="{{ __('site.label.delete') }}" data-uuid="{{ $value['uuid'] }}">
                        <i class="mdi mdi-delete"></i>
                    </a>
                </form>
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
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('.BtnDeleteNotif').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this));
    });
    $('.BtnDeleteNotifAll').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this), "{{ __('site.wording.do_you_want_to_delete_all') }}");
    });
</script>
@endsection
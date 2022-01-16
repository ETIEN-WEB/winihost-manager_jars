@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="d-inline">
                    <i class="mdi mdi-email"></i>
                    {{ $notification_detail['object'] }}
                </h5>
            </div>
            <div class="card-body">
                <i class="small d-block text-muted mb-3">
                    <i class="mdi mdi-calendar-clock"></i>
                    {{ Helpy::localDatetime($notification_detail['created'], app()->getLocale()) }}
                </i>
                {!! $notification_detail['body'] !!}
            </div>
            <div class="card-footer text-center">
                <div class="row">
                    <div class="col-6 text-end">
                        <a href="{{ route('Site-NotificationGetShow') }}" class="btn btn-secondary">
                            <i class="mdi mdi-chevron-left"></i>
                            {{ __('site.label.return') }}
                        </a>
                    </div>
                    <div class="col-6 text-start">
                        <form id="{{ $notification_detail['uuid'] }}"
                            action="{{ route('Site-NotificationPostDelete', ['uuid' => $notification_detail['uuid']]) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger BtnDeleteNotif"
                                data-uuid="{{ $notification_detail['uuid'] }}">
                                <i class="mdi mdi-delete"></i>
                                {{ __('site.label.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('.BtnDeleteNotif').click(function (e) { 
        e.preventDefault();
        AlertDeleteItem($(this));
    });
</script>
@endsection
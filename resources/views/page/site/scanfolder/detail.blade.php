@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <h2 class="mb-3">
            <i class="mdi mdi-folder-search-outline"></i>
            {{ $scanfolder_item_detail['name'] }}
        </h2>
    </div>
    <div class="col-4 text-end">
        <a href="{{ route('Site-ScanfolderGetShow') }}" class="badge bg-danger text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
        </a>
    </div>
</div>

<div class="row">

    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary">
                <h5 class="card-title text-white my-2">
                    {{ __('site.label.setting') }} FTP
                </h5>
            </div>
            <div class="card-body">

                {{ __('site.label.host') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $scanfolder_item_detail['params']['host'] }}
                </li>
                <br>

                {{ __('site.label.username') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $scanfolder_item_detail['params']['username'] }}
                </li>
                <br>

                {{ __('site.label.port') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $scanfolder_item_detail['params']['port'] }}
                </li>
                <br>

                {{ __('site.label.path') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $scanfolder_item_detail['params']['root'] }}
                </li>
                <br>

                {{ __('site.label.except') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ isset($scanfolder_item_detail['params']['excepts']) ? implode(', ', $scanfolder_item_detail['params']['excepts']) : '-' }}
                </li>
            </div>
            <div class="card-footer text-center">
                <form id="{{ $scanfolder_item_detail['uuid'] }}"
                    action="#"
                    method="POST">
                    @csrf
                    <a href="#" data-uuid="{{ $scanfolder_item_detail['uuid'] }}"
                        class="btn btn-outline-danger rounded-pill {{ Browser::isMobile() ? 'btn-sm' : null }}"
                        id="BtnDeleteScanfolder">
                        {{ __('site.label.delete') }}
                    </a>
                    <a href="{{ route('Site-ScanfolderGetEdite', $scanfolder_item_detail['uuid']) }}"
                        class="btn btn-outline-primary rounded-pill {{ Browser::isMobile() ? 'btn-sm' : null }}">
                        {{ __('site.label.edit') }}
                    </a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary">
                <h5 class="card-title text-white my-2">
                    Info
                </h5>
            </div>
            <div class="card-body">

                {{ __('site.label.failure') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $scanfolder_item_detail['failure'] }}
                </li>
                <br>

                {{ __('site.label.message') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ $scanfolder_item_detail['msg'] ?? '-' }}
                </li>
                <br>

                {{ __('site.label.status') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    <span class="badge {{ $scanfolder_item_detail['status'] == true ? 'bg-success' : 'bg-danger' }}">
                        {{ $scanfolder_item_detail['status'] == true ? __('site.label.active') : __('site.label.inactive') }}
                    </span>
                </li>
                <br>

                {{ __('site.label.created') }}
                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold">
                    {{ Helpy::localDatetime($scanfolder_item_detail['created'], app()->getLocale()) }}
                </li>
                <br>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary">
                <h5 class="card-title text-white my-2">
                    {{ __('site.wording.file_and_folder') }}
                </h5>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($scanfolder_item_detail['files'] as $file => $signature)
                    <li class="list-unstyled">
                        @if (empty($signature))
                        <i class="mdi mdi-folder-open-outline mdi-18px text-danger"></i>
                        @else
                        <i class="mdi mdi-file-check-outline mdi-18px text-primary"></i>
                        @endif
                        <strong>{{ $file }}</strong>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('#BtnDeleteScanfolder').click(function (e) {
        e.preventDefault();
        AlertDeleteItem($(this));
    });
</script>
@endsection

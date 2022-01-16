@extends('layout.site.master')

@section('style')
<link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/toastr/toastr.min.css') }}" type="text/css" />
<style>
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        50% {
            transform: rotate(360deg);
        }

        100% {
            transform: rotate(720deg);
        }
    }

    .spinner {
        border: 5px solid transparent;
        border-top: 5px solid blue;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        animation-name: spin;
        animation-duration: 2s;
        animation-timing-function: ease;
        animation-iteration-count: infinite;
    }

    .loader {
        display: flex;
        justify-content: center;
        padding: 15px;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <a href="{{ route('Site-ScanfolderGetCreteItem', ['uuid' => $scanfolder_detail['uuid']]) }}"
            class="text-danger fw-bold text-decoration-none">
            <i class="mdi mdi-plus-box-multiple"></i>
            {{ __('site.label.add') }}
        </a>
    </div>
    <div class="col-6 text-end">
        {{ __('site.label.total') }} :
        <strong>
            {{ count($scanfolder_detail['items'])}}
            <span class="d-none d-sm-inline">{{ __('site.label.scanfolder') }}(s)</span>
        </strong>
    </div>
</div>

<hr>

<div class="alert alert-info text-center">
    <i class="mdi mdi-bell"></i>
    {{ __('site.wording.scanfolder_info') }}
</div>

<div class="list-group">

    <li class="list-group-item active d-none d-sm-none d-md-block" aria-current="true">
        <div class="row">
            <div class="col-md-2">
                {{ __('site.label.name') }}
            </div>
            <div class="col-md-2">
                {{ __('site.label.path') }}
            </div>
            <div class="col-md-1">
                {{ __('site.label.failure') }}
            </div>
            <div class="col-md-1">
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

    @forelse (collect($scanfolder_detail['items'])->sortByDesc('created') as $scanfolder)

    <button type="button" class="list-group-item list-group-item-action list-group-item-light">
        <div class="row">
            <div class="col-md-2">
                <span class="text-primary fw-bold">
                    {{ $scanfolder['name'] }}
                </span>
            </div>
            <div class="col-md-2">
                <span class="">
                    {{ $scanfolder['params']['root'] }}
                </span>
            </div>
            <div class="col-md-1">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.failure') }} : </span>
                {{ $scanfolder['failure'] }}
            </div>
            <div class="col-md-1">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.status') }} : </span>
                <span class="badge {{ $scanfolder['status'] == true ? 'bg-success' : 'bg-danger' }}">
                    {{ $scanfolder['status'] == true ? __('site.label.active') : __('site.label.inactive') }}
                </span>
            </div>
            <div class="col-md-2">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.created') }} : </span>
                {{ Helpy::localDatetime($scanfolder['created'], app()->getLocale()) }}
            </div>
            <div class="col-md-2">
                <span class="d-inline d-sm-inline d-md-none">{{ __('site.label.update') }} : </span>
                {{ Helpy::localDatetime($scanfolder['updated'], app()->getLocale()) }}
            </div>
            <div class="col-md-2" style="display: flex; justify-content: space-evenly">
                <span class="btn btn-outline-dark {{ Browser::isMobile() ? 'btn-sm' : null }} show"
                    data-element="{{ $scanfolder['uuid'] }}" title="{{ __('site.label.show') }}" data-toggle="modal"
                    data-target="#showModal">
                    <i class="mdi mdi-eye"></i>
                </span>
                <span class="btn btn-outline-info {{ Browser::isMobile() ? 'btn-sm' : null }} edit"
                    data-element="{{ $scanfolder['uuid'] }}"
                    data-url="{{ route('Site-ScanfolderPostEdite', $scanfolder['uuid']) }}"
                    title="{{ __('site.label.edit') }}">
                    <i class="mdi mdi-pencil-outline"></i>
                </span>

                <form id="{{ $scanfolder['uuid'] }}"
                    action="{{ route('Site-ScanfolderPostDelete', [ $scanfolder_detail['uuid'], $scanfolder['uuid']]) }}"
                    method="POST">
                    @csrf
                    <span class="btn btn-outline-danger {{ Browser::isMobile() ? 'btn-sm' : null }} delete"
                        data-uuid="{{ $scanfolder['uuid'] }}" data-element="{{ $scanfolder['uuid'] }}"
                        title="{{ __('site.label.delete') }}">
                        <i class="mdi mdi-delete"></i>
                    </span>
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

<!-- Show Modal-->
<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ __('site.label.scanfolder_show_detail_title') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="showBody">
                <div class="row loader">
                    <div class="spinner"></div>
                </div>
                <div class="row" id="showContent">
                    <div class="col-lg-4">
                        <div class="card shadow mb-3">
                            <div class="card-header bg-secondary">
                                <h5 class="card-title text-white my-2">
                                    {{ __('site.label.setting') }} FTP
                                </h5>
                            </div>
                            <div class="card-body">

                                {{ __('site.label.host') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_host"></li>
                                <br>
                                {{ __('site.label.username') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_username"></li>
                                <br>

                                {{ __('site.label.port') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_port"></li>
                                <br>

                                {{ __('site.label.path') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_root"></li>
                                <br>

                                {{ __('site.label.except') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_excepts"></li>
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
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_failure"></li>
                                <br>

                                {{ __('site.label.message') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_message"></li>
                                <br>

                                {{ __('site.label.status') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_status">

                                </li>
                                <br>

                                {{ __('site.label.created') }}
                                <li class="padding-liste list-group-item list-group-item-secondary rounded fw-bold"
                                    id="show_created">
                                    {{-- {{ Helpy::localDatetime($scanfolder_item_detail['created'], app()->getLocale())
                                    }}--}}
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
                                <ul id="show_content">

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.label.close')
                    }}</button>
            </div>
        </div>
    </div>
</div>
<!-- // Show Modal-->

<!-- Edit Modal-->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ __('site.label.scanfolder_edit_detail_title') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editBody">
                <div class="row loader">
                    <div class="spinner"></div>
                </div>
                <div class="row" id="editContent">
                    <form id="editForm" method="POST" class="row" action="">
                        @csrf
                        <input type="text" id="scanfolder" name="scanfolder" value="" style="display: none">
                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="name">{{ __('site.label.name') }}</label>
                            <input type="text" id="name" name="name" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.name') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="host">Ftp : {{ __('site.label.host') }}</label>
                            <input type="text" id="host" name="host" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.host') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="user">Ftp : {{ __('site.label.username') }}</label>
                            <input type="text" id="user" name="user" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.username') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="password">Ftp : {{ __('site.label.password') }}</label>
                            <input type="password" id="password" name="password" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.password') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="port">Ftp : {{ __('site.label.port') }}</label>
                            <input type="number" min="0" id="port" name="port" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.port') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="root">Ftp {{ __('site.label.path') }}</label>
                            <input type="text" id="root" name="root" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.path') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="excepts">{{ __('site.label.except') }}</label>
                            <input type="text" id="excepts" name="excepts" value="" class="form-control mb-2"
                                placeholder="{{ __('site.input.placeholder.except') }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="status">{{ __('site.label.status') }}</label>
                            <select class="form-control mb-2" name="status" id="status">
                                {{-- <option {{ $scanfolder_item_detail['status']==true ? 'selected' : null }}
                                    value="1">--}}
                                    {{-- {{ __('site.label.active') }}</option>--}}
                                {{-- <option {{ $scanfolder_item_detail['status']==false ? 'selected' : null }}
                                    value="0">--}}
                                    {{-- {{ __('site.label.inactive') }}</option>--}}
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-danger">
                                <i class="mdi mdi-chevron-left"></i>
                                {{ __('site.label.cancel') }}
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary" id="editBtnSubmit">
                                <i class="mdi mdi-check"></i>
                                {{ __('site.label.validate') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- // Edit Modal-->
@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/toastr/toastr.min.js') }}"></script>
<script src="{{ cdn_asset('/dist/all/js/toastr/toastr.options.js') }}"></script>
<script src="{{ cdn_asset('/dist/all/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    // Show detail
        $('.show').click(function (e) {
            e.preventDefault();
            let _item = $(this).data('element');
            $('#showModal').modal('show');
            $('#showContent').hide();
            $('.loader').show();
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            })
            $.ajax({
                type: "POST",
                url: "{{ route("Site-ScanfolderGetDetailItem") }}",
                dataType: "JSON",
                data: {'uuid': _item},
                success: function (result) {
                    if (result.success && result.success === true){
                        $('#showContent').show();
                        $('.loader').hide();
                        let scanfolder = result.data.scanfolder_item_detail;
                        $('#show_host').text(scanfolder.params.host);
                        $('#show_username').text(scanfolder.params.username);
                        $('#show_port').text(scanfolder.params.port);
                        $('#show_root').text(scanfolder.params.root);
                        $('#show_excepts').text(scanfolder.params.excepts.join());

                        $('#show_failure').text(scanfolder.failure);
                        $('#show_message').text(scanfolder.msg);
                        $('#show_status').html(`
                        <span class="badge ${ scanfolder.status === true ? 'bg-success' : 'bg-danger' }">
                                            ${ scanfolder.status == true ? "{{ __('site.label.active') }}" : "{{ __('site.label.inactive') }}" }
                        </span>
                        `);
                        $('#show_created').text(scanfolder.created);
                        if (scanfolder.files.length > 0){
                            $.each(scanfolder.files, function (i, el) {
                                $('#show_content').append(`
                                <li class="list-unstyled">
                                    <i class=" ${el && el !== '' ? 'mdi mdi-folder-open-outline mdi-18px text-danger' : 'mdi mdi-file-check-outline mdi-18px text-primary' } "></i>
                                <strong>${i}</strong>
                                </li>
                                `)
                            });
                        }
                    }
                },
            });
        })

        // Show detail
        $('.edit').click(function (e) {
            e.preventDefault();
            let _item = $(this).data('element');
            let _url = $(this).data('url');
            $('#editModal').modal('show');
            $('#editContent').hide();
            $('.loader').show();
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            })
            $.ajax({
                type: "POST",
                url: "{{ route("Site-ScanfolderGetDetailItem") }}",
                dataType: "JSON",
                data: {'uuid': _item},
                success: function (result) {
                    if (result.success && result.success === true){
                        $('#editContent').show();
                        $('.loader').hide();
                        let scanfolder = result.data.scanfolder_item_detail;
                        $('#editForm').attr('action', _url);
                        $('#name').val(scanfolder.name);
                        $('#scanfolder').val(scanfolder.scanfolder.uuid);
                        $('#host').val(scanfolder.params.host);
                        $('#user').val(scanfolder.params.username);
                        $('#port').val(scanfolder.params.port);
                        $('#root').val(scanfolder.params.root);
                        $('#excepts').val(scanfolder.params.excepts.join());
                        $('#status').html(`
                        <option ${ scanfolder.status === true ? 'selected' : null } value="1">
                                        {{ __('site.label.active') }}
                        </option>
                        <option ${ scanfolder.status === false ? 'selected' : null } value="0">
                                        {{ __('site.label.inactive') }}
                        </option>
                        `);
                    }
                },
            });
        });

        $('#editForm').submit(function (e) {
            e.preventDefault();
            $('#editBtnSubmit').html(`
                <span class='spinner-border spinner-border-sm mr-2' role='status' aria-hidden='true'></span> {{ __('site.wording.loading') }}
            `).attr('disabled', true);
            var form = $('#editForm')[0];
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            })
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                dataType: "JSON",
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result.success);
                    $('#editBtnSubmit').html(`
                    <i class="mdi mdi-check"></i>
                                    {{ __('site.label.validate') }}
                    `).attr('disabled', false);
                    if (result.success && result.success === true ){
                        toastr.success( "{{ __('site.flasher.success_scanfolder_edite') }}",'Succè !');
                        location.reload();
                    }
                    if(result.success === false ){
                        console.log(result.errors.msg);
                        toastr.error( result.errors.msg ,'Error !');
                    }
                },
            });
        });
    //    Suppression
        $('.delete').click(function (e) {
            e.preventDefault();
            AlertDeleteItem($(this));
        });
</script>
@endsection

@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <i class="mdi mdi mdi-information-variant"></i>
                <strong>{{ __('site.label.ticket_information') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td class="fw-bold">{{ __('site.label.code') }}</td>
                        <td>: {{ $ticket_detail['code'] }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('site.label.type') }}</td>
                        <td>:
                            <span
                                class="badge bg-{{ $ticket_detail['type'] == 'other' ? 'success' : ($ticket_detail['type'] == 'technical' ? 'warning text-dark' : ($ticket_detail['type'] == 'commercial' ? 'danger' : null)) }}">
                                {{ __('site.label.' . $ticket_detail['type']) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('site.label.priority') }}</td>
                        <td>: {{ __('site.label.' . $ticket_detail['priority']) }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('site.label.date') }}</td>
                        <td>: {{ Helpy::localDatetime($ticket_detail['created'], app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('site.label.status') }}</td>
                        <td>
                            : {{ __('site.label.' . ($ticket_detail['closed']['date'] == null ? 'open' : 'close')) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @if ($ticket_detail['closed']['date'])
        <div class="card shadow mb-3">
            <div class="card-header bg-secondary text-white fw-bold">
                {{ __('site.label.comment') }}
            </div>
            <div class="card-body">
                {{ __('site.label.on') }} :
                <strong>{{ $ticket_detail['closed']['date'] ? Helpy::localDatetime($ticket_detail['closed']['date'], app()->getLocale()) : '-' }}</strong>
                <br>
                {{ __('site.label.by') }} :
                <strong>{{ $ticket_detail['closed']['name'] ?? '-' }}</strong>
                <hr>
                <div class="text-center">
                    @for ($i = 1; $i <= 10; $i++) <i
                        class='mdi {{ $i <= intval($ticket_detail['rate']['star']) ? 'mdi-star text-warning' : 'mdi-star-outline text-secondary' }}'
                        style="{{ Browser::isMobile() ? 'font-size: 22px' : 'font-size: 33px' }}"></i>
                        @endfor
                </div>
                <p>
                    {{ $ticket_detail['rate']['msg'] }}
                </p>
            </div>
        </div>
        @else

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm d-block mx-auto mb-3" data-bs-toggle="modal"
            data-bs-target="#closeTicketModal">
            <i class="mdi mdi-lock"></i>
            {{ __('site.label.ticket_close') }}
        </button>

        <!-- closeTicketModal -->
        <div class="modal fade" id="closeTicketModal" tabindex="-1" aria-labelledby="closeTicketModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="closeTicketModalLabel">
                            <i class="mdi mdi-lock"></i>
                            {{ __('site.label.ticket_close') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="closeTicketForm"
                            action="{{ route('Site-TicketPostClose', ['uuid' => $ticket_detail['uuid']]) }}"
                            method="POST">

                            @csrf

                            <div id="starRating" class="text-center"></div>

                            <div class="text-center">
                                <i class="text-danger small d-none" id="closeTicketError">
                                    {{ __('site.wording.ticket_rating_please') }}
                                </i>
                            </div>

                            <input type="hidden" name="rate_star" id="closeTicketRate">

                            <br>

                            <textarea name="rate_message" rows="5" class="form-control" minlength="3"
                                placeholder="{{ __('site.input.placeholder.message') }}"></textarea>

                            <hr>
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                                    <i class="mdi mdi-close"></i>
                                    {{ __('site.label.cancel') }}
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" id="closeTicketBtn">
                                    <i class="mdi mdi-check-circle"></i>
                                    {{ __('site.label.close') }}
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        @endif

    </div>

    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                {{ __('site.label.object') }} :
                <strong>{{ $ticket_detail['object'] }}</strong>
            </div>
            <div class="card-body">

                @if ($ticket_detail['team']['name'])
                <h5 class="text-primary">
                    <i class="mdi mdi-account-circle-outline"></i>
                    {{ $ticket_detail['team']['name'] }}
                </h5>
                @endif
                @foreach ($ticket_message as $msg)
                @if ($msg['sender'] == 'client')
                <div class="row">
                    <div class="col-md-11">
                        <div class="alert alert-dark">
                            {!! str_replace("\n", '<br>', $msg['msg']) !!}
                            <div class="text-end small text-muted">
                                @if ($msg['file'])
                                <a href="{{ $msg['file'] }}" class="text-primary fw-bold" target="blank">
                                    <i class="mdi mdi-paperclip"></i>
                                    {{ __('site.label.attached_file') }}
                                </a> |
                                @endif
                                <i class="small">{{ Helpy::localDatetime($msg['created'], app()->getLocale()) }}</i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <img src="{{ $msg['profil']['photo'] }}"
                            class="img-fluid rounded-circle img-thumbnail d-none d-md-block">
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{ $msg['profil']['photo'] }}"
                            class="img-fluid rounded-circle img-thumbnail d-none d-md-block">
                    </div>
                    <div class="col-md-11">
                        <div class="alert alert-primary text-dark" style="">
                            {!! str_replace("\n", '<br>', $msg['msg']) !!}
                            <div class="text-start small text-muted">
                                @if ($msg['file'])
                                <a href="{{ $msg['file'] }}" class="text-primary fw-bold" target="blank">
                                    <i class="mdi mdi-paperclip"></i>
                                    {{ __('site.label.attached_file') }}
                                </a> |
                                @endif
                                <i class="small">{{ Helpy::localDatetime($msg['created'], app()->getLocale()) }}</i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

                @if (!$ticket_detail['closed']['date'])
                <form action="{{ route('Site-TicketPostMessage', ['uuid' => $ticket_detail['uuid']]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <textarea id="ticketMsgTextarea" name="msg" class="form-control mb-2 overflow-hidden"
                                rows="7" required>{{ old('msg') }}</textarea>
                            <i class="text-danger small">{{ $errors->first('msg') }}</i>
                        </div>
                        <div class="col-md-8">
                            <input name="file" type="file" class="form-control form-control-sm mb-3">
                            <i class="text-danger small">{{ $errors->first('file') }}</i>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                <i class="mdi mdi-check-circle"></i>
                                {{ __('site.label.send') }}
                            </button>
                        </div>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ cdn_asset('/dist/all/js/rating/rating.min.js') }}"></script>
<script>
    $('#ticketMsgTextarea').keyup(function (e) { 
        var height = $(this).prop('scrollHeight');
        $(this).css('height', height > 185 ? height : 185);
    });
    
    $("#starRating").rating({
        "stars": 10,
        "value": 5,
        "emptyStar":"mdi mdi-star-outline fs-1 pointer",
        "halfStar":"mdi mdi-star-half fs-1 pointer",
        "filledStar":"mdi mdi-star fs-1 pointer",
        "click":function (e) {
            $('#closeTicketRate').val(e.stars);
            $('#closeTicketError').addClass('d-none');
        }
    });
    $('#closeTicketBtn').click(function (e) { 
        e.preventDefault();
        var star = $('#closeTicketRate').val();
        if (star) {
            $('#closeTicketForm').submit();
        } else {
            $('#closeTicketError').removeClass('d-none');
        }
    });
</script>
@endsection
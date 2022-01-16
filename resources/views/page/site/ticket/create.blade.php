@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-2">
        <div class="card shadow mb-3">
            <div class="card-header bg-primary">
                <h5 class="my-2 text-white">
                    {{ __('site.label.ticket_create') }}
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="object">{{ __('site.label.object') }}</label>
                        <input id="object" name="object" type="text" class="form-control" value="{{ old('object') }}"
                            placeholder="..." required>
                        <i class="text-danger small">{{ $errors->first('object') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="type">{{ __('site.label.type') }}</label>
                        <select name="type" id="type" class="form-control" required>
                            @foreach ($ticket_type as $type)
                            <option value="{{ $type['name'] }}">{{ __('site.label.' . $type['name']) }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger small">{{ $errors->first('type') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="priority">{{ __('site.label.priority') }}</label>
                        <select name="priority" id="priority" class="form-control" required>
                            @foreach ($ticket_priority as $priority)
                            <option value="{{ $priority['name'] }}">{{ __('site.label.' . $priority['name']) }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger small">{{ $errors->first('priority') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="file">{{ __('site.label.file') }}</label>
                        <input id="file" name="file" type="file" class="form-control">
                        <i class="text-danger small">{{ $errors->first('file') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="ticketMsgTextarea">{{ __('site.label.message') }}</label>
                        <textarea name="msg" id="ticketMsgTextarea" rows="10" class="form-control overflow-hidden"
                            placeholder="{{ __('site.input.placeholder.message') }}"
                            required>{{ old('msg') }}</textarea>
                        <i class="text-danger small">{{ $errors->first('msg') }}</i>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-50">
                            {{ __('site.label.send') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <h4 class="text-decoration">
            <u>{{ __('site.label.ticket_type') }}</u>
        </h4>
        @foreach ($ticket_type as $key => $type)
        <span
            class="badge bg-{{ $key == 0 ? 'success' : ($key == 1 ? 'warning text-dark' : ($key == 2 ? 'danger' : null)) }} d-block">
            {{ __('site.label.' . $type['name']) }}
        </span>
        <p>
            {{ __('site.wording.ticket_type_' . $type['name']) }}
        </p>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('#ticketMsgTextarea').keyup(function (e) { 
        var height = $(this).prop('scrollHeight');
        $(this).css('height', height > 185 ? height : 185);
    });
</script>
@endsection
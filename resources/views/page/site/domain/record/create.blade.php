@extends('layout.site.master')

@section('style')

@endsection

@section('content')

@include('layout.site.component.domain-detail-header')

<div class="row">

    <div class="col-md-6 offset-md-3">
        <div class="card border shadow mb-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title text-white my-2 d-inline">
                    {{ __('site.wording.add_dns_record') }}
                </h5>
            </div>
            <div class="card-body">

                <form method="POST" class="row">

                    @csrf

                    <div class="form-group col-md-4">
                        <label class="fw-bold" for="type">Type</label>
                        <select name="type" id="selectType" class="form-control mb-2" required>
                            @foreach ($record_type as $value)
                            <option value="{{ $value['type'] }}">{{ $value['type'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="fw-bold" for="proxied">Certificat SSL</label>
                        <select name="proxied" id="proxied" class="form-control mb-2" required>
                            <option value="true">Activer</option>
                            <option value="false">Désactiver</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="fw-bold" for="priority">Priority</label>
                        <input type="text" id="priority" name="priority" value="{{ old('priority') }}"
                            class="form-control mb-2" placeholder="Ex : 10 ..." required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="name">Name</label>
                        <input type="text" name="name" class="form-control mb-2" value="{{ old('name') }}"
                            placeholder="Ex : mydomain.com" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="fw-bold" for="content">Content</label>
                        <textarea name="content" rows="8" class="form-control mb-3" placeholder="Ex : 192.168.1.1"
                            required>{{ old('content') }}</textarea>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('Site-DomainGetDetail', ['uuid' => $domain_detail['uuid']]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="mdi mdi-chevron-left"></i>
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-check"></i>
                            Valider
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script>
    var types = JSON.parse('@json($record_type)');

    function handlerType(types) {
        var type = document.getElementById('selectType').value;
        types.map((item, key) => {
            if (type == item.type) {
                var priority = document.getElementById('priority')
                priority.disabled = (item.priority == true) ? false : true;
                priority.parentNode.style.display = (item.priority == true) ? 'inline' : 'none';

                var proxied = document.getElementById('proxied')
                proxied.disabled = (item.proxiable == true) ? false : true;
                proxied.parentNode.style.display = (item.proxiable == true) ? 'inline' : 'none';
            }
        });
    }

    handlerType(types);

    var selectType = document.getElementById('selectType').addEventListener('click', (e) => {
        e.preventDefault();
        handlerType(types)
    });
</script>

@endsection
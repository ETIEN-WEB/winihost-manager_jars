@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="alert alert-info text-center">
    {!! __('site.wording.faq_page_description') !!}
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <select id="selectCategory" class="form-control form-control-lg mb-2 shadow border border-secondary">
            <option value="x">--- {{ __('site.input.placeholder.select_category') }} ---</option>
            @foreach (collect($faq_response_list)->unique('category') as $response)
            @if (!empty($response['category']))
            <option value="{{ $response['category']['uuid'] }}">{{ $response['category']['title'] }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select id="selectSubategory"
            class="form-control form-control-lg d-none mb-2 shadow border border-secondary"></select>
    </div>
    <div class="col-md-8 offset-md-2 py-3">
        <div id="listResponse" class="d-none">

            @foreach (collect($faq_response_list)->unique('uuid') as $response)
            <a href="#" class="itemResponse d-block fw-bold fw-bold my-3" data-file="{{ $response['file'] }}"
                data-subcategory="{{ $response['subcategory']['uuid'] }}" data-bs-toggle="modal"
                data-bs-target="#responseModal">
                <i class="mdi mdi-lightbulb-on-outline text-danger"></i>
                {{ $response['title'] }}
            </a>
            @endforeach

            <div class="text-center mt-5">
                <a href="{{ route('Site-TicketGetCreate') }}" class="btn btn-primary">
                    {{ __('site.wording.no_find_my_answer') }}
                </a>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="responseModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var datas = JSON.parse('@json($faq_response_list)');

    selectCategory = document.getElementById('selectCategory');
    selectSubategory = document.getElementById('selectSubategory');
    listResponse = document.getElementById('listResponse');

    function setSelectSubCategory() {
        var uuid = selectCategory.value;
        if (uuid !== 'x') {
            var subcategory_list = [];
            selectCategory.parentNode.classList.remove('col-md-8');
            selectCategory.parentNode.classList.add('col-md-4');
            selectSubategory.classList.remove("d-none");
            listResponse.classList.add("d-none");
            selectSubategory.innerHTML =  '<option value="x">--- {{ __("site.input.placeholder.select_subcategory") }} ---</option>';
            datas.map((response, key) => {
                if (response.category.uuid == uuid && typeof response.subcategory.uuid != 'undefined' && typeof subcategory_list[response.subcategory.uuid] == 'undefined') {
                    subcategory_list[response.subcategory.uuid] = response.subcategory.title;
                    options = selectSubategory.innerHTML;
                    selectSubategory.innerHTML = options + '<option value="'+response.subcategory.uuid+'">'+response.subcategory.title+'</option>'
                }
            });
        } else {
            selectSubategory.classList.add("d-none");
            listResponse.classList.add("d-none");
            selectCategory.parentNode.classList.remove('col-md-4');
            selectCategory.parentNode.classList.add('col-md-8');
        }
    }

    function setListResponse() {
        var uuid = selectSubategory.value;
        if (uuid !== 'x') {
            listResponse.classList.remove("d-none");
            var itemResponse = document.getElementsByClassName('itemResponse');
            for (var i = 0; i < itemResponse.length; i++) {
                var subcategory = itemResponse[i].getAttribute('data-subcategory');
                if (subcategory == uuid) {
                    itemResponse[i].classList.remove('d-none');
                    itemResponse[i].classList.add('d-block');
                } else {
                    itemResponse[i].classList.remove('d-block');
                    itemResponse[i].classList.add('d-none');
                }
            }
        } else {
            listResponse.classList.add("d-none");
        }
    }

    // Set Subcategory items
    selectCategory.addEventListener('change', (e) => {
        setSelectSubCategory();
    });

    selectSubategory.addEventListener('change', (e) => {
        setListResponse();
    });

    var responses = document.getElementsByClassName('itemResponse');
    for (var i = 0; i < responses.length; i++) {
        var response = responses[i];
        response.addEventListener('click', (e) => {
            var title = e.srcElement.innerHTML;
            document.getElementById('responseModalLabel').innerHTML = title;
            document.getElementById('responseModalBody').innerHTML = '<i class="mdi mdi-spin mdi-access-point mdi-48px text-secondary"></i>'
            var file = e.srcElement.getAttribute('data-file');

            $.get("{{ route('Site-TicketGetAjax') }}", {code : 1001,data : file},
                (data, textStatus, jqXHR) => {
                    document.getElementById('responseModalBody').innerHTML = data;    
                }
            );
        });
    }
</script>
@endsection
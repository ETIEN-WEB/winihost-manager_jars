<div class="bg-033d8a">
    <div class="container py-3 text-white">
        <div class="row">
            <div class="col-md-6 align-self-center text-center fw-bold">
                © 2015 - {{ date('Y') }} :
                <a href="{{ session('UserSession.app_info.url') }}" class="text-white" target="blank">
                    {{ session('UserSession.app_info.name') }}
                </a>
            </div>
            <div class="col-md-6 text-center">
                @foreach (session('UserSession.app_info.social_network') as $name => $value)
                @if (!empty($value['url']))
                <a href="{{ $value['url'] }}" title="{{ $name }}" class="badge rounded-pill bg-white mx-1 my-1 p-2"
                    target="blank">
                    <img src="{{ $value['img'] }}" alt="{{ $name }}" width="22" height="22" title="{{ $name }}"
                        loading="lazy">
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
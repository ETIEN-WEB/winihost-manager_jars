@if (isset($breadcrumb) && !empty($breadcrumb) && is_array($breadcrumb))
<div class="alert alert-secondary fs-6 my-4 py-2" role="alert">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            @foreach ($breadcrumb as $key => $link)
            @if (!$loop->last)
            <li class="breadcrumb-item fw-bold">
                <a href="{{ $link }}">{{ $key }}</a>
            </li>
            @else
            <li class="breadcrumb-item active" aria-current="page">
                {{ $key }}
            </li>
            @endif
            @endforeach
        </ol>
    </nav>
    <div style=" position: absolute; right: 5px; top: 3px;">
        <a href="{{ config('myconfig.API_URL_SCHEMA') . config('myconfig.APP_BASE_URL') . '/ambassador' }}"
            class="btn btn-danger btn-sm fw-bold fs-6 {{ Browser::isMobile() ? 'rounded-circle' : null }} shadow border"
            target="_blank">
            <i class="mdi mdi-cash"></i>
            @if (Browser::isDesktop())
            {{__('site.wording.become_ambassador') }}
            @endif
        </a>
        <a href="{{ route('Site-ServiceGetShow') }}"
            class="btn btn-warning btn-sm fw-bold fs-6 {{ Browser::isMobile() ? 'rounded-circle' : null }} shadow border">
            <i class="mdi mdi-plus"></i>
            {{ Browser::isMobile() ? null : __('site.label.our_services') }}
        </a>
    </div>
</div>
@endif
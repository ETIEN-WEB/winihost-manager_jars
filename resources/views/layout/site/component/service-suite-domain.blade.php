<div class="alert alert-info text-center {{ Browser::isMobile() ? 'fs-6' : 'fs-4' }}">
    {!! __('site.wording.you_like_add_new_hosting') !!}
</div>

<div class="text-center">
    <a href="{{ route('Site-ServiceGetDetail', ['service' => 'web-perso']) }}" class="btn btn-warning m-2">
        <i class="mdi mdi-plus-circle"></i>
        {{ __('site.label.com_digitale') }}
        <hr class="m-1">
        <span class="fs-6">{{ __('site.wording.add_new_hosting') }}</span>
    </a>
    <a href="{{ route('Site-CartGetShow') }}" class="btn btn-success m-2">
        <i class="mdi mdi-cart"></i>
        {{ __('site.label.cart') }}
        <hr class="m-1">
        <span class="fs-6">{{ __('site.wording.show_to_make_payment') }}</span>
    </a>
</div>
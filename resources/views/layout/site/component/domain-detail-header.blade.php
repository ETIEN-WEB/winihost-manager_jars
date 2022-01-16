<div class="row">
    <div class="col-8">
        <h2 class="mb-3 text-truncate">
            <i class="mdi mdi-earth"></i>
            {{ $domain_detail['domain'] }}
            <a href="https://{{ $domain_detail['domain'] }}" class="text-primary mdi mdi-open-in-new fs-6"
                target="blank"></a>
        </h2>
    </div>
    <div class="col-4 text-end">
        <a href="{{ route('Site-DomainGetShow') }}" class="badge bg-danger text-decoration-none">
            <i class="mdi mdi-chevron-left"></i>
            {{ __('site.label.return') }}
        </a>
    </div>
</div>

@if ($domain_detail['status'] != 'active')
<div class="alert alert-danger">
    <i class="mdi mdi-dns"></i>
    {!! __('site.wording.proceed_change_dns') !!}
</div>
@endif

@if (session('UserSession.domain.hosting') > now())
<div class="alert alert-info">
    <i class="mdi mdi-dns"></i>
    {{ __('site.wording.record_operation') }}
</div>
@endif

<hr class="mt-0">
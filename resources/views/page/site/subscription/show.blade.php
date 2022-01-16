@extends('layout.site.master')

@section('style')

@endsection

@section('content')

<div class="row">

    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <a href="{{ route('Site-HostingGetShow') }}" class="mdi mdi-server-network mdi-48px text-secondary"></a>
            </div>
            <div class="card-footer">
                <span class="badge bg-secondary fs-6">
                    {{ count($hosting_list) }}
                </span>
                <a href="{{ route('Site-HostingGetShow') }}" class="fs-5 text-decoration-none text-dark">
                    {{ __('site.label.hosting') }}<small class="text-muted small">(s)</small>
                </a>
                <div class="dropdown float-end">
                    <a href="#" class="mdi mdi-format-list-bulleted-square text-danger dropdown-toggle"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 20px;"></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a href="{{ route('Site-HostingGetShow') }}" class="dropdown-item" href="#">
                                <i class="mdi mdi-eye"></i>
                                {{ __('site.label.show') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Site-ServiceGetDetail', ['service' => 'web-perso']) }}"
                                class="dropdown-item" href="#">
                                <i class="mdi mdi-cart"></i>
                                {{ __('site.label.buy') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <a href="{{ route('Site-DomainGetShow') }}" class="mdi mdi-earth mdi-48px text-secondary"></a>
            </div>
            <div class="card-footer">
                <span class="badge bg-secondary fs-6">
                    {{ count($domain_list) }}
                </span>
                <a href="{{ route('Site-DomainGetShow') }}" class="fs-5 text-decoration-none text-dark">
                    {{ __('site.label.domain') }}<small class="text-muted small">(s)</small>
                </a>
                <div class="dropdown float-end">
                    <a href="#" class="mdi mdi-format-list-bulleted-square text-danger dropdown-toggle"
                        id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 20px;"></a>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <li>
                            <a href="{{ route('Site-DomainGetShow') }}" class="dropdown-item" href="#">
                                <i class="mdi mdi-eye"></i>
                                {{ __('site.label.show') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Site-ServiceGetDetail', ['service' => 'domain']) }}"
                                class="dropdown-item" href="#">
                                <i class="mdi mdi-cart"></i>
                                {{ __('site.label.buy') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <a href="#" class="mdi mdi-cloud-sync mdi-48px text-secondary"></a>
                <i class="small text-danger">Bientôt</i>
            </div>
            <div class="card-footer">
                <span class="badge bg-secondary fs-6">
                    0
                </span>
                <a href="#" class="fs-5 text-decoration-none text-dark">
                    {{ __('site.label.backup') }}<small class="text-muted small">(s)</small>
                </a>
                <div class="dropdown float-end">
                    <a href="#" class="mdi mdi-format-list-bulleted-square text-danger dropdown-toggle"
                        id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 20px;"></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="#" class="dropdown-item" href="#">
                                <i class="mdi mdi-eye"></i>
                                {{ __('site.label.show') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item" href="#">
                                <i class="mdi mdi-plus-box"></i>
                                {{ __('site.label.add') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <a href="{{ route('Site-WatcherGetShow') }}" class="mdi mdi-magnify-scan mdi-48px text-secondary"></a>
            </div>
            <div class="card-footer">
                <span class="badge bg-secondary fs-6">
                    {{ count($watcher_list) }}
                </span>
                <a href="{{ route('Site-WatcherGetShow') }}" class="fs-5 text-decoration-none text-dark">
                    {{ __('site.label.watcher') }}<small class="text-muted small">(s)</small>
                </a>
                <div class="dropdown float-end">
                    <a href="#" class="mdi mdi-format-list-bulleted-square text-danger dropdown-toggle"
                        id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 20px;"></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="{{ route('Site-WatcherGetShow') }}" class="dropdown-item">
                                <i class="mdi mdi-eye"></i>
                                {{ __('site.label.show') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <a href="{{ route('Site-MonitoringGetShow') }}" class="mdi mdi-radio-tower mdi-48px text-secondary"></a>
            </div>
            <div class="card-footer">
                <span class="badge bg-secondary fs-6">
                    {{ count($monitoring_list) }}
                </span>
                <a href="{{ route('Site-MonitoringGetShow') }}" class="fs-5 text-decoration-none text-dark">
                    {{ __('site.label.monitoring') }}<small class="text-muted small">(s)</small>
                </a>
                <div class="dropdown float-end">
                    <a href="#" class="mdi mdi-format-list-bulleted-square text-danger dropdown-toggle"
                        id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 20px;"></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="{{ route('Site-MonitoringGetShow') }}" class="dropdown-item" href="#">
                                <i class="mdi mdi-eye"></i>
                                {{ __('site.label.show') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Site-MonitoringPostCreate') }}" class="dropdown-item" href="#">
                                <i class="mdi mdi-plus-box"></i>
                                {{ __('site.label.add') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <a href="{{ route('Site-ScanfolderGetShow') }}"
                    class="mdi mdi-folder-search-outline mdi-48px text-secondary"></a>
            </div>
            <div class="card-footer">
                <span class="badge bg-secondary fs-6">
                    {{ count($scanfolder_list) }}
                </span>
                <a href="{{ route('Site-ScanfolderGetShow') }}" class="fs-5 text-decoration-none text-dark">
                    {{ __('site.label.scanfolder') }}<small class="text-muted small">(s)</small>
                </a>
                <div class="dropdown float-end">
                    <a href="#" class="mdi mdi-format-list-bulleted-square text-danger dropdown-toggle"
                        id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 20px;"></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="{{ route('Site-ScanfolderGetShow') }}" class="dropdown-item" href="#">
                                <i class="mdi mdi-eye"></i>
                                {{ __('site.label.show') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Site-ServiceGetDetail', ['service' => 'scanfolder']) }}"
                                class="dropdown-item" href="#">
                                <i class="mdi mdi-plus-box"></i>
                                {{ __('site.label.add') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

@endsection
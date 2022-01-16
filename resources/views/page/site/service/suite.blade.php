@extends('layout.site.master')

@section('style')

@endsection

@section('content')

@include('layout.site.component.service-suite-' . $service_detail['slug'], ['packages' => $service_detail['packages']])

@endsection

@section('scripts')

@endsection
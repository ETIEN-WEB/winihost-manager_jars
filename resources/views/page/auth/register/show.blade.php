@extends('layout.auth.master')

@section('css')

@endsection

@section('content')
<div class="container">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-8 col-lg-5 col-xl-5 offset-md-2 offset-lg-1 offset-xl-1">
            @include('layout.auth.component.form-register')
        </div>

        @desktop
        <div class="col-12 col-sm-12 col-md-8 col-lg-4 col-xl-4 offset-md-2 offset-lg-1 offset-xl-1">
            @include('layout.auth.component.form-login')
        </div>
        @enddesktop

    </div>
</div>
@endsection

@section('js')

@endsection
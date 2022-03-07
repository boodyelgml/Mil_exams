@extends('layouts.app')

@section('content')
<form class="form-horizontal" id="addUserForm" style="display: none">
    @csrf
</form>

<style>
    .background {
        background: url('{{ asset('images/background.png') }}') no-repeat center center;
        background-size: cover;
        z-index: 0;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    a.card {
        font-size: 17px;
        border: 3px solid rgba(2, 64, 0, 0.31) !important;
    }
</style>

<div class="background"></div>

<div class="container" style="z-index: 5">
    <div class="row" style="z-index: 5">

        <div class="col-md-2" style="z-index: 5">
            <img src="{{ asset('images/index.png') }}" alt="index" style="width:100%">
        </div>
        <div class="col-md-10" style="z-index: 5">
            <h2 class="head-title">
                مرحبا بك فى المنصة الإلكترونية للواء التاسع المشاة الميكانيكى المستقل
            </h2>
        </div>
    </div>


    <div class="card-columns" style=" display: fixed; position: absolute; top:300px; width:200px; margin:auto">


        @auth
        @if(Auth::user()->is_admin == 1)


        <a href="{{ route('to_admin_dashboard') }}" style="height: 80px; text-decoration: none;" class="card bg-white mb-2">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0;
                color: black;
                margin-top: 0px;">الدخول الى شاشة المدير</p>
            </div>
        </a>



        <a href="{{ route('open_lending_page') }}" style="height: 80px; text-decoration: none;"
            class="card bg-white mb-2">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0; color: black;  margin-top: 10px;">إستعارة</p>
            </div>
        </a>

        @endif
        @endauth




        <a href="{{ route('library') }}" style="height: 80px; text-decoration: none;" class="card bg-light">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0;
                color: black;
                margin-top: 0px;">المكتبة الإلكترونية المطورة</p>
            </div>
        </a>

        <a href="{{route('to_exams')}}" style="height: 80px; text-decoration: none;" class="card bg-light mt-2">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0;
                color: black;
                margin-top: 10px;">الإختبارات</p>
            </div>
        </a>



    </div>

</div>

@endsection

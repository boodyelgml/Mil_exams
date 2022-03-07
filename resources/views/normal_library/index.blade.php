@extends('layouts.app')

@section('content')
<form class="form-horizontal" id="addUserForm" style="display: none">
    @csrf
</form>

<style>
    .background {
        background: url('{{ asset('images/library.png') }}') no-repeat center center;
        background-size: cover;
        z-index: 0;

        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    a.card{
        font-size: 17px;
        border: 3px solid rgba(2, 64, 0, 0.31) !important;
    }
</style>


<div id="back_buttons">
    <a href="./" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>

<div class="background"></div>

<div class="container" style="z-index: 5">
    <div class="row" style="z-index: 5">

        <div class="col-md-2" style="z-index: 5">
            <img src="{{ asset('images/index.png') }}" alt="index" style="width:100%">
        </div>
        <div class="col-md-10" style="z-index: 5">
            <h2  class="head-title">
                المكتبة الإلكترونية المطورة
            </h2>
        </div>
    </div>




    <div class="card-columns" style=" display: fixed; position: absolute; top:300px; width:200px; margin:auto">




        <a href="{{route('open_normal_library')}}" style="height: 80px; text-decoration: none;" class="card bg-light">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0; color: black; margin-top: 10px;">الكتب العامة</p>
            </div>
        </a>

        <a href="{{route('open_mil_library')}}" style="height: 80px; text-decoration: none; margin-bottom: 8px;"
            class="card bg-light mt-2">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0; color: black; margin-top: 10px;">الكتب العسكرية</p>
            </div>
        </a>


        <a href="{{route('full_search')}}" style="height: 80px; text-decoration: none; margin-bottom: 8px;" class="card bg-light">
            <div class="card-body text-center">
                <p class="card-text" style=" color: black; margin-top: 10px;">بحث شامل</p>
            </div>
        </a>





        @auth
        @if(Auth::user()->is_admin == 1)

        <a href="{{ route('to_upload_files') }}" style="height: 80px; text-decoration: none; margin-bottom: 8px;" class="card bg-light">
            <div class="card-body text-center">
                <p class="card-text" style=" color: black; margin-top: 0px;">إضافة مواد وملفات للمكتبة</p>
            </div>
        </a>

        @endif
        @endauth




    </div>

</div>

@endsection

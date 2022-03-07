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
    <a href="./library" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>


<div class="background"></div>


<div class="container" style="z-index: 5">

    <div class="row" style="z-index: 5">

        <div class="col-md-2" style="z-index: 5">
            <img src="{{ asset('images/index.png') }}" alt="index" style="width:100%">
        </div>
        <div class="col-md-10" style="z-index: 5">
            <h2 class="head-title">
                الكتب العسكرية
            </h2>
        </div>
    </div>

    <div class="card-columns" style=" display: fixed; position: absolute; top:300px; width:200px; margin:auto">

        @auth
        @if(Auth::user()->is_admin == 1)



        @endif

        @endauth

        <a href="./open_library/2/1" style="height: 100px; text-decoration: none;" class="card bg-light">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0; color: black; margin-top: 20px;">كتب ومراجع</p>
            </div>
        </a>

        <a href="./open_library/2/3" style="height: 100px; text-decoration: none;" class="card bg-light mt-2">
            <div class="card-body text-center">
                <p class="card-text" style="margin-bottom: 0; color: black; margin-top: 20px;">المحتوى المطور</p>
            </div>
        </a>

    </div>

</div>

@endsection

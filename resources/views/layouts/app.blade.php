<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>مرحباَ بك فى منصة إختبارات اللواء التاسع مشاة</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- jquery --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jspdf.js') }}"></script>

    <!-- Fonts -->
    <link href="{{ asset('css/nunito-font.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap5-rtl.css') }}">

    <!-- Sweet alert -->
    <script src="{{ asset('js/sweetalert.js') }}"></script>


    <!-- Stepper -->
    <script src="{{ asset('js/stepper.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/stepper.css') }}">


    <style>
        body {
            background: #00000008;
        }

        tr th,
        tr td {
            text-align: center;
        }

        .btn {
            padding-top: 2px;
        }

        .head-title {
            margin-top: 50px;
            color: white;
            background: black;
            padding: 15px 10px 23px;
            border-radius: 15px;
            outline: groove;
            text-align: center
        }

        #back_buttons {
            position: fixed;
            bottom: 10px;
            left: 20px;
            z-index: 9999;
        }

        .loader {
            height: 100%;
            width: 100%;
            background: white;
            display: flex;
            align-content: center;
            justify-content: center;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 999999999999999999;
            align-items: center;
            flex-direction: column;
            opacity: 0.95;
        }

        .lds-roller {
            display: inline-block;
            position: relative;
            width: 50px;
            height: 50px;
            transform: scale(0.7)
        }

        .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 40px 40px;
        }

        .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: rgb(0, 0, 0);
            margin: -4px 0 0 -4px;
        }

        .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }

        .lds-roller div:nth-child(1):after {
            top: 63px;
            left: 63px;
        }

        .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }

        .lds-roller div:nth-child(2):after {
            top: 68px;
            left: 56px;
        }

        .lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }

        .lds-roller div:nth-child(3):after {
            top: 71px;
            left: 48px;
        }

        .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }

        .lds-roller div:nth-child(4):after {
            top: 72px;
            left: 40px;
        }

        .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }

        .lds-roller div:nth-child(5):after {
            top: 71px;
            left: 32px;
        }

        .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }

        .lds-roller div:nth-child(6):after {
            top: 68px;
            left: 24px;
        }

        .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }

        .lds-roller div:nth-child(7):after {
            top: 63px;
            left: 17px;
        }

        .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }

        .lds-roller div:nth-child(8):after {
            top: 56px;
            left: 12px;
        }

        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        a{
            text-decoration: none
        }

    </style>

</head>


<body>

    <div class="loader" style="display: none">
        <img src="{{ asset('images/index.png') }}" alt="index" style="width:300px; height:300px"> <br>
        <span class="mt-3" style="font-size: 30px">برجاء الأنتظار</span>
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>



    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="z-index: 2">
            <div class="container-fluid">

                <a class="navbar-brand" href="{{ route('home') }}">اللواء التاسع المشاة الميكانيكى المستقل</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>
                    <section class="d-flex">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        {{-- <a class="nav-link" href="{{ route('login') }}">دخول المدير</a> --}}
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item" style="display: none">
                                        <a class="nav-link"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>

                                <a class="btn btn-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    تسجيل خروج
                                </a>


                            @endguest
                        </ul>
                    </section>
                </div>
            </div>
        </nav>



        <main class="py-4">
            @yield('content')
        </main>

    </div>

    @yield('scripts')

    <script src="{{ asset('js/persian.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('body').persianNum({
                numberType: 'arabic'
            });



            String.prototype.toIndiaDigits = function() {
                var id = [
                    '۰',
                    '۱',
                    '۲',
                    '۳',
                    '٤',
                    '٥',
                    '٦',
                    '۷',
                    '۸',
                    '۹'
                ];
                return this.replace(/[0-9]/g, function(w) {
                    return id[+w]
                });
            }




        })







        function to_arabic(tableId) {

            document.getElementById(`${tableId}`).innerHTML = document.getElementById(`${tableId}`).innerHTML
                .toIndiaDigits();


            $('table , th , thead , tr , td , tbody').css('border', '1px solid black !important')

        }

        function to_english(tableId) {
            this.location.reload()
        }
    </script>

</body>

</html>

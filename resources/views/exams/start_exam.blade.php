<script src="{{ asset('js/jquery3.3.js') }}"></script>



@extends('layouts.app')

{{-- @if (Auth::user()->is_user_did_exam_before == 0) --}}

<style>
    #pills-tabContent>div {
        border: 1px solid #0000002e;
        padding: 30px;
        border-radius: 5px;
    }

    .list-group-item {
        position: relative;
        display: block;
        padding: .5rem 1rem;
        color: #212529;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.03) !important;
    }

    button.active{
        color : white !important;
        background-color: green !important;
    }



</style>

@section('content')


    <div class="container-fluid">
        <div class="countdown" style=" position: fixed;
                                            left: 20px;
                                            bottom: 30px;
                                            z-index: 9999999999;
                                            border: 1px solid rgba(0, 0, 0, 0.486);
                                            border-radius:5px;
                                            background:white;
                                            padding: 5px 20px;
                                            font-size: 16px;">

        </div>


        <input type="text" id="timer_duration" value="{{ $timer->duration }}" hidden>

        <div class="div">

            <a href="../" class="btn btn-primary m-2" id="addUser">
                العودة للرئيسية
            </a>
        </div>

        @if ($user->is_user_did_exam_before > 1)
            <div class="alert alert-danger text-center">
                لقد قمت بآداء الإختبار من قبل . رجاءاَ تواصل مع غرفة التحكم
            </div>

        @else

            <div class="card result" style="display: none">

                <div class="card-header text-center text-white bg-dark">
                    <h5>النتيجة</h5>
                </div>
                <div class="card-body result-table">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">المادة</th>
                                <th scope="col">الاجاباب الصحيحة</th>
                                <th scope="col">الإجابات الخاطئة</th>
                                <th scope="col">إجمالى الإجابات</th>
                                <th scope="col">النسبة المئوية</th>
                            </tr>
                        </thead>
                        <tbody class="result_rows">

                        </tbody>
                    </table>
                    <div class=" alert alert-success final_percentage text-center">

                    </div>

                </div>
            </div>





            <div class="bs-stepper card card-body">



                <?php $counts = 1;
                $showClass = ''; ?>

                <div class="bs-stepper-content">

                    <form class="form-horizontal" id="questions_answers">
                        @csrf
                        <input type="text" value="{{ $user->id }}" name="user_id" hidden>

                        <?php $counts = 1;
                        $showClass = ''; ?>

                        <ul class="nav nav-tabs text-center" id="myTab" role="tablist">
                            @foreach ($exams as $exam)

                                <?php if ($counts == 1) {
                                    $showClass = 'active';
                                } else {
                                    $showClass = '';
                                } ?>

                                <li class="nav-item" onclick="resetTabs()" role="presentation">
                                    <button class="nav-link {{ $showClass }}" id="home-tab{{ $exam->id }}"
                                        data-bs-toggle="tab" data-bs-target="#home{{ $exam->id }}" type="button"
                                        role="tab" aria-controls="home" aria-selected="true">{{ $exam->name }}</button>
                                </li>

                                <?php $counts++; ?>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">



                            <?php $counts = 1;
                            $showClass = ''; ?>


                            @foreach ($exams as $exam)
                                <?php if ($counts == 1) {
                                    $showClass = 'active show';
                                } else {
                                    $showClass = '';
                                } ?>



                                <div class="tab-pane fade {{ $showClass }}" id="home{{ $exam->id }}" role="tabpanel"
                                    aria-labelledby="home-tab{{ $exam->id }}">




                                    <div class="d-flex align-items-start">

                                        <div style="border: 1px solid rgba(0, 0, 0, 0.144); border-radius:5px ; margin-right:0px !important"
                                            class="nav flex-column nav-pills me-3 m-3 ml-5 " id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">


                                            <?php $countss = 1;
                                            $showClass = ''; ?>

                                            @foreach ($all_questions as $ques)
                                                <?php $count = 1; ?>

                                                @foreach ($ques as $q)
                                                    <?php if ($count == 1) {
                                                        $showClass = 'active show';
                                                    } else {
                                                        $showClass = '';
                                                    } ?>


                                                    @if ($q->exam_id == $exam->id)

                                                        <button style="width: 150px"
                                                            class="btn-sm nav-link {{ $showClass }}"
                                                            id="v-pills-home-tab{{ $q->q_id }}{{ $q->q_id }}"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#v-pills-home{{ $q->q_id }}{{ $q->q_id }}"
                                                            type="button" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">السؤال {{ $count++ }}</button>
                                                    @endif


                                                    <?php $countss++; ?>
                                                @endforeach
                                            @endforeach

                                        </div>

                                        <div class="tab-content" id="v-pills-tabContent">

                                            @foreach ($all_questions as $ques)
                                                <?php $countss = 1;
                                                $showClass = ''; ?>
                                                @foreach ($ques as $q)

                                                    <?php if ($countss == 1) {
                                                        $showClass = 'active show';
                                                    } else {
                                                        $showClass = '';
                                                    } ?>


                                                    @if ($q->exam_id == $exam->id)

                                                        <div class="tab-pane fade {{ $showClass }}" style="margin-right: 50px;
                                                            margin-top: 60px;"
                                                            id="v-pills-home{{ $q->q_id }}{{ $q->q_id }}"
                                                            role="tabpanel"
                                                            aria-labelledby="v-pills-home-tab{{ $q->q_id }}{{ $q->q_id }}">






                                                            <h3 class="m-3 mb-5" style="color: red">
                                                                {{ $q->q_name }}
                                                            </h3>




                                                            @foreach ($questions_choises as $choise)
                                                                @if ($choise->question_id == $q->q_id)

                                                                    <input type="radio" value="0"
                                                                        onclick="printId('v-pills-home-tab'+{{ $q->q_id }}+{{ $q->q_id }})"
                                                                        name="{{ $q->q_id }},{{ $exam->name }},answer"
                                                                        checked hidden />


                                                                    @if ($choise->question_id == $q->q_id && $choise->is_correct == 1)

                                                                        <li class="list-group-item">
                                                                            <div class="radio">
                                                                                <input type="radio" value="1"
                                                                                    onclick="printId('v-pills-home-tab'+{{ $q->q_id }}+{{ $q->q_id }})"
                                                                                    name="{{ $q->q_id }},{{ $exam->name }},answer"
                                                                                    id="{{ $choise->id }}radio" />
                                                                                <label for="{{ $choise->id }}radio">
                                                                                    {{ $choise->title }}
                                                                                </label>
                                                                            </div>
                                                                        </li>


                                                                    @elseif ($choise->question_id == $q->q_id && $choise->is_correct == 0)


                                                                        <li class="list-group-item">
                                                                            <div class="radio">
                                                                                <input type="radio" value="0"
                                                                                    onclick="printId('v-pills-home-tab'+{{ $q->q_id }}+{{ $q->q_id }})"
                                                                                    name="{{ $q->q_id }},{{ $exam->name }},answer"
                                                                                    id="{{ $choise->id }}radio" />
                                                                                <label for="{{ $choise->id }}radio">
                                                                                    {{ $choise->title }}
                                                                                </label>
                                                                            </div>
                                                                        </li>
                                                                    @endif



                                                                @endif
                                                            @endforeach





                                                        </div>

                                                    @endif
                                                    <?php $countss++; ?>

                                                @endforeach
                                            @endforeach

                                        </div>
                                    </div>




                                </div>
                                <?php $counts++; ?>

                            @endforeach

                        </div>








                        <hr>

                        <div class="mt-5 mb-2 text-center">
                            <button type="button" class="btn btn-dark" onclick="clickToFinishExam()"> إنهاء الإختبار وحفظ
                                الأجابات</button>
                        </div>


                    </form>
                </div>
            </div>
        @endif


    </div>
    <script>

        $(document).ready(function(){
            $('.loader').fadeOut()
        })

        function printId(string) {
            $('#' + string).css('background-color', '#2c00ff2e');
        }

        var timer2 = $('#timer_duration').val() + ":00"


        var interval = setInterval(function() {
            var timer = timer2.split(':');

            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;

            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html("متبقى : " + minutes + ':' + seconds + " دقيقة");
            timer2 = minutes + ':' + seconds;

            if (minutes == "00" && seconds == "00") {
                Swal.fire({
                    icon: 'info',
                    title: 'إنتهى وقت الإختبار ',
                    showConfirmButton: false,
                    timer: 1500
                })
                finish_exam();
            }

        }, 1000);








        function resetTabs() {
            $(this).find('button').trigger('click');
            $(this).find('button').addClass('show');
            $(this).find('button').addClass('active');
        }

        function clickToFinishExam() {
            $('.loader').fadeOut(100)
            Swal.fire({
                title: 'هل ترغب حقا فى إنهاء الإختبار ؟ ',
                showDenyButton: true,
                confirmButtonText: 'إنهاء الإختبار',
                denyButtonText: `لا و إكمال الإختبار`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    finish_exam()
                } else if (result.isDenied) {
                    Swal.fire('لم يتم حفظ الأجابات', '', 'info')
                }
            })
        }



        function finish_exam() {
            clearInterval(interval);
            var formData = new FormData($('#questions_answers')[0]);

            $.ajax({
                type: 'post',
                url: ' {{ route('finishExam') }}',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    Swal.fire('تم حفظ النتيجة!', '', 'success');
                    $('.result').css('display', 'block');
                    $('.card.bs-stepper').css('display', 'none');
                    $('.timer_duration').css('display', 'none');

                    var final_result = 0;
                    var exams_count = 0;
                    var percentage;

                    data.forEach((exam) => {
                        percentage = (Number(exam.total_correct) / (Number(exam.total_failed) + Number(
                            exam.total_correct))) * 100
                        var result = `
                            <tr>
                        <th>${exam.exam_name}</th>
                        <td>${exam.total_correct}</td>
                        <td>${exam.total_failed}</td>
                        <td>${exam.total_failed + exam.total_correct}</td>
                        <td>${ percentage  }%</td>
                            </tr>
                `
                        $('tbody.result_rows').append(result)

                        final_result = final_result + percentage;

                        exams_count++
                    })



                    $('.final_percentage').append("النتيجة النهائية للإختبار بالنسبة المئوية : " +
                        final_result / exams_count + " %")




                },
                error: function(reject) {
                    Swal.fire({
                        icon: 'error',
                        text: 'حدث خطأ غير متوقع'
                    })
                }

            });
        }
    </script>
@endsection

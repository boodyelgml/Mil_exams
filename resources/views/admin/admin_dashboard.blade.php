@extends('layouts.app')


@section('content')
    <form class="form-horizontal" id="addUserForm" style="display: none">
        @csrf
    </form>

    <style>
        #example_filter {
            display: none
        }

        input[type="text"] {
            width: 100%
        }

        #example_length {
            margin-bottom: 20px
        }

        #example_length label {
            display: inline-flex !important;
        }

    </style>

    <div class="container-fluid">

        <div style="display: flex; justify-content: space-between">
            <div class="row">


                <div class="col-md-12 mb-3">


                    <form id="TimerForm" class="mb-3">
                        @csrf
                        <input style="width:80px; display:inline ; transform:translateY(3px)" name="timer_duration"
                            type="number" class="form-control" value="{{ $timer->duration }}">
                        <a href="#" onclick="change_timer_duration()" class="btn btn-success"> تعديل وقت الإختبار
                            بالدقائق</a>


                    </form>

                    <a href="{{ route('addNewExam') }}" class="btn btn-primary"> إضافة مواد </a>
                    <a href="{{ route('add_question') }}" class="btn btn-primary"> إضافة اسئلة </a>
                    <a href="{{ route('add_units') }}" class="btn btn-primary"> إضافة وحدات</a>
                    <a href="{{ route('add_weapon') }}" class="btn btn-primary"> إضافة أسلحة</a>
                    <a href="{{ route('add_levels') }}" class="btn btn-primary"> إضافة مستويات وتخصصات</a>


                </div>


                <div class="col-md-12 mb-3">
                    <a href="{{ route('custom_result') }}" class="btn btn-primary">نتائج مخصصة</a>
                    <a href="{{ route('result_by_unit') }}" class="btn btn-primary">نتائج الوحدات</a>
                    <a href="{{ route('exams_list') }}" class="btn btn-primary">قائمة المواد والأسئلة</a>
                    <a onclick="change_timer_duration2()" class="btn btn-primary">السماح لمن تخطى 24 ساعة</a>
                    <button onclick="printDiv('example2')" class="btn btn-success"> طباعة النتائج</button>

                    <button onclick="to_arabic('example')" class="btn btn-success"> تحويل الارقام للعربية</button>
                    <button onclick="to_english('example')" class="btn btn-success"> تحويل الارقام للأنجليزية</button>


                </div>

                <div class="col-12 mb-2">
                    <input type="text" id="title" class="form-control" placeholder="عنوان الطباعة">
                    <input type="text" id="rotba" class="form-control" placeholder="الرتبة / الدرجة للطباعة"
                        value="عميد أ ح">
                    <input type="text" id="name" class="form-control" placeholder="الإسم للطباعة"
                        value="مـــــــــــروان محمـــــــــــــد قطــــــــــــــــرى">
                    <input type="text" id="job" class="form-control" placeholder="الوظيفة للطباعة"
                        value="قائد اللواء التاسع المشاة الميكانيكى المستقل">
                </div>

            </div>


        </div>



        <div class="card">

            <div class="card card-body">
                <div class="alert bg-dark text-white text-center ">ملخص الإختبارات</div>
                <div class="card-body">

                    <div id="example2">
                        <table id="example" class="display table table-bordered datatable"
                            style="width: 100%;  border:  solid black; border-width: thin; text-align:center; border-collapse: collapse;">
                            <thead>
                                <tr style="border:  solid black; border-width: thin; text-align:center">
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        الرتبة / الدرجة</th>
                                        <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                            الرقم العسكرى</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        الإسم</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        السلاح</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        الوحدة</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        الوظيفة</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">نوع
                                        الإختبار</th>
                                    <th scope="col" class="hideOnPrint"
                                        style="border:  solid black; border-width: thin; text-align:center">عدد مرات
                                        الإختبار</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        تاريخ آخر إختبار</th>
                                    <th scope="col" style="border:  solid black; border-width: thin; text-align:center">
                                        نتيجة آخر إختبار</th>
                                    <th scope="col" class="hideOnPrint"
                                        style="border:  solid black; border-width: thin; text-align:center">السماح بإختبار
                                        آخر</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    @if ($user->is_admin != 1)
                                        <tr style="border:  solid black; border-width: thin; text-align:center">

                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                @foreach ($rotbas as $rotba)
                                                    @if ($rotba->id == $user->rotba_id)
                                                        {{ $rotba->name }}
                                                    @endif
                                                @endforeach
                                            </td>


                                                                                        <td style="border:  solid black; border-width: thin; text-align:center">
                                                                                            {{ $user->mil_number }}</td>

                                            <td style="border:  solid black; border-width: thin; text-align:center"> <a
                                                    href="{{ route('show_one_user', $user->id) }}">{{ $user->name }}</button>
                                            </td>
                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                {{ $user->weapon_name }}</td>

                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                @foreach ($units as $unit)
                                                    @if ($unit->id == $user->unit_id)
                                                        {{ $unit->name }}
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                {{ $user->job_name }}</td>

                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                @foreach ($levels as $level)
                                                    @if ($level->id == $user->level_id)
                                                        {{ $level->name }}
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td class="hideOnPrint"
                                                style="border:  solid black; border-width: thin; text-align:center">
                                                {{ $user->exams_counter }}</td>


                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                @if ($user->last_exam_date != null)
                                                    {{ \Carbon\Carbon::parse($user->last_exam_date)->format('d_m_Y') }}
                                                @endif
                                            </td>

                                            <td style="border:  solid black; border-width: thin; text-align:center">
                                                @if ($user->last_exam_percentage > 0)
                                                    <span>{{ $user->last_exam_percentage }}</span>
                                                    <span>%</span>
                                                @endif
                                            </td>


                                            <td class="hideOnPrint"
                                                style="border:  solid black; border-width: thin; text-align:center">
                                                @if ($user->is_user_did_exam_before >= 1)
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="re_exam({{ $user->id }})">إسمح</button>

                                                @else
                                                    مسموح
                                                @endif
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card result" style="display: none" id="print_result">
        <div class="card-header text-center" style="margin: 20px; text-align:center">
            النتيجة
        </div>
        <div class="card-body result-table">

            <table class="table table-bordered"
                style="width: 100%;  border:  solid black; border-width: thin; border-collapse: collapse;">
                <thead>
                    <tr style="border:  solid black; border-width: thin;">
                        <th scope="col" style="border:  solid black; border-width: thin;">المادة</th>
                        <th scope="col" style="border:  solid black; border-width: thin;">الاجاباب الصحيحة</th>
                        <th scope="col" style="border:  solid black; border-width: thin;">الإجابات الخاطئة</th>
                        <th scope="col" style="border:  solid black; border-width: thin;">إجمالى الإجابات</th>
                        <th scope="col" style="border:  solid black; border-width: thin;">النسبة المئوية</th>
                    </tr>
                </thead>
                <tbody class="result_rows">

                </tbody>
            </table>
            <div class="alert alert-success final_percentage text-center" style="margin-top: 20px; text-align:center"
                id="final_percentage">

            </div>
        </div>
    </div>
    <meta name="csrf_token" content="{{ csrf_token() }}" />



    <script>
        function change_timer_duration() {
            var formData = new FormData($('#TimerForm')[0]);

            $.ajax({
                type: 'post',
                url: ' {{ route('changeTimer') }}',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'تم تغيير مدة الإختبار',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(reject) {
                    alert(reject.message)
                }

            });
        }


        function change_timer_duration2() {

            $.ajax({
                type: 'get',
                url: ' {{ route('bulk_re_exam') }}',
                data: "",
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'تم السماح',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(reject) {
                    alert(reject.message)
                }

            });
        }

        var table = '';

        $(document).ready(function() {


            $('#example thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');

            table = $('#example').DataTable({



                'iDisplayLength': 10000,
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html(
                                '<input class="form-control" style="font-size:12px" type="text" placeholder="' +
                                " بحث " + '" />');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function(e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
        });



        function getLastResult(user_id, saveOrPrint) {
            $('#final_percentage').empty();
            $('tbody.result_rows').empty();

            $.ajax({
                url: './getLastResult/' + user_id,
                method: 'get',
                success: response => {

                    var final_result = 0;
                    var exams_count = 0;
                    var percentage;

                    response.forEach((exam) => {
                        console.log(exam);
                        percentage = (Number(exam.total_correct) / (Number(exam.total_failed) + Number(
                            exam.total_correct))) * 100
                        var result = `
                                        <tr style="border:  solid black; border-width: thin;">
                                                <th style="border:  solid black; border-width: thin;">${exam.exam_name}</th>
                                                <td style="border:  solid black; border-width: thin;">${exam.total_correct}</td>
                                                <td style="border:  solid black; border-width: thin;">${exam.total_failed}</td>
                                                <td style="border:  solid black; border-width: thin;">${exam.total_failed + exam.total_correct}</td>
                                                <td style="border:  solid black; border-width: thin;">${percentage  }%</td>
                                        </tr>
                                     `
                        $('tbody.result_rows').append(result)

                        final_result = final_result + percentage;

                        exams_count++
                    })



                    $('#final_percentage').append("النتيجة النهائية للإختبار بالنسبة المئوية : " +
                        final_result / exams_count + " %")


                    setTimeout(() => {
                        printDiv('print_result');
                    }, 500);



                },
                error: function(reject) {
                    Swal.fire({
                        icon: 'error',
                        text: 'حدث خطأ غير متوقع'
                    })
                }


            });


        }


        function re_exam(user_id) {


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './re_exam/' + user_id,
                method: 'post',
                success: response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'تم الحفظ بنجاح',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(reject) {
                    Swal.fire({
                        icon: 'error',
                        text: 'حدث خطأ غير متوقع'
                    })
                }


            });


        }


        function printDiv(divId) {

            to_arabic('example', divId)

            $('table , th , thead , tr , td , tbody').css('border', '1px solid black !important')

            $('input').hide()
            $('#example_info').hide()
            $('#example_paginate').hide()
            $('#example_length').hide()
            $('#example_filter label').hide()
            $('.hideOnPrint').hide()

            //personal = 'personal'

            title = $('#title').val()
            rotba = $('#rotba').val()
            name = $('#name').val()
            job = $('#job').val()



            let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

            mywindow.document.write(`<html dir="rtl" lang="ar"><head>`);
            mywindow.document.write('</head><body style="font-family: initial !important">');

            mywindow.document.write(`
<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;">قيــــادة المنطقـــــة المركزيــــة العسكريــــة</span>

<br style="margin-bottom:3mm">

<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;">اللـواء التاسـع المشـاة الميكانيكـى المستقـل</span>

<br style="margin-bottom:3mm">

<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;">قســـــــــــــــــــــــم العمليـــــــــــــــــــــــــات</span>

<br style="margin-bottom:3mm">

<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;">القيـــــــــــــد   &nbsp &nbsp &nbsp &nbsp &nbsp  / &nbsp &nbsp &nbsp &nbsp &nbsp/ &nbsp إختبــارات</span>

<br style="margin-bottom:3mm">

<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;">التاريـخ   &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  / &nbsp &nbsp &nbsp &nbsp &nbsp/ &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp    </span>

<br style="margin-bottom:3mm">

<br style="margin-bottom:30px">


<div style="float: left; position: absolute; top: 0px; left: 20px; text-align:left">
<img src="http://localhost/military/public/images/index.png"
alt="" style="height: 80px; width:80px">
<br style="margin-bottom:3mm">
<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;"> صورة رقـــم ( &nbsp &nbsp )</span>
<br style="margin-bottom:3mm">
<span style="border-bottom:  solid black; border-width: thin; padding-bottom:3px; font-weight: 600;"> عدد الأوراق (  &nbsp &nbsp   )</span>
</div>

`);

            mywindow.document.write(
                ` <div style="text-align:center;  padding:0px 35px; margin:15px 150px"> <span style="border-bottom: solid black; border-width: thin; font-size:20px; font-weight:600">${title}</span></div> `
            );
            //mywindow.document.write(document.getElementById(personal).innerHTML);

            mywindow.document.write(` <br style="margin:15px"> `);


            mywindow.document.write(document.getElementById(divId).innerHTML);

            mywindow.document.write(
                ` <div style="text-align:center;  padding:0px 35px; margin:15px 150px"> <span style=" font-size:20px; font-weight:600">مع وافر التحية</span></div> `
            );
            mywindow.document.write(`

<div style="float: left;  text-align:right">

<br style="margin-bottom:15px">
<span style=" padding-bottom:3px; font-weight: 600;"> التوقيـــع / &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
<br style="margin-bottom:15px">
<span style=" padding-bottom:3px; font-weight: 600;"> الرتبـــــة / ${rotba} </span>
<br style="margin:15px">
<span style=" padding-bottom:3px; font-weight: 600;"> الإســــــم / ${name}</span>
<br style="margin:15px">
<span style=" padding-bottom:3px; font-weight: 600;"> الوظيفــة /  ${job}</span>
<br style="margin:8px">
</div>

`);


            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            setTimeout(function() {
                mywindow.print();
                mywindow.close();
            }, 1000)

            $('table , th , thead , tr , td , tbody').css('border', '1px solid black !important')

            $('input').show()
            $('#example_info').show()
            $('#example_paginate').show()
            $('#example_length').show()
            $('.hideOnPrint').show()

            return true;
        }
    </script>
@endsection

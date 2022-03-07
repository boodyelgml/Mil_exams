@extends('layouts.app')


@section('content')
    <style>
        /* Thick red border */
        hr {
            border: 1px solid red;
        }
        table{
            width: 100%;
        }
    </style>

    {{-- TODO تظبيط الطباعة --}}

    <div class="container">

        <div class="col-md-12 mb-3">
            <a href="../to_admin_dashboard" class="btn btn-primary" id="addUser">
                العودة للسابق
            </a>
            <button class="btn  btn-danger " style="width: 150px;" onclick="printDiv('holePage', 'print');"> طباعة جميع
                النتائج </button>

                <button onclick="to_arabicc('holePage')" class="btn btn-success"> تحويل الارقام للعربية</button>
            <button onclick="to_english('example')" class="btn btn-success"> تحويل الارقام للأنجليزية</button>

        </div>


        <div class="col-12 mb-2">
            <input type="text" id="title" class="form-control" placeholder="عنوان الطباعة">
            <input type="text" id="rotba" class="form-control" placeholder="الرتبة / الدرجة للطباعة" value="عميد أ ح">
            <input type="text" id="name" class="form-control" placeholder="الإسم للطباعة"  value="مـــــــــــروان محمـــــــــــــد قطــــــــــــــــرى">
            <input type="text" id="job" class="form-control" placeholder="الوظيفة للطباعة" value="قائد اللواء التاسع المشاة الميكانيكى المستقل">

        </div>

        <div class="card mb-4">


            <div class="alert text-center bg-dark text-white">
                المعلومات الشخصية
            </div>

            <div  id="personal">


            <table class="table table-sm table-bordered" id="example"
                style=" border:  solid black; border-width: thin; text-align:center ;border-collapse: collapse;">
                <thead>

                    <tr style="border:  solid black; border-width: thin; text-align:center">
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الرقم العسكرى</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الرتبة / الدرجة</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الإسم</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">السلاح</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الوحدة</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الوظيفة</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">نوع الإختبار</th>
                        <th style="border:  solid black; border-width: thin; text-align:center" scope="col">عدد مرات الإختبار</th>
                    </tr>

                </thead>
                <tbody>

                    <tr style="border:  solid black; border-width: thin;text-align:center">
                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $user->mil_number }}</td>

                        <td style="border:  solid black; border-width: thin;text-align:center">
                            @foreach ($rotbas as $rotba)
                                @if ($rotba->id == $user->rotba_id)
                                    {{ $rotba->name }}
                                @endif
                            @endforeach
                        </td>


                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $user->name }}</td>

                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $user->weapon_name }}</td>

                        <td style="border:  solid black; border-width: thin;text-align:center">
                            @foreach ($units as $unit)
                                @if ($unit->id == $user->unit_id)
                                    {{ $unit->name }}
                                @endif
                            @endforeach
                        </td>

                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $user->job_name }}</td>

                        <td style="border:  solid black; border-width: thin;text-align:center">
                            @foreach ($levels as $level)
                                @if ($level->id == $user->level_id)
                                    {{ $level->name }}
                                @endif
                            @endforeach
                        </td>

                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $user->exams_counter }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        </div>





        <div class="card "  id="holePage">
        @foreach ($results as $resultss)
            @if (isset($resultss[0]->exam_count))


                    <div class="alert bg-dark text-white text-center  " style="text-align: center">

                        <h6 style="text-align: center">الإختبار رقم {{ $resultss[0]->exam_count }}</h5>
                    </div>

                    <div id="exam{{ $resultss[0]->exam_count }}">
                        <?php $totalPercentage = 0;
                        $count_of_exams = 0;
                        $total = 0; ?>
                        <table class="table table-sm table-bordered"
                            style=" border:  solid black; border-width: thin;text-align:center; border-collapse: collapse;">
                            <thead>
                                <tr style="border:  solid black; border-width: thin;text-align:center">
                                    <th style="border:  solid black; border-width: thin;text-align:center">تاريخ الإختبار</th>
                                    <th style="border:  solid black; border-width: thin;text-align:center">إسم المادة</th>
                                    <th style="border:  solid black; border-width: thin;text-align:center">الإجابات الخاطئة</th>
                                    <th style="border:  solid black; border-width: thin;text-align:center">الإجابات الصحيحة</th>
                                    <th style="border:  solid black; border-width: thin;text-align:center">إجمالى الإجابات</th>
                                    <th style="border:  solid black; border-width: thin;text-align:center">النسبة المئوية</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($resultss as $result)
                                    <tr style="border:  solid black; border-width: thin;text-align:center">
                                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $result->created_at->format('d_m_Y') }}
                                        </td>
                                        <td style="border:  solid black; border-width: thin;text-align:center">{{ $result->exam_name }}</td>
                                        <td style="color: red;border:  solid black; border-width: thin;text-align:center">{{ $result->total_failed }}</td>
                                        <td style="color: green;border:  solid black; border-width: thin;text-align:center">{{ $result->total_correct }}
                                        </td>
                                        <td style="border:  solid black; border-width: thin;text-align:center">
                                            {{ $result->total_correct + $result->total_failed }}</td>
                                        <td style="font-size:20px;border:  solid black; border-width: thin;text-align:center">
                                            <span>{{ ($result->total_correct / ($result->total_correct + $result->total_failed)) * 100 }}</span>
                                            <span>%</span>
                                         </td>


                                        <?php $total += ($result->total_correct / ($result->total_correct + $result->total_failed)) * 100; ?>


                                    </tr>

                                    <?php $count_of_exams++; ?>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                    <div class="alert bg-white text-dark text-center" style="text-align: center">
                        <h6>النتيجة النهائية للإختبار بالنسبة المئوية : %{{ $total / $count_of_exams }} </h5>
                            <button class="btn btn-sm btn-danger mb-4" style="width: 150px"
                                onclick="printDiv('exam{{ $resultss[0]->exam_count }}', 'print');">طباعة</button>
                    </div>


                    <hr style="margin: 40px">
                    @endif
                    @endforeach
                </div>




    </div>
@endsection

<script>

    function to_arabicc(tableId) {



        document.getElementById(`${tableId}`).innerHTML = document.getElementById(`${tableId}`).innerHTML
        .toIndiaDigits();

        document.getElementById("personal").innerHTML = document.getElementById("personal").innerHTML
        .toIndiaDigits();

        $('table').css('width' , '100%');
        $('table , th , thead , tr , td , tbody').css('border', '1px solid black !important')

    }


    window.jsPDF = window.jspdf.jsPDF
    var doc = new jsPDF();


    function printDiv(divId, title) {

        $('table').css('width' , '100%');

        $('.btn').hide();
        $('input').hide();

        personal = 'personal'

        title = $('#title').val()
        rotba = $('#rotba').val()
        name = $('#name').val()
        job = $('#job').val()

        let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

        mywindow.document.write(`<html dir="rtl" lang="ar"><head>`);
        mywindow.document.write('</head><body style="font-family: initial !important">');

        mywindow.document.write(`
        <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;">قيــــادة المنطقـــــة المركزيــــة العسكريــــة</span>

        <br style="margin-bottom:3mm">

        <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;">اللـواء التاسـع المشـاة الميكانيكـى المستقـل</span>

        <br style="margin-bottom:3mm">

        <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;">قســـــــــــــــــــــــم العمليـــــــــــــــــــــــــات</span>

        <br style="margin-bottom:3mm">

        <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;">القيـــــــــــــد   &nbsp &nbsp &nbsp &nbsp &nbsp  / &nbsp &nbsp &nbsp &nbsp &nbsp/ &nbsp إختبــارات</span>

        <br style="margin-bottom:3mm">

        <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;">التاريـخ   &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  / &nbsp &nbsp &nbsp &nbsp &nbsp/ &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp    </span>

        <br style="margin-bottom:3mm">



        <div style="float: left; position: absolute; top: 0px; left: 20px; text-align:left">
            <img src="http://localhost/military/public/images/index.png"
            alt="" style="height: 80px; width:80px">
            <br style="margin-bottom:3mm">
            <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;"> صورة رقـــم ( &nbsp &nbsp )</span>
            <br style="margin-bottom:3mm">
            <span style="border-bottom: 1px solid black; padding-bottom:3px; font-weight: 600;"> عدد الأوراق (  &nbsp &nbsp   )</span>
        </div>

        `);

        mywindow.document.write( ` <div style="text-align:center;  padding:0px 35px; margin:15px 150px"> <span style="border-bottom: solid black; border-width: thin; font-size:20px; font-weight:600">${title}</span></div> `);
        mywindow.document.write(document.getElementById(personal).innerHTML);

        mywindow.document.write(` <br style="margin:15px"> `);


        mywindow.document.write(document.getElementById(divId).innerHTML);

        mywindow.document.write(` <div style="text-align:center;  padding:0px 35px; margin:15px 150px"> <span style="font-size:20px; font-weight:600">مع وافر التحية</span></div> `);
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

        setTimeout(function(){
mywindow.print();
        mywindow.close();
},1000)
        $('.btn').show();
        $('input').show();
        return true;
    }
</script>

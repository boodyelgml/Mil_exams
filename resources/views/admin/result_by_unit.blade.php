@extends('layouts.app')


@section('content')

<style>
    /* Thick red border */
    hr {
        border: 1px solid red;
    }
</style>

{{-- TODO تظبيط الطباعة --}}

<div class="container" id="holePage">

    <div class="col-md-12 mb-3">
        <a href="./to_admin_dashboard" class="btn btn-primary" id="addUser">
            العودة للسابق
        </a>
        <button class="btn  btn-danger " style="width: 150px;" onclick="printDiv('print');"> طباعة النتائج
        </button>
        <button onclick="to_arabic('example')" class="btn btn-success"> تحويل الارقام للعربية</button>
        <button onclick="to_english('example')" class="btn btn-success"> تحويل الارقام للأنجليزية</button>

    </div>

    <div class="col-12 mb-2">
        <input type="text" id="title" class="form-control" placeholder="عنوان الطباعة">
        <input type="text" id="rotba" class="form-control" placeholder="الرتبة / الدرجة للطباعة" value="عميد أ ح">
        <input type="text" id="name" class="form-control" placeholder="الإسم للطباعة"  value="مـــــــــــروان محمـــــــــــــد قطــــــــــــــــرى">
        <input type="text" id="job" class="form-control" placeholder="الوظيفة للطباعة" value="قائد اللواء التاسع المشاة الميكانيكى المستقل">


    </div>



    <div class="card mb-4">



        <div class="card card-body">


            <select class="form-select mb-2" onchange="getResult()" id="rotbas" required>

                <option value="" selected disabled>الوحدة</option>
                @foreach ($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach

            </select>

            <div class="alert bg-dark text-white text-center " style="text-align: center">ملخص النتائج</div>
            <div class="card-body"  id="print">


                <table id="example" class="display table table-bordered datatable" style="width: 100%;  border:  solid black; border-width: thin; text-align:center; border-collapse: collapse;" >
                    <thead>
                        <tr style="border:  solid black; border-width: thin; text-align:center">

                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">م</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الرقم العسكرى</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الرتبة / الدرجة</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الإسم</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">السلاح</th>

                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">الوظيفة</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">نوع الأختبار</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">تاريخ آخر إختبار</th>
                            <th style="border:  solid black; border-width: thin; text-align:center" scope="col">نتيجة آخر إختبار</th>
                        </tr>
                    </thead>
                    <tbody style="border:  solid black; border-width: thin; text-align:center" id="tbody">




                    </tbody>
                </table>

                <div class="final_result text-center">

                </div>

            </div>
        </div>

    </div>




</div>



<script>

    function getResult(){
        $('.final_result').empty();
        $('#tbody').empty();
        unit = $('#rotbas').val();



        var final_result = 0;
        var users_counts = 0;

        $.ajax({
            type: 'get'
            , url: './get_unit_results/' + unit
            , processData: false
            , contentType: false
            , cache: false
            , success: function(data) {
                data.forEach(element => {
                    users_counts++
                    final_result += element.last_exam_percentage;

                    var result = `
                    <tr>

                        <td style="border:  solid black; border-width: thin; text-align:center">${users_counts}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${element.mil_number}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${element.rotba_id}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${element.name}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${element.weapon_name}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${element.job_name}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${element.level_id}</td>
                         <td style="border:  solid black; border-width: thin; text-align:center">${element.last_exam_date ? element.last_exam_date.slice(0, 10) : "no date"}</td>
                        <td style="border:  solid black; border-width: thin; text-align:center">${ element.last_exam_percentage ? element.last_exam_percentage : "no result"} <span>%</span> </td>
                    </tr>
                    `
                    $('#tbody').append(result);
                });

               // $('.final_result').append(final_result / users_counts + '%');


            }

        });

    }



    window.jsPDF = window.jspdf.jsPDF
    var doc = new jsPDF();


    function printDiv(divId) {
        // $('.btn').hide();


       // personal = 'personal'

        title = $('#title').val()
        rotba = $('#rotba').val()
        name = $('#name').val()
        job = $('#job').val()

        $('input').hide();
         $('select').hide();

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

        <br style="margin-bottom:30px">


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
        //mywindow.document.write(document.getElementById(personal).innerHTML);

        mywindow.document.write(` <br style="margin:15px"> `);


        mywindow.document.write(document.getElementById(divId).innerHTML);

        mywindow.document.write(` <div style="text-align:center;  padding:0px 35px; margin:15px 150px"> <span style=" font-size:20px; font-weight:600">مع وافر التحية</span></div> `);
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
        // $('.btn').show();
         $('input').show();
         $('select').show();
        return true;
    }



</script>
@endsection

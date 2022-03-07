@extends('layouts.app')


@section('content')
    <style>
        /* Thick red border */
        hr {
            border: 1px solid red;
        }

        #example3_filter {
            display: none;
        }

    </style>

    {{-- TODO تظبيط الطباعة --}}
    <div class="container mb-3">
        <div class="card">
            <div class="card-body" id="example2">
                <table class="display table table-bordered datatable"
                    style="width: 100%;  border:  solid black; border-width: thin; text-align:center ;border-collapse: collapse;"
                    id="example" style="width:100%">
                    <thead>
                        <tr style="border:  solid black; border-width: thin; text-align:center">
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center">م</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center">الرقم العسكرى</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center">رتبة / درجة</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center">الإسم</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center"> السلاح</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center"> الوحدة</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center"> الوظيفة</th>
                            <th scope="col"> نوع الإختبار</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center">تاريخ الإختبار</th>
                            <th scope="col" style="border:  solid black; border-width: thin; text-align:center">النتيجة</th>
                            <th scope="col" style="width: 100px;border:  solid black; border-width: thin; text-align:center">ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody style="border:  solid black; border-width: thin; text-align:center">

                        <tr style="border:  solid black; border-width: thin; text-align:center">

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container" id="holePage">

        <div class="col-md-12 mb-3">
            <a href="./to_admin_dashboard" class="btn btn-primary" id="addUser">
                العودة للسابق
            </a>
            <button class="btn  btn-danger " style="width: 150px;" onclick="printDiv('example2')"> طباعة النتائج
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



        <div class="card mb-4" id="print">





            <div class="card">



                <div class="card card-body">
                    <div class="alert bg-dark text-white text-center ">ملخص الإختبارات</div>
                    <div class="card-body">


                        <table id="example3" class="display table table-bordered datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">الرتبة / الدرجة</th>
                                    <th scope="col">الإسم</th>
                                    <th scope="col">الرقم العسكرى</th>
                                    <th scope="col">السلاح</th>
                                    <th scope="col">الوحدة</th>
                                    <th scope="col">الوظيفة</th>
                                    <th scope="col">نوع الإختبار</th>

                                    <th scope="col" style="width: 250px">الإختبارات السابقة</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    @if ($user->is_admin != 1)
                                        <tr>

                                            <td>
                                                @foreach ($rotbas as $rotba)
                                                    @if ($rotba->id == $user->rotba_id)
                                                        {{ $rotba->name }}
                                                    @endif
                                                @endforeach
                                            </td>


                                            <td> <a href="{{ route('show_one_user', $user->id) }}">{{ $user->name }}</a>
                                            </td>

                                            <td>{{ $user->mil_number }}</td>
                                            <td>{{ $user->weapon_name }}</td>

                                            <td>
                                                @foreach ($units as $unit)
                                                    @if ($unit->id == $user->unit_id)
                                                        {{ $unit->name }}
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>{{ $user->job_name }}</td>

                                            <td>
                                                @foreach ($levels as $level)
                                                    @if ($level->id == $user->level_id)
                                                        {{ $level->name }}
                                                    @endif
                                                @endforeach
                                            </td>



                                            <td>
                                                <select class="form-select mb-2" onchange="getCustomResults(this)" id="user"
                                                    required>

                                                    <option value="" selected disabled>الإختبارات</option>
                                                    @foreach ($user_results as $result)
                                                        @if ($user->id == $result->user_id)
                                                            <option value="{{ $result->id }}">مستوى
                                                                {{ $result->level_name }} بتاريخ {{ $result->created_at }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
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
    </div>



    <script>
        $(document).ready(function() {


            $('#example3 thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example3 thead');

            var table = $('#example3').DataTable({
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
                                " بحث ب" + title + '" />');

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







        function getResults() {
            $('#result').empty();
            var userId = $('#user').val();
            var users_counts = 0;

            $.ajax({
                type: 'get',
                url: './get_custom_results/' + userId,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    console.log(data);
                    $('#result').append(`<option disabled selected>أختار الإختبار</option>`);
                    data.forEach(element => {


                        var result = `
                               <option value="${element.id}">مستوى ${element.level_name} بتاريخ ${element.created_at.slice(0, 10)}</option>
                                `
                        $('#result').append(result);
                    });
                }
            });

        }



        function getCustomResults(id) {
            var count = $('#example2 tr').length
            var result_id = id.value;
            var users_counts = 0;
            console.log(result_id);
            $.ajax({
                type: 'get',
                url: './get_custom_result_data/' + result_id,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    console.log(data);
                    var result = `
                                <tr>
                                    <td style="border:  solid black; border-width: thin;">${count-1}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.mil_number}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.rotba_name}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.user_name}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.weapon_name}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.unit_name}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.work}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.level_name}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.created_at.slice(0, 10)}</td>
                                    <td style="border:  solid black; border-width: thin;">${data.result.slice(0, 4)}%</td>
                                    <td style="border:  solid black; border-width: thin;"></td>
                                </tr>
                                `
                    $('#example').append(result);
                }
            });

        }



        window.jsPDF = window.jspdf.jsPDF
        var doc = new jsPDF();


        function printDiv(divId) {


            //personal = 'personal'

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

            return true;
        }
    </script>
@endsection

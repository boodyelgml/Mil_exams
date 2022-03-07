@extends('layouts.app')
<script src="{{ asset('js/jquery3.3.js') }}"></script>

<style>
    #example_filter{
        display: none
    }
</style>


@section('content')
<form class="form-horizontal" id="addUserForm" style="display: none">
    @csrf
</form>
<div id="back_buttons">
    <a href="./open_lending_page" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>
<div class="container-fluid">

    <div class="row">




        <div class="card card-body">

            <div class="card-header text-center">قائمة الكتب فى المكتبة</div>


            <table id="example" class="display table table-bordered datatable" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">إسم الكتاب</th>
                        <th scope="col">كود الكتاب</th>
                        <th scope="col">المكتبة</th>
                        <th scope="col">مكان الكتاب</th>
                        <th scope="col">تاريخ الأستعارة</th>
                        <th scope="col">تاريخ الرد</th>
                        <th scope="col">رتبة المستعير</th>
                        <th scope="col">إسم المستعير</th>
                        <th scope="col">إسم الوحدة</th>
                        <th scope="col">هاتف المستعير</th>
                        <th scope="col">رد الكتاب</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($logs as $log)

                    <tr>

                        <td>
                            @foreach ($books as $book)
                            @if($book->id == $log->book_id)
                            {{ $book->book_name }}
                            @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($books as $book)
                            @if($book->id == $log->book_id)
                            {{ $book->book_code }}
                            @endif
                            @endforeach
                        </td>


                        <td>
                            @foreach ($books as $book)
                            @if($book->id == $log->book_id)

                            @if ($book->library_id == 1)
                            الكتب العامة
                            @elseif ($book->library_id == 2 && $book->library_section == 1)
                            الكتب العسكرية (القسم العام)
                            @else
                            الكتب العسكرية (القسم التخصصى)
                            @endif
                            @endif
                            @endforeach

                        </td>


                        <td>
                            @foreach ($books as $book)
                            @if($book->id == $log->book_id)
                            {{$book->book_place}}
                            @endif
                            @endforeach
                        </td>

                        <td> {{ $log->lending_start_date }} </td>
                        <td> {{ $log->lending_end_date }} </td>
                        <td> {{ $log->rotba }} </td>
                        <td> {{ $log->lender_name }} </td>
                        <td> {{ $log->unit }} </td>
                        <td> 0{{ $log->mobile_number }} </td>


                        <td>
                            @foreach ($books as $book)
                            @if($book->id == $log->book_id)
                            @if($log->is_active > 0)
                            <button onclick="lendRestore( {{$log->id}} , {{$book->id}} )" class="btn btn-primary">رد
                                الكتاب</button>
                            @else
                            تم الرد
                            @endif
                            @endif
                            @endforeach
                        </td>

                    </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
        <meta name="csrf_token" content="{{ csrf_token() }}" />
    </div>
</div>
@endsection





<script>
    function lendRestore(logId , bookId){


    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post'
        , url: './request_lend_restore/'+logId+'/'+bookId
        , processData: false
        , contentType: false
        , cache: false
        , success: function(data) {
            Swal.fire({
            icon: 'success',
            title: 'تم الرد بنجاح',
            showConfirmButton: false,
            timer: 1500
            })

            setTimeout(() => {
                location.reload();;
            }, 1500);
        }
        , error: function(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function(key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}


$(document).ready(function () {


$('#example thead tr')
.clone(true)
.addClass('filters')
.appendTo('#example thead');

var table = $('#example').DataTable({
orderCellsTop: true,
fixedHeader: true,
initComplete: function () {
    var api = this.api();

    api
        .columns()
        .eq(0)
        .each(function (colIdx) {
            // Set the header cell to contain the input element
            var cell = $('.filters th').eq(
                $(api.column(colIdx).header()).index()
            );
            var title = $(cell).text();
            $(cell).html('<input class="form-control" style="font-size:12px" type="text" placeholder="' + " بحث ب" +title  +  '" />');

            // On every keypress in this input
            $(
                'input',
                $('.filters th').eq($(api.column(colIdx).header()).index())
            )
                .off('keyup change')
                .on('keyup change', function (e) {
                    e.stopPropagation();

                    // Get the search value
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                    var cursorPosition = this.selectionStart;
                    // Search the column for that value
                    api
                        .column(colIdx)
                        .search(
                            this.value != ''
                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                : '',
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

</script>

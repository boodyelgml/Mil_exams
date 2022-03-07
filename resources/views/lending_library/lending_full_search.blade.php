@extends('layouts.app')
<script src="{{ asset('js/jquery3.3.js') }}"></script>
@section('content')
<form class="form-horizontal" id="addUserForm" style="display: none">
    @csrf
</form>

<style>
    #example_filter {
        display: none;
    }
</style>

<div id="back_buttons">
    <a href="./open_lending_page" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>

<div class="container" style="z-index: 5">

    <div class="alert bg-dark text-white text-center">البحث فى مكتبة الأستعارة</div>
    <div class="card card-body">

        <table class="table table-bordered datatable" id="example" style="width: 100%">
            <thead>

                <tr>
                    <th scope="col">إسم الكتاب</th>
                    <th scope="col">كود الكتاب</th>
                    <th scope="col">موضوع الكتاب</th>
                    <th scope="col">سنة طباعة الكتاب</th>
                    <th scope="col">عدد نسخ الكتاب</th>
                    <th scope="col">مكان الكتاب</th>
                    <th scope="col">المكتبة</th>
                </tr>

            </thead>
            <tbody>

                @foreach ($books as $book)



                <tr>
                    <td>{{$book->book_name}}</td>
                    <td>{{$book->book_code}}</td>
                    <td>{{$book->book_description}}</td>
                    <td>{{$book->book_year}}</td>
                    <td>{{$book->book_copies}}</td>
                    <td>{{$book->book_place}}</td>
                    <td>
                        @if ($book->library_id == 1)
                        الكتب العامة
                        @else
                        الكتب العسكرية
                        @endif
                    </td>
                </tr>


                @endforeach

            </tbody>
        </table>
    </div>



</div>

@endsection

<script>
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


    var table = $('#example2').DataTable();















    });
</script>





















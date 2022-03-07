@extends('layouts.app')

<script src="{{ asset('js/jquery3.3.js') }}"></script>
<style>
    #example_filter {
        display: none
    }

</style>
@section('content')
    <form class="form-horizontal" id="addUserForm" style="display: none">
        @csrf
    </form>

    <div class="container-fluid">
        <div class="col-md-12 mb-2">
            <button onclick="back()" class="btn btn-primary" id="addUser">
                العودة للسابق
            </button>
        </div>

        <div class="card card-body">

            <div class="card-header text-center bg-dark text-white">قائمة المواد فى المكتبة</div>

            <div class="row">


                <table id="example" class="display table table-bordered datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">إسم الكتاب</th>
                            <th scope="col">كود الكتاب</th>
                            <th scope="col">موضوع الكتاب</th>
                            <th scope="col">سنة الطبع</th>
                            <th scope="col">إجمالى عدد النسخ</th>
                            <th scope="col">عدد المتاح</th>
                            <th scope="col">عدد المستعار</th>
                            <th scope="col">مكان الكتاب</th>
                            <th scope="col">طلب إستعارة</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($Books as $Book)
                            <tr>
                                <td> {{ $Book->book_name }} </td>
                                <td> {{ $Book->book_code }} </td>
                                <td> {{ $Book->book_description }} </td>
                                <td> {{ $Book->book_year }} </td>
                                <td> {{ $Book->book_copies }} </td>
                                <td> {{ $Book->available_copies }} </td>
                                <td> {{ $Book->pending_copies }} </td>
                                <td> {{ $Book->book_place }} </td>
                                <td>
                                    <a href="{{ route('request_lend', $Book->id) }}" class="btn btn-primary">طلب
                                        إستعارة</a>

                                    <button class="btn btn-danger btn-sm"
                                        exam_id="{{ route('delete_lending_book', $Book->id) }}" id="Delete"> حذف
                                        الكتاب</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>



        </div>


    </div>
@endsection





<script>
     function back(){
            window.history.back();
        }

    $(document).on('click', "#Delete", function(e) {

        e.preventDefault();
        $('.loader').fadeOut(100)
        Swal.fire({
                title: 'هل أنت متأكد من حذف هذا الكتاب?',
                showDenyButton: true,
                confirmButtonText: 'نعم إمسح!',
                denyButtonText: `لا `,
            })
            .then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var examId = $(this).attr('exam_id');
                    console.log(examId);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'delete',
                        url: examId,
                        data: "",
                        success: function(data) {
                            Swal.fire("تم الحذف بنجاح!")
                        },
                        error: function(reject) {
                            Swal.fire("لم يتم الحذف");
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('لم يتم الحذف', '', 'info')
                }
            })


    });




    $(document).ready(function() {


        $('#example thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#example thead');

        var table = $('#example').DataTable({
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
</script>

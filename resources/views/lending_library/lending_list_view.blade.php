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
    <div id="back_buttons">
        <button onclick="back()" class="to_back btn btn-sm btn-primary">العودة للسابق</button>
        <a href="{{ route('home') }}" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
    </div>
    <div class="container-fluid">
        <div class="col-md-12 mb-2">

        </div>

        <div class="card card-body">

            <div class="card-header text-center bg-dark text-white">قائمة المواد فى المكتبة</div>

            <div class="row">


                @foreach ($Books as $subject)
                    <a class="btn btn-success col-md-2 m-2"
                        href="{{ route('open_subject_books', $subject->id) }}">{{ $subject->name }}</a>
                @endforeach
            </div>



        </div>


    </div>
@endsection





<script>
    function back() {
        window.history.back();
    }

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

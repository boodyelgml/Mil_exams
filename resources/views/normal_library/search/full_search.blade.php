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
        <a href="./library" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
        <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
    </div>

    <div class="container" style="z-index: 5">
        <div class="alert bg-dark text-white text-center">البحث بالملفات</div>

        <div class="col-md-12 mb-2">

            <form id="searchForm">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="file_name" class="mb-2">بحث بإسم الملف</label>
                    <input id="file_name" type="text" name="file_name" class="form-control">
                    <small id="file_name_error"></small>
                </div>

            </form>
            <button class="btn btn-primary" onclick="getResults()">ابدأ البحث</button>

        </div>



        <hr>
        <div class="card card-body">

            <table class="table table-bordered datatable" id="example2" style="width: 100%">
                <thead>

                    <tr>
                        <th scope="col">إسم الملف</th>
                        <th scope="col">المكتبة</th>
                        <th scope="col">القسم</th>
                        <th scope="col">المادة</th>

                    </tr>

                </thead>
                <tbody>


                    {{-- @foreach ($items as $item)



                <tr>
                    <th>
                        <a href="{{ asset('files/'.$item->name) }}"
                            class="list-group-item list-group-item-action text-center">{{$item->original_name}}</a>
                    </th>
                    <td>
                        @if ($item->category == 1)
                        الكتب العامة
                        @else
                        الكتب العسكرية
                        @endif
                    </td>

                    <td>
                        @if ($item->category == 1 && $item->section_id == 1)
                        كتب ومراجع
                        @elseif ($item->category == 1 && $item->section_id == 2)
                        مكتبة مطورة
                        @elseif ($item->category == 2 && $item->section_id == 1)
                        كتب ومراجع
                        @elseif ($item->category == 2 && $item->section_id == 3)
                        المحتوى المطور
                        @endif
                    </td>

                    <td>

                        @foreach ($subject as $sub)
                            @if ($item->subject_id == $sub->id)
                                {{$sub->name}}
                            @endif
                        @endforeach
                    </td>


                    <td>

                        @foreach ($cats as $cat)
                            @if ($item->cat == $cat->id)
                                {{$cat->name}}
                            @endif
                        @endforeach
                    </td>
                </tr>


                @endforeach --}}

                </tbody>
            </table>
        </div>

    </div>

@endsection

<script>
    function getResults() {

        var fileName = $('#file_name').val();

        $('tbody').empty();

        $.ajax({
            type: 'get',
            url: './get_books_result/' + fileName,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {


                data.forEach(element => {
                    console.log(element)
                    var result = `
                    <tr>
                            <td>
                                <a href="{{ asset('files//') }}${"/" + element.name}" name="${element.name}"
                                class="list-group-item list-group-item-action text-center">${element.original_name}</a>
                            </td>

                            <td>
                                ${element.category == 1 ? "الكتب العامة" : "الكتب العسكرية"}
                            </td>

                            <td>
                                ${
                                     (element.category == 1 && element.section_id == 1) ? "كتب ومراجع" :

                                     (element.category == 1 && element.section_id == 2) ? "مكتبة مطورة" :

                                     (element.category == 2 && element.section_id == 1) ? "كتب ومراجع" :

                                     (element.category == 2 && element.section_id == 2) ? "المحتوى المطور" : ''

                                }
                            </td>

                            <td>
                                ${element.subject_id}
                            </td>
                    </tr>
                    `
                    $('tbody').append(result);

                });

            }
        });

    }
</script>

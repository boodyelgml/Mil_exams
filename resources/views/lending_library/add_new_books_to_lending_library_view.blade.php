@extends('layouts.app')


@section('content')
<div id="back_buttons">
    <a href="./open_lending_page" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <a href="./add_lending_subjects" class="btn btn-success">
                إضافة مواد للمكتبة
            </a>
        </div>


        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="alert alert-info text-center text-white bg-dark">إضافة كتاب جديد للمكتبة </div>
                <div class="card-body">
                    <form form class="form-horizontal" id="addUserForm">
                        @csrf


                        {{-- المكتبة --}}

                        <div class="row mb-3">

                            <label for="library" class="col-md-4 col-form-label text-md-end">المكتبة</label>

                            <div class="col-md-6">
                                <select onchange="get_lending_subjects()" class="form-select" name="library"
                                    id="library" required>
                                    <option disabled selected>اختار المكتبة</option>
                                    <option value="1">الكتب العامة</option>
                                    <option value="2">الكتب العسكرية</option>
                                </select>

                                <small id="library_error"></small>
                            </div>
                        </div>



                        {{-- قسم المكتبة --}}

                        <div style="display: none" id="section_div">

                            <div class="row mb-3">

                                <label for="library" class="col-md-4 col-form-label text-md-end">قسم المكتبة</label>

                                <div class="col-md-6">
                                    <select onchange="get_lending_subjects()"  class="form-select" name="section" id="section" required>
                                        <option value="1">القسم العام</option>
                                        <option value="2">القسم التخصصى</option>
                                    </select>

                                    <small id="library_error"></small>
                                </div>
                            </div>

                        </div>




                        {{-- المادة --}}

                        <div class="row mb-3">

                            <label for="subject" class="col-md-4 col-form-label text-md-end">المادة</label>

                            <div class="col-md-6">
                                <select class="form-select" name="subject" id="subject" required>

                                </select>

                                <small id="subject_error"></small>
                            </div>
                        </div>



                        {{-- كود الكتاب --}}

                        <div class="row mb-3">
                            <label for="book_code" class="col-md-4 col-form-label text-md-end">كود الكتاب</label>

                            <div class="col-md-6">
                                <input id="book_code" type="text" class="form-control" name="book_code" required />
                                <small id="book_code_error"></small>
                            </div>
                        </div>


                        {{-- إسم الكتاب --}}

                        <div class="row mb-3">
                            <label for="book_name" class="col-md-4 col-form-label text-md-end">إسم الكتاب</label>


                            <div class="col-md-6">

                                <input id="book_name" type="text" class="form-control" name="book_name" required />
                                <small id="book_name_error"></small>

                            </div>
                        </div>




                        {{-- موضوع الكتاب --}}
                        <div class="row mb-3">
                            <label for="book_description" class="col-md-4 col-form-label text-md-end">موضوع
                                الكتاب</label>

                            <div class="col-md-6">

                                <input id="book_description" type="text" class="form-control" name="book_description"
                                    required />
                                <small id="book_description_error"></small>

                            </div>
                        </div>



                        {{-- سنة الطبع --}}
                        <div class="row mb-3">
                            <label for="book_year" class="col-md-4 col-form-label text-md-end">سنة الطبع</label>

                            <div class="col-md-6">

                                <input id="book_year" type="text" class="form-control" name="book_year" required />
                                <small id="book_year_error"></small>

                            </div>
                        </div>





                        {{-- عدد النسخ --}}
                        <div class="row mb-3">
                            <label for="book_copies" class="col-md-4 col-form-label text-md-end">عدد النسخ</label>

                            <div class="col-md-6">
                                <input id="book_copies" type="number" class="form-control" name="book_copies"
                                    required />
                                <small id="book_copies_error"></small>
                            </div>
                        </div>




                        {{-- مكان الكتاب --}}
                        <div class="row mb-3">
                            <label for="book_place" class="col-md-4 col-form-label text-md-end">مكان الكتاب</label>

                            <div class="col-md-6">
                                <input id="book_place" type="text" class="form-control" name="book_place" required />
                                <small id="book_place_error"></small>
                            </div>
                        </div>



                        <div class="row mb-0">

                            <div class="col-md-6 offset-md-4 mb-3">
                                <button type="button" class="btn btn-success" onclick="add_lending_Book()">
                                    حفظ البيانات
                                </button>
                            </div>
                        </div>




                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function get_lending_subjects() {
        $('#subject').empty();
library = $('#library').val();
section = $('#section').val();

if (library == 2) {

            $('#section_div').show();


            $.ajax({
                url: 'get_lending_subjects/' + library + '/' + section,
                method: 'get',
                success: response => {
                    response.forEach(res => {
                        let option = `<option value="${res.id}">${res.name}</option>`
                        $("#subject").append(option);
                    });

                }


            })
        }
            else {
                $('#section_div').hide();

                library = 1;
                section = 0;

                $.ajax({
                            url: 'get_lending_subjects/' + library + '/' + section,
                            method: 'get',
                            success: response => {
                                response.forEach(res => {
                                    let option = `<option value="${res.id}">${res.name}</option>`
                                    $("#subject").append(option);
                                });

                            }


                        })
                    }
                }




        function add_lending_Book(){

            // Reset all errors
            $('#library_error').text('');
            $('#book_code_error').text('');
            $('#book_name_error').text('');
            $('#book_description_error').text('');
            $('#book_year_error').text('');
            $('#book_copies_error').text('');
            $('#book_place_error').text('');

            var formData = new FormData($('#addUserForm')[0]);
            console.log(formData)

            $.ajax({
                type: 'post'
                , url: ' {{route('create_lending_Book')}}'
                , data: formData
                , processData: false
                , contentType: false
                , cache: false
                , success: function(data) {

                    Swal.fire({
                        icon: 'success',
                        title: 'تم الحفظ بنجاح',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#addUserForm').trigger("reset");
                }
                , error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
    }



</script>


@endsection

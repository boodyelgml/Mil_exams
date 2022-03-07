@extends('layouts.app')

<script src="{{ asset('js/jquery3.3.js') }}"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('home')}}" class="btn btn-primary" id="addUser">
                العودة للرئيسية
            </a>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="alert alert-info text-center">طلب إستعارة جديد </div>
                <div class="card-body">
                    <form form class="form-horizontal" id="addUserForm">
                        @csrf


                        <input id="book_id" type="text" class="form-control" value="{{$book->id}}" name="book_id" required readonly hidden/>

                        {{-- كود الكتاب --}}

                        <div class="row mb-3">
                            <label for="book_code" class="col-md-4 col-form-label text-md-end">كود الكتاب</label>

                            <div class="col-md-6">
                                <input id="book_code" type="text" class="form-control" value="{{$book->book_code}}" name="book_code" required readonly/>
                                <small id="book_code_error"></small>
                            </div>
                        </div>


                        {{-- إسم الكتاب --}}

                        <div class="row mb-3">
                            <label for="book_name" class="col-md-4 col-form-label text-md-end">إسم الكتاب</label>


                            <div class="col-md-6">

                                <input id="book_name" type="text" class="form-control" value="{{$book->book_name}}" name="book_name" required readonly/>
                                <small id="book_name_error"></small>

                            </div>
                        </div>




                        {{-- تاريخ الإستعارة --}}
                        {{-- <div class="row mb-3">
                            <label for="lending_start_date" class="col-md-4 col-form-label text-md-end">تاريخ الإستعارة</label>

                            <div class="col-md-6">

                                <input id="lending_start_date" type="text" class="form-control" name="lending_start_date" required />
                                <small id="lending_start_date_error"></small>

                            </div>
                        </div> --}}


                        {{-- تاريخ الرد --}}
                        {{-- <div class="row mb-3">
                            <label for="lending_end_date" class="col-md-4 col-form-label text-md-end">تاريخ الإستعارة</label>

                            <div class="col-md-6">

                                <input id="lending_end_date" type="text" class="form-control" name="lending_end_date" required />
                                <small id="lending_end_date_error"></small>

                            </div>
                        </div> --}}



                        {{-- الرتبة / الدرجة --}}
                        <div class="row mb-3">
                            <label for="rotba" class="col-md-4 col-form-label text-md-end">الرتبة / الدرجة</label>

                            <div class="col-md-6">

                                <input id="rotba" type="text" class="form-control" name="rotba" required />
                                <small id="rotba_error"></small>

                            </div>
                        </div>





                        {{-- إسم المستعير--}}

                        <div class="row mb-3">
                            <label for="lender_name" class="col-md-4 col-form-label text-md-end">إسم المستعير</label>

                            <div class="col-md-6">
                                <input id="lender_name" type="text" class="form-control" name="lender_name"
                                    required />
                                <small id="lender_name_error"></small>
                            </div>
                        </div>




                        {{-- الوحدة --}}
                        <div class="row mb-3">
                            <label for="unit" class="col-md-4 col-form-label text-md-end">الوحدة</label>

                            <div class="col-md-6">
                                <input id="unit" type="text" class="form-control" name="unit" required />
                                <small id="unit_error"></small>
                            </div>
                        </div>


                        {{-- رقم التليفون --}}
                        <div class="row mb-3">
                            <label for="mobile_number" class="col-md-4 col-form-label text-md-end">رقم الهاتف</label>

                            <div class="col-md-6">
                                <input id="mobile_number" type="number" class="form-control" name="mobile_number" required />
                                <small id="mobile_number_error"></small>
                            </div>
                        </div>



                        <div class="row mb-0">

                            <div class="col-md-6 offset-md-4 mb-3">
                                <button type="button" class="btn btn-success" onclick="add_lending_Request()">
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
@endsection




<script>


    function add_lending_Request(){

        // Reset all errors
        $('#book_code_error').text('');
        $('#book_name_error').text('');
        $('#lending_start_date_error').text('');
        $('#lending_end_date_error').text('');
        $('#rotba_error').text('');
        $('#lender_name_error').text('');
        $('#unit_error').text('');
        $('#mobile_number_error').text('');

        var formData = new FormData($('#addUserForm')[0]);
        console.log(formData)

        $.ajax({
            type: 'post'
            , url: ' {{route('add_lending_Request')}}'
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

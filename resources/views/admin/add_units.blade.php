@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="./to_admin_dashboard" class="btn btn-primary" id="addUser">
                العودة للسابق
            </a>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="alert bg-dark text-white text-center">إضافة وحدة جديدة</div>
                <div class="card-body">
                    <form form class="form-horizontal" id="add_exam">
                        {{ csrf_field() }}


                        {{-- name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">إسم الوحدة</label>

                            <div class="col-md-6">

                                <input id="name" type="text" class="form-control" name="name" required />
                                <small id="name_error"></small>

                            </div>
                        </div>




                    </form>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button onclick="addُExam()" class="btn btn-success" id="addُExam">
                                إضافة الوحدة
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <meta name="csrf_token" content="{{ csrf_token() }}" />


        </div>


    </div>
        </div>
    </div>
</div>
@endsection

<script>


    function addُExam(){

        // Reset all errors
        $('#name_error').text('');

        var formData = new FormData($('#add_exam')[0]);
            console.log(formData)

            $.ajax({
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                type: 'post'
                , url: ' {{route('create_unit')}}'
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
                    $('#add_exam').trigger("reset");
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

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12 mb-2">
        <a href="./file" class="btn btn-primary" id="addUser">
            العودة للسابق
        </a>

    </div>


    <div class="card">
        <div class="card-body">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="container">
                <div class="row">
                    <div class="alert bg-dark text-white text-center">
                         إضافة ملفات ومرئيات للمكتبة الألكترونية
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <form id="addSubjectForm" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}




                            <div class="form-group">
                                <label for="library" class="mb-2">المادة</label>

                                <select onchange="get_subjects()" class="form-select" name="library" id="library"
                                    required>
                                    <option value="0" disabled selected>اختار المكتبة</option>
                                    <option value="1">الكتب العامة</option>
                                    <option value="2">الكتب العسكرية</option>
                                </select>

                                <small id="library_error"></small>

                            </div>


                            <div class="form-group" style="display: none" id="section_div">
                                <label for="section" class="mb-2">القسم</label>

                                <select class="form-select" name="section" id="section" required>
                                    <option disabled selected>اختار القسم</option>
                                    <option value="1">كتب ومراجع</option>
                                    <option id="normal" value="2">المحتوى المطور</option>
                                    <option id="mil" value="3">المحتوى المطور</option>
                                </select>


                                <small id="library_error"></small>

                            </div>



                            <div class="form-group">
                                <label for="subject" class="mb-2">المادة</label>
                                <input type="text" name="subject_name" class="form-control">
                                <small id="subject_error"></small>
                            </div>



                        </form>
                        <div class="row mb-0">
                            <div class="col-md-6">
                                <button onclick="addSubject()" class="btn btn-success" id="addSubject">
                                    إضافة مادة
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection

<script>
    function addSubject(){


    var formData = new FormData($('#addSubjectForm')[0]);
        console.log(formData)

        $.ajax({
            type: 'post'
            , url: ' {{route('create_subject')}}'
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
                $('#addSubjectForm').trigger("reset");
            }
            , error: function(reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val) {
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    }


    function get_subjects(){

        $('#section_div').css("display","block");

        library = $('#library').val();

        if(library == 1){
            $('#mil').hide();
            $('#normal').show();

        }else if(library == 2){

            $('#normal').hide();
            $('#mil').show();
        }
    }



</script>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12 mb-2">
        <a href="./add_new_books_to_lending_library_view" class="btn btn-primary" id="addUser">
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
                         إضافة مواد لمكتبة الأستعارة
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
                                    <option value="1">الكتب العامة</option>
                                    <option value="2">الكتب العسكرية</option>
                                </select>

                                <small id="library_error"></small>

                            </div>


                            <div class="form-group" style="display: none" id="sections">
                                <label for="section" class="mb-2">القسم</label>

                                <select  class="form-select" name="section" id="section" required>
                                    <option disabled selected value="0">اختار القسم</option>
                                    <option value="1">القسم العام</option>
                                    <option value="2">القسم التخصصى</option>
                                </select>


                                <small id="section_error"></small>

                            </div>



                            <div class="form-group">
                                <label for="subject" class="mb-2">المادة</label>
                                <input type="text" name="subject_name" class="form-control" id="subject">
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
            , url: ' {{route('create_lending_subject')}}'
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
                $('#sections').css('display' , 'none')
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

        library = $('#library').val();
        section = $('#section').val();

        if(library == 2){

            $('#sections').css('display' , 'block')



        }else{
            $('#sections').css('display' , 'none')
        }



    }



</script>

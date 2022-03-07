@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="../exams_list" class="btn btn-primary" id="addUser">
                العودة للسابق
            </a>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="alert bg-dark text-white text-center">{{$exam->name}}</div>
                <div class="card-body">
                    <form form class="form-horizontal" id="count">
                        {{ csrf_field() }}

                        <input type="number" name="exam_id" value="{{$exam->id}}" hidden>

                         {{-- name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">عدد الاسئلة فى المادة</label>

                            <div class="col-md-6">

                                <input id="question_display_count" type="text" class="form-control" name="question_display_count" value="{{$exam->question_display_count}}" required />
                                <small id="question_display_count_error"></small>

                            </div>
                        </div>

                    </form>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button onclick="update_questions_count()" class="btn btn-success" id="update_questions_count">
                                تعديل عدد الأسئلة
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


    function update_questions_count(){

        // Reset all errors
        $('#question_display_count_error').text('');

        var formData = new FormData($('#count')[0]);
            console.log(formData)

            $.ajax({
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                type: 'post'
                , url: ' {{route('update_exam_questions_count')}}'
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

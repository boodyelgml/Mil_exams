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
                <div class="alert alert-info text-center">إضافة سؤال جديد </div>
                <div class="card-body">
                    <form form class="form-horizontal" id="addQuestionForm">
                        @csrf


                        <div class="row">
                            {{-- المادة --}}
                            <div class="col-md-5">
                                <div class="row mb-3">

                                    <label class="col-md-2 col-form-label text-md-end">المادة</label>

                                    <div class="col-md-10">

                                        <select style="height: 350px" class="form-select" name="exam[]" id="exam" required multiple>
                                            @foreach ($exams as $exam)
                                            <option value="{{$exam->id}}">{{$exam->name}} </option>
                                            @endforeach

                                        </select>
                                        <small id="exam_error"></small>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label text-md-end">السؤال : </label>

                                    <div class="col-md-9 mb-3">
                                        <input class="form-control " type="text" name="question"
                                            placeholder="اكتب السؤال هنا">
                                        <small id="question_error"></small>

                                    </div>

                                    <label class="col-md-3 col-form-label text-md-end">الاختيارات : </label>

                                    <div class="col-md-9">


                                        <input class="form-control mb-1" type="text" name="answer1"
                                            placeholder="الإختيار الاول">
                                        <small id="answer1_error"></small>

                                        <input class="form-control mb-1" type="text" name="answer2"
                                            placeholder="الإختبار الثانى">
                                        <small id="answer2_error"></small>

                                        <input class="form-control mb-1" type="text" name="answer3"
                                            placeholder="الإختبار الثالث">
                                        <small id="answer3_error"></small>

                                        <input class="form-control mb-1" type="text" name="answer4"
                                            placeholder="الإختبار الرابع">
                                        <small id="answer4_error"></small>

                                    </div>
                                </div>


                                <div class="row mb-3">

                                    <label class="col-md-3 col-form-label text-md-end">الاجابة الصحيحة</label>

                                    <div class="col-md-9">

                                        <select class="form-select" name="is_correct" id="is_correct" required>
                                            <option value="" selected disabled>الأجابة الصحيحة </option>

                                            <option value="1">الاختيار الأول </option>
                                            <option value="2">الاختيار الثانى </option>
                                            <option value="3">الاختيار الثالث </option>
                                            <option value="4">الاختيار الرابع </option>


                                        </select>
                                        <small id="is_correct_error"></small>

                                    </div>

                                </div>



                            </div>
                        </div>



                    </form>


                    <div class="row mb-0">
                        <div class="col-md-6">
                            <button onclick="addQuestion()" class="btn btn-success" id="addQuestion">
                                إضافة سؤال
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function checkIfUserExist(){

        $('#namazeg').empty();

        var factionId = $('#faction').val();

        $.ajax({
            url: '{{route("checkIfUserExist")}}'
            , method: 'get'
            , data: {
                factionId
            }
            , success: response => {
                console.log(response)
                if (response) {

                    // insert items to dom
                    response.forEach(item => {
                        console.log(item.name)
                        var node = $(`<option style="border-bottom:1px solid #f1f1f1;" value="${item.id}">${item.name}</option>`);
                        $('#namazeg').append(node);
                    });

                }
                if ($('#namazeg > option').length == 0) {
                    var node = $(`<option disabled style="background:red; color:white">لا يوجد نماذج للفصيلة</option>`);
                    $('#namazeg').append(node);
                }
            }
        });

}


    function addQuestion(){

        // Reset all errors
        $('#exam_error').text('');
        $('#question_error').text('');
        $('#answer1_error').text('');
        $('#answer2_error').text('');
        $('#answer3_error').text('');
        $('#answer4_error').text('');
        $('#is_correct_error').text('');

        var formData = new FormData($('#addQuestionForm')[0]);
        console.log(formData)

        $.ajax({
            type: 'post'
            , url: ' {{route('create_question')}}'
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
                $('#addQuestionForm').trigger("reset");
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

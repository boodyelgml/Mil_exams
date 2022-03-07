@extends('layouts.app')
<script src="{{ asset('js/jquery.js') }}"></script>
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
                <div class="alert bg-dark text-white text-center">إضافة تخصص او مستوى جديد</div>
                <div class="card-body">
                    <form form class="form-horizontal" id="add_exam">
                        {{ csrf_field() }}


                        {{-- name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">نوع الإختبار او التخصص</label>

                            <div class="col-md-6">

                                <input id="name" type="text" class="form-control" name="name" required />
                                <small id="name_error"></small>

                            </div>
                        </div>




                    </form>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button onclick="addُExam()" class="btn btn-success" id="addُExam">
                                إضافة نوع الإختبار
                            </button>
                        </div>
                    </div>
                </div>






            </div>

            <div class="card mt-2">
                <div class="card-body">


                    <table id="example" class="table-sm display table table-bordered datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">نوع الإختبار</th>
                                <th scope="col">الأوامر</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($levels as $level)
                                <tr>
                                    <td>{{$level->name}}</td>
                                    <td>
                                        <button id="delete" class="btn btn-danger btn-sm" question_id="{{ route('delete_level',  $level->id ) }}"  value="{{ $level->id }}">حذف</button>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>



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
                , url: ' {{route('create_level')}}'
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




    $(document).on('click', "#delete", function(e) {

        $('.loader').fadeOut(100)
        e.preventDefault();
        Swal.fire({

                title: 'تأكيد الحذف ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم إمسح!',
                cancelButtonText: 'لا '
            })
            .then((willDelete) => {

                if (willDelete.isConfirmed) {
                    var examId = $(this).attr('question_id');
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
                } else {
                    Swal.fire("لم يتم الحذف");
                }

            });
    });


</script>

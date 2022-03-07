<script src="{{ asset('js/jquery3.3.js') }}"></script>



@extends('layouts.app')

{{-- @if (Auth::user()->is_user_did_exam_before == 0) --}}


@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <div class="container-fluid">

        <div class="div">

            <a href="../" class="btn btn-primary m-2" id="addUser">
                العودة للرئيسية
            </a>
            <a href="./to_admin_dashboard" class="btn btn-primary " id="addUser">
                العودة للسابق
            </a>
        </div>


        <div class="card">

            <div class="card card-body">
                <div class="alert bg-dark text-white text-center ">ملخص المواد </div>
                <div class="card-body">


                    <table id="example" class="table-sm display table table-bordered datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">إسم المادة</th>
                                <th scope="col">عدد الأسئلة للمختبر</th>
                                <th scope="col">الأوامر</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($exams as $exam)
                                <tr>
                                    <td>{{ $exam->name }}</td>
                                    <td>




                                        {{ $exam->question_display_count }}

                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('review_exam_questions', $exam->id) }}">مراجعة
                                            الأسئلة</a>


                                        <a href="{{ route('change_exam_questions_count', $exam->id) }}"  class="btn btn-success btn-sm">
                                            تعديل عدد الأسئلة للمختبر</a>

                                            <button class="btn btn-danger btn-sm" exam_id="{{ route('delete_exam_by_id', $exam->id) }}" id="Delete">  حذف المادة</button>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>



    </div>
    </div>



    </div>
@endsection

<script>




    $(document).on('click', "#Delete", function(e) {

        e.preventDefault();
        $('.loader').fadeOut(100)
        Swal.fire({
                title: 'هل أنت متأكد من حذف هذه المادة?',
                showDenyButton: true,
                confirmButtonText: 'نعم إمسح!',
                denyButtonText: `لا `,
            })
            .then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var examId = $(this).attr('exam_id');
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
                } else if (result.isDenied) {
                    Swal.fire('لم يتم الحذف', '', 'info')
                }
            })


    });
</script>

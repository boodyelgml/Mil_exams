<script src="{{ asset('js/jquery3.3.js') }}"></script>



@extends('layouts.app')

{{-- @if (Auth::user()->is_user_did_exam_before == 0) --}}


@section('content')

    <div class="container">

        <div class="div">

            <a href="../" class="btn btn-primary m-2" id="addUser">
                العودة للرئيسية
            </a>

            <a href="../exams_list" class="btn btn-primary m-2" id="addUser">
                العودة للسابق
            </a>
        </div>


        <div class="card">
            <div class="card-header bg-dark text-white text-center">
                <h4>{{ $exam->name }}</h4>
                <h5>{{ count($questions) }} سؤال</h5>
            </div>
            <div class="card-body">
                <meta name="csrf_token" content="{{ csrf_token() }}" />
                @foreach ($questions as $q)



                    <br>
                    <hr>

                    <br>
                    <h4 style="color: red; font-weight:600">س: {{ $q->q_name }}
                        <button question_id="{{ route('delete_exam',  [$exam->id , $q->q_id] ) }}" id="deleteModeratorButton"
                            class="btn btn-danger btn-sm">حذف</button>
                    </h4>

                    @foreach ($questions_choises as $choise)
                        @if ($choise->question_id == $q->q_id)

                            @if ($choise->is_correct)
                                - <span style="color: blue; font-weight:600">{{ $choise->title }}</span><br>
                            @else
                                - <span>{{ $choise->title }}</span><br>
                            @endif

                        @endif
                    @endforeach



                @endforeach

            </div>
        </div>


    </div>
    </div>



    </div>
@endsection

<script>
    $(document).on('click', "#deleteModeratorButton", function(e) {


        e.preventDefault();


        $('.loader').fadeOut(100)
        Swal.fire({
            title: 'تأكيد الحذف ?',
            showDenyButton: true,
            confirmButtonText: 'نعم إمسح!',
            denyButtonText: `لا `,
            })
            .then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
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
            } else if (result.isDenied) {
                Swal.fire('لم يتم الحذف', '', 'info')
            }
        })

    });
</script>

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-md-12 mb-3">
            <a href="{{ route('library') }}" class="btn btn-primary" id="addUser">
                العودة للسابق
            </a>
            <a href="{{ route('upload_here', [$cat_id, $subject_id]) }}" class="btn btn-success" id="addUser">
                إضافة ملفات هنا
            </a>
        </div>


        <div class="row" style="padding: 0px 250px">
            @if (count($books) > 0)
                @foreach ($books as $file)
                    <a href="{{ asset('files/' . $file->name) }}"
                        class="list-group-item list-group-item-action text-center">
                        {{ $file->original_name }}</a>

                    </a>

                    @auth
                        <button class="btn btn-danger mb-2" exam_id="{{ route('delete_item', $file->id) }}" id="Delete">حذف</button>
                    @endauth
                @endforeach

            @else
                <a class="list-group-item list-group-item-action disabled text-center">لا يوجد ملفات لهذة المادة</a>
            @endif
        </div>


    </div>

    </div>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                'iDisplayLength': 100
            });
            table
                .order([1, 'dsc'])
                .draw();
        });








        $(document).on('click', "#Delete", function(e) {

            e.preventDefault();
            $('.loader').fadeOut(100)
            Swal.fire({
                    title: 'هل أنت متأكد من حذف هذا الملف?',
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
@endsection

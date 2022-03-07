@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-12 mb-3">
            <button onclick="back()" class="btn btn-primary" id="addUser">
                العودة للسابق
            </button>
        </div>


        <div class="row" style="padding: 0px 250px">


            @if (count($books) > 0)
                <?php $catName = []; ?>
                @foreach ($books as $file)
                    @if ($file->cat == null)
                        <a href="{{ asset('files/' . $file->name) }}"
                            class="list-group-item list-group-item-action text-center">
                            {{ $file->original_name }}</a>
                        @auth
                            <button class="btn btn-danger mb-2" exam_id="{{ route('delete_item', $file->id) }}"
                                id="Delete">حذف</button>
                        @endauth
                        </a>
                    @endif

                    @foreach ($item_cat as $cat)
                        @if ($file->cat == $cat->id && $cat->name == null)
                            <a href="{{ asset('files/' . $file->name) }}"
                                class="list-group-item list-group-item-action text-center">
                                {{ $file->original_name }}</a>
                            @auth
                                <button class="btn btn-danger mb-2" exam_id="{{ route('delete_item', $file->id) }}"
                                    id="Delete">حذف</button>
                            @endauth
                            </a>
                        @endif
                    @endforeach


                    @foreach ($item_cat as $cat)
                        @if ($cat->id == $file->cat)
                            @if (!in_array($cat->id, $catName))
                                <a href="{{ route('sub_subject', [$file->subject_id, $cat->id]) }}" style="color: blue"
                                    class="list-group-item list-group-item-action text-center">
                                    {{ $cat->name }}</a>

                                <?php $catName[] = $cat->id; ?>
                            @endif
                        @endif
                    @endforeach
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
                    title: 'تأكيد الحذف?',
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



        function back(){
            window.history.back();
        }


    </script>
@endsection

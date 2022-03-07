@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-md-12 mb-3">
            <button onclick="back()" class="btn btn-primary" id="addUser">
                العودة للسابق
            </button>
        </div>


        <div class="row" style="padding: 0px 250px">

            @if (count($subjects) > 0)
                @foreach ($subjects as $subject)
                    <div class="list-group mt-3">

                        <a href="{{ route('open_library_subject_files', $subject->id) }}"
                            class="list-group-item list-group-item-action active text-center">
                            {{ $subject->name }}
                        </a>

                    </div>
                @endforeach
                @else
                <div class="alert alert-danger text-center">
                    لا يوجد محتوى فى هذا القسم
                </div>
            @endif
        </div>

    </div>

    <script>
        function back(){
            window.history.back();
        }
    </script>
@endsection

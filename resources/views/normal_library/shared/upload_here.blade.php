@extends('layouts.app')

@section('content')

<div id="back_buttons">
    <a href="./library" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>

<div class="container">



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
                         إضافة ملفات ومرئيات للقسم
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ route('uploadHereSubmit') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                           <input type="text" name="cat_id" value="{{$cat_id}}" hidden>
                           <input type="text" name="subject_id" value="{{$subject_id}}" hidden>
                           <input type="text" name="library_id" value="{{$library_id}}" hidden>
                           <input type="text" name="section_id" value="{{$section_id}}" hidden>



                            <br />
                            <label for="files" class="mb-2">الملفات</label>
                            <input type="file" class="form-control" name="files[]" multiple />
                            <br /><br />
                            <input type="submit" class="btn btn-primary" value="إضافة" />
                        </form>
                    </div>
                </div>

                @if(session()->has('message'))
                <div class="alert alert-success mt-2">
                    {{ session()->get('message') }}
                </div>
                @endif

            </div>

        </div>
    </div>
</div>




@endsection

<script>
    function get_subjects(){
        $('#section_div').css("display","block");

      $("#subject").empty();
        library = $('#library').val();
        section = $('#section').val();

        if(library == 1){
            $('#mil').hide();
            $('#normal').show();

        }else if(library == 2){

            $('#normal').hide();
            $('#mil').show();
        }

        $.ajax({
        url: 'get_subjects/' + library +'/' + section,
        method: 'get',
        data: {
            library
        },
        success: response => {

            response.forEach(res => {
                let option = `<option value="${res.id}">${res.name}</option>`
                $("#subject").append(option);
            });

        }
    });

    }
</script>

@extends('layouts.app')

@section('content')

<div id="back_buttons">
    <a href="./library" class="to_back btn btn-sm btn-primary">العودة للسابق</a>
    <a href="./" class="to_main btn btn-sm btn-success">العودة للرئيسية</a>
</div>

<div class="container">
    <div class="col-md-12 mb-2">

        <a href="./add_subjects" class="btn btn-success">
            إضافة مواد للمكتبة
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
                         إضافة ملفات ومرئيات للمكتبة الألكترونية
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ route('uploadSubmit') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="library" class="mb-2">المكتبة</label>

                                <select onchange="get_subjects()" class="form-select" name="library" id="library"
                                    required>
                                    <option disabled selected>اختار المكتبة</option>
                                    <option value="1">الكتب العامة</option>
                                    <option value="2">الكتب العسكرية</option>
                                </select>


                                <small id="library_error"></small>

                            </div>


                            <div class="form-group" style="display: none" id="section_div">
                                <label for="section" class="mb-2">القسم</label>

                                <select onchange="get_subjects()" class="form-select" name="section" id="section" required>
                                    <option disabled selected>اختار القسم</option>
                                    <option value="1">كتب ومراجع</option>
                                    <option id="normal" value="2">المحتوى المطور</option>
                                    <option id="mil" value="3">المحتوى المطور</option>
                                </select>


                                <small id="library_error"></small>

                            </div>



                            <div class="form-group">
                                <label for="subject" class="mb-2">المادة</label>

                                <select class="form-select" name="subject" id="subject" required>


                                </select>
                                <small id="subject_error"></small>

                            </div>


                            <div class="form-group">
                                <label for="cat" class="mb-2">التصنيف</label>

                                <input type="text" class="form-control" name="cat" id="cat">


                                <small id="cat_error"></small>

                            </div>


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

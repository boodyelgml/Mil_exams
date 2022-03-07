@extends('layouts.app')

<script src="{{ asset('js/jquery3.3.js') }}"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="./" class="btn btn-primary" id="addUser">
                    العودة للرئيسية
                </a>
            </div>

            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="alert  text-center text-white bg-dark">الإختبارات</div>
                    <div class="card-body">
                        <form form class="form-horizontal" id="addUserForm">
                            @csrf

                            {{-- الرقم العسكرى --}}
                            <div class="row mb-3">
                                <label for="mil_number" class="col-md-4 col-form-label text-md-end">الرقم العسكرى</label>

                                <div class="col-md-6">

                                    <input id="mil_number" type="number" oninput="checkIfUserExist()" class="form-control"
                                        name="mil_number" required />
                                    <small id="mil_number_error"></small>

                                </div>
                            </div>


                            {{-- الرتبة / الدرجة --}}
                            <div class="row mb-3">
                                <label for="rotba" class="col-md-4 col-form-label text-md-end">الرتبة / الدرجة والإسم</label>

                                <div class="col-md-2">
                                    <select class="form-select" name="rotba" id="rotba" required>

                                        <option value="" selected disabled>الرتبة / الدرجة</option>
                                        @foreach ($rotbas as $rotba)
                                            <option value="{{ $rotba->id }}">{{ $rotba->name }}</option>
                                        @endforeach

                                    </select>

                                    <small id="rotba_error"></small>


                                </div>



                                <div class="col-md-4">

                                    <input id="name" type="text" class="form-control" name="name" required
                                        placeholder="الإسم" />
                                    <small id="name_error"></small>

                                </div>
                            </div>


                            {{-- السلاح --}}
                            <div class="row mb-3">
                                <label for="weapon" class="col-md-4 col-form-label text-md-end">السلاح</label>

                                <div class="col-md-6">

                                    <select class="form-select " name="weapon" id="weapon">

                                        @foreach ($weapons as $weapon)
                                            <option value="{{ $weapon->name }}">{{ $weapon->name }}</option>
                                        @endforeach

                                    </select>
                                    <small id="weapon_error"></small>

                                </div>
                            </div>

                            {{-- الوحدة --}}
                            <div class="row mb-3">
                                <label for="unit" class="col-md-4 col-form-label text-md-end">الوحدة</label>

                                <div class="col-md-6 form-group">
                                    <select class="form-select" name="unit" id="unit">

                                        <option value="" selected disabled>الوحدة</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    <small id="unit_error"></small>

                                </div>
                            </div>

                            {{-- الوظيفة --}}
                            <div class="row mb-3">
                                <label for="job" class="col-md-4 col-form-label text-md-end">الوظيفة</label>

                                <div class="col-md-6">

                                    <input id="job" type="text" class="form-control" name="job" required />
                                    <small id="job_error"></small>

                                </div>
                            </div>




                            {{-- نوع الإختبار --}}
                            <div class="row mb-3">
                                <label for="level" class="col-md-4 col-form-label text-md-end">نوع الإختبار</label>

                                <div class="col-md-6">
                                    <select class="form-select " name="level" id="level">

                                        <option value="" selected disabled>نوع الإختبار</option>

                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach

                                    </select>
                                    <small id="level_error"></small>

                                </div>
                            </div>


                            {{-- نوع الإختبار --}}
                            <div class="col-md-6 offset-md-4">

                            </div>


                            {{-- password --}}
                            <div class="row mb-3" style="display: none">

                                <label for="password" class="col-md-4 col-form-label text-md-end">الرقم السرى</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" value="123456789" class="form-control"
                                        name="password" required>
                                    <small id="password_error"></small>
                                </div>

                            </div>



                            <div class="row mb-0">

                                <div class="col-md-6 offset-md-4 mb-3">
                                    <button type="button" onclick="saveUser()" class="btn btn-success" id="createUser">
                                        حفظ البيانات
                                    </button>

                                    <button type="button" onclick="saveUser()" class="btn btn-success" id="updateUser">
                                        تعديل البيانات
                                    </button>

                                    <button style="width: 150px; " type="button" onclick="start_Exam()" id="startExam"
                                        class="btn btn-primary" id="startExam">
                                        بدأ الإختبار
                                    </button>
                                </div>


                            </div>










                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {

        $('#updateUser').hide();
        $('#startExam').hide();
    })






    function checkIfUserExist() {

        var mil_number = $('#mil_number').val();

        $.ajax({
            url: '{{ route('checkIfUserExist') }}',
            method: 'get',
            data: {
                mil_number
            },
            success: response => {

                console.log(response.unit_id);
                // insert items to dom
                if (response != 0) {
                    console.log(response.name)
                    $('#rotba').val(response.rotba_id);
                    $('#name').val(response.name);
                    $('#weapon').val(response.weapon_name);
                    $('#unit').val(response.unit_id);
                    $('#job').val(response.job_name);
                    $('#weapon').val(response.weapon_name);

                    if (response.level_id != null) {
                        $('#level').val(response.level_id);
                        $('#updateUser').show();
                        $('#startExam').show();
                    }

                    $('#updateUser').show();
                    $('#createUser').hide();
                } else if (response == 0) {
                    $('#updateUser').hide();
                    $('#startExam').hide();
                    $('#createUser').show();
                    $('#rotba').val("");
                    $('#name').val("");
                    $('#unit').val("");
                    $('#job').val("");
                    $('#weapon').val("");
                    $('#level').val("");
                }

            }
        });

    }

    var result = 0;

    function saveUser() {
        mil_number = $('#mil_number').val();
        // Reset all errors
        $('#mil_number_error').text('');
        $('#rotba_error').text('');
        $('#name_error').text('');
        $('#unit_error').text('');
        $('#job_error').text('');
        $('#weapon_error').text('');
        $('#level_error').text('');

        var formData = new FormData($('#addUserForm')[0]);
        console.log(formData)

        $.ajax({
            type: 'post',
            url: ' {{ route('createUser') }}',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                result = 1;
                Swal.fire({
                    icon: 'success',
                    title: 'تم الحفظ بنجاح',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#updateUser').show();
                $('#createUser').hide();
                $('#startExam').show();

            },
            error: function(reject) {
                result = 0;
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val) {
                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    }




    function start_Exam() {
        $('.loader').fadeIn()
        window.location = './start_exam/' + $('#mil_number').val();
    }
</script>

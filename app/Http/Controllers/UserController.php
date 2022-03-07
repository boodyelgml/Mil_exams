<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\factions;
use App\Models\final_result;
use App\Models\final_result_log;
use App\Models\level;
use App\Models\rotba;
use App\Models\timer;
use App\Models\units;
use App\Models\User;
use App\Models\user_role;
use App\Models\weapon;
use App\Models\weapons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function to_exams()
    {
        $unit = units::all();
        $rotba = rotba::all();
        $level = level::all();
        $weapons = weapons::all();
        return view('exams.to_exams', ['rotbas' => $rotba, 'levels' => $level, 'units' => $unit, 'weapons' => $weapons]);
    }


    public function result_by_unit()
    {
        $units = units::all();

        return view('admin.result_by_unit' , ['units' => $units]);
    }


    public function custom_result()
    {

        $user_results = final_result_log::all();
        $users = User::all();
        $timer = timer::first();
        $rotbas = rotba::all();
        $units = units::all();
        $levels = level::all();
        $final_results = final_result::all();

        return view('admin.custom_result', ['users' => $users, 'rotbas' => $rotbas, 'units' => $units, 'levels' => $levels, 'timer'=>$timer,'final_results' => $final_results,'user_results' => $user_results]);
    }

    public function get_custom_results($id)
    {
        $user_results = final_result_log::where('user_id' , $id)->get();
        return $user_results;
    }

    public function get_custom_result_data($id)
    {
        $user_results = final_result_log::where('id' , $id)->first();
        return $user_results;
    }

    public function get_unit_results($id){
        $user = User::where('unit_id' , $id)->get();

        foreach($user as $us){
            $us->rotba_id = rotba::where('id' , $us->rotba_id)->first()->name;
            $us->level_id = level::where('id' , $us->level_id)->first()->name;
        }
        return  $user;
    }

    public function to_admin_dashboard()
    {

        $users = User::all();
        $timer = timer::first();
        $rotbas = rotba::all();
        $units = units::all();
        $levels = level::all();
        $final_results = final_result::all();

        return view('admin.admin_dashboard', ['users' => $users, 'rotbas' => $rotbas, 'units' => $units, 'levels' => $levels, 'timer'=>$timer,'final_results' => $final_results]);
    }

    public function createUser(Request $request)
    {


        $userExist = User::where('mil_number', $request->mil_number)->first();

        if ($userExist == null) {

            $request->validate(
                [
                    'mil_number' => 'required|min:6|unique:Users',
                    'rotba' => 'required',
                    'name' => 'required|min:6',
                    'unit' => 'required|min:1',
                    'level' => 'required|min:1',
                    'job' => 'required|min:1',
                    'weapon' => 'required|min:1',
                    'password' => 'required|min:6',
                ],
                [
                    'mil_number.required' => 'يجب إدخال الرقم العسكرى',
                    'mil_number.min' => 'يجب ألا يقل الرقم العسكرى عن 6 ارقام',
                    'rotba.required' => 'يجب إختيار الرتبة / الدرجة',
                    'name.required' => 'يجب إدخال الإسم',
                    'level.required' => 'يجب إدخال نوع الإختبار',
                    'unit.required' => 'يجب إختيار الوحدة',
                    'weapon.required' => 'يجب إدخال إسم السلاح',
                    'job.required' => 'يجب إدخال الوظيفة داخل الوحدة',
                ]
            );

            $user = new User();
            $user->name =  $request->name;
            $user->mil_number = $request->mil_number;
            $user->email = $request->mil_number . "@military.com";
            $user->rotba_id = $request->rotba;
            $user->unit_id = $request->unit;
            $user->level_id = $request->level;
            $user->job_name = $request->job;
            $user->weapon_name = $request->weapon;
            $user->password = Hash::make($request->password);

            if ($request->level) {
                $user->level_id = $request->level;
            }

            $user->save();
            $userRole = new user_role();
            $userRole->user_id = $user->id;
            $userRole->role_id = 2;
            $userRole->save();
        } else {

            $request->validate([
                'mil_number' => 'required|min:6',
                'rotba' => 'required',
                'name' => 'required|min:6',
                'unit' => 'required|min:1',
                'level' => 'required|min:1',
                'job' => 'required|min:1',
                'weapon' => 'required|min:1',
                'password' => 'required|min:6',
            ],
            [
                'mil_number.required' => 'يجب إدخال الرقم العسكرى',
                'mil_number.min' => 'يجب ألا يقل الرقم العسكرى عن 6 ارقام',
                'rotba.required' => 'يجب إختيار الرتبة / الدرجة',
                'name.required' => 'يجب إدخال الإسم',
                'level.required' => 'يجب إدخال نوع الإختبار',
                'unit.required' => 'يجب إختيار الوحدة',
                'weapon.required' => 'يجب إدخال إسم السلاح',
                'job.required' => 'يجب إدخال الوظيفة داخل الوحدة',
            ]);


            $userExist->name =  $request->name;
            $userExist->mil_number = $request->mil_number;
            $userExist->email = $request->mil_number . "@military.com";
            $userExist->rotba_id = $request->rotba;
            $userExist->level_id = $request->level;
            $userExist->unit_id = $request->unit;
            $userExist->job_name = $request->job;
            $userExist->weapon_name = $request->weapon;

            if ($request->level) {
                $userExist->level_id = $request->level;
            }

            $userExist->save();
        }
    }





    public function re_exam($id)
    {
        $user = User::where('id' , $id)->first();
        $user->is_user_did_exam_before = 0;
        $user->save();
    }


    public function bulk_re_exam()
    {

        $user = User::all();

        foreach($user as $us){
            if(Carbon::now()->isSameDay($us->last_exam_date)) {
                continue;
            }else{
                $user_selected = User::where('id' , $us->id)->first();
                $user_selected->is_user_did_exam_before = 0;
                $user_selected->save();
            }
        }

        return true;
    }






    public function show_one_user($id)
    {
        $user = User::where('id', $id)->first();


        $rotbas = rotba::all();
        $units = units::all();
        $levels = level::all();

        $results = final_result::where('user_id', $id)->get();

        $result1 = array();
        $result2 = array();
        $result3 = array();
        $result4 = array();
        $result5 = array();
        $result6 = array();
        $result7 = array();
        $result8 = array();
        $result9 = array();
        $result10 = array();
        $result11 = array();
        $result12 = array();
        $result13 = array();
        $result14 = array();
        $result15 = array();
        $result16 = array();
        $result17 = array();
        $result18 = array();
        $result19 = array();
        $result20 = array();

        for ($i=0; $i < count($results) ; $i++) {
            if($results[$i]->exam_count == 1){
                $result1[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 2) {
                $result2[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 3) {
                $result3[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 4) {
                $result4[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 5) {
                $result5[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 6) {
                $result6[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 7) {
                $result7[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 8) {
                $result8[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 9) {
                $result9[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 10) {
                $result10[] = $results[$i];
            }
            elseif($results[$i]->exam_count == 11){
                $result11[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 12) {
                $result12[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 13) {
                $result13[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 14) {
                $result14[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 15) {
                $result15[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 16) {
                $result16[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 17) {
                $result17[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 18) {
                $result18[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 19) {
                $result19[] = $results[$i];
            }
            elseif ($results[$i]->exam_count == 20) {
                $result20[] = $results[$i];
            }

        }

        $resultss = array();
        $resultss[] = $result1;
        $resultss[] = $result2;
        $resultss[] = $result3;
        $resultss[] = $result4;
        $resultss[] = $result5;
        $resultss[] = $result6;
        $resultss[] = $result7;
        $resultss[] = $result8;
        $resultss[] = $result9;
        $resultss[] = $result10;
        $resultss[] = $result11;
        $resultss[] = $result12;
        $resultss[] = $result13;
        $resultss[] = $result14;
        $resultss[] = $result15;
        $resultss[] = $result16;
        $resultss[] = $result17;
        $resultss[] = $result18;
        $resultss[] = $result19;
        $resultss[] = $result20;

        return view('admin.result', ['results' => $resultss, 'user' => $user, 'rotbas' => $rotbas, 'units' => $units, 'levels' => $levels]);
    }


    public function add_weapon(){
        return view('admin.add_weapon');
    }


    public function create_weapon(Request $request){
        $request->validate([
            'name' => 'required|min:4',
        ], [
            'name.required' => 'إسم السلاح مطلوب',

        ]);

        $unit = new weapon();
        $unit->name = $request->name;
        $unit->save();
    }




}

class result
{
    public $total_answers;
    public $correct_answers;
    public $wrong_answers;
    public $exam_form_name;
    public $faction_name;
}

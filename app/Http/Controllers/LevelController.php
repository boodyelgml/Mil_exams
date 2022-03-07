<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\factions;
use App\Models\final_result;
use App\Models\level;
use App\Models\units;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class LevelController extends Controller
{
    public function add_level(){
        $levels = level::all();
        return view('admin.add_levels' , ['levels'=>$levels]);
    }


    public function create_level(Request $request){
        $request->validate([
            'name' => 'required|min:4',
        ], [
            'name.required' => 'نوع الإختبار او التخصص مطلوب',

        ]);

        $unit = new level();
        $unit->name = $request->name;
        $unit->save();
    }



}

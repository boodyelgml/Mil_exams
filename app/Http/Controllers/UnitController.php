<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\factions;
use App\Models\final_result;
use App\Models\units;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class UnitController extends Controller
{
    public function add_units(){
        return view('admin.add_units');
    }


    public function create_unit(Request $request){
        $request->validate([
            'name' => 'required|min:4',
        ], [
            'name.required' => 'إسم الوحدة مطلوب',

        ]);

        $unit = new units();
        $unit->name = $request->name;
        $unit->save();
    }



}

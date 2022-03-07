<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\factions;
use App\Models\final_result;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home' );
    }


    public function unAuthorized()
    {
        return view('unAuthorized');
    }

}

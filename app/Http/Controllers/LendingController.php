<?php

namespace App\Http\Controllers;

use App\Models\lending_library;
use App\Models\lending_log;
use App\Models\lending_subject;
use Carbon\Carbon;
use Illuminate\Http\Request;


class LendingController extends Controller
{
    public function open_lending_page(){
        return view('lending_library.lending_home_page');
    }

    public function add_new_books_to_lending_library_view(){
        return view('lending_library.add_new_books_to_lending_library_view');
    }


    public function create_lending_Book(Request $request){

        if($request->library == 1){
            $request->section = 0;
        }

        $request->validate([
            'library' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'book_code' => 'required',
            'book_name' => 'required',
            'book_description' => 'required',
            'book_year' => 'required',
            'book_copies' => 'required',
            'book_place' => 'required',
        ], [
            'library.required' => 'برجاء إختيار المكتبة',
            'section.required' => 'برجاء إختيار قسم المكتبة',
            'subject.required' => 'برجاء إختيار مادة الكتاب',
            'book_code.required' => 'حقل كود الكتاب مطلوب',
            'book_name.required' => 'حقل إسم الكتاب مطلوب',
            'book_description.required' => 'حقل موضوع الكتاب مطلوب',
            'book_year.required' => 'حقل سنة طباعة الكتاب مطلوب',
            'book_copies.required' => 'حقل عدد نسخ الكتاب مطلوب',
            'book_place.required' => 'حقل مكان الكتاب مطلوب',
        ]);


        $lending_library = new lending_library();
        $lending_library->book_name = $request->book_name;
        $lending_library->book_code = $request->book_code;
        $lending_library->book_description = $request->book_description;
        $lending_library->book_year = $request->book_year;
        $lending_library->book_copies = $request->book_copies;
        $lending_library->available_copies =  $request->book_copies;
        $lending_library->pending_copies =  0;
        $lending_library->book_place = $request->book_place;
        $lending_library->library_id = $request->library;
        $lending_library->library_section = $request->section;
        $lending_library->subject_id = $request->subject;
        $lending_library->save();


    }


    public function lending_list_view($libraryId , $sectionId){

        $lending_library = lending_subject::where([['library_id' , $libraryId] , ['section_id' , $sectionId]])->get();


        return view('lending_library.lending_list_view' , ['Books' => $lending_library]);

    }

    public function open_subject_books($subject_id){

        $lending_library = lending_library::where('subject_id' , $subject_id)->get();


        return view('lending_library.open_subject_books' , ['Books' => $lending_library]);

    }

    public function to_lending_military_library(){
        return view('lending_library.to_lending_military_library');
    }


    public function request_lend($bookId){
        $book = lending_library::where('id' , $bookId)->first();
        return view('lending_library.request_lend' , ['book' => $book]);
    }



    public function add_lending_Request(Request $request){

        $request->validate([
            //'lending_start_date' => 'required',
            //'lending_end_date' => 'required',
            'rotba' => 'required',
            'lender_name' => 'required',
            'unit' => 'required',
            'mobile_number' => 'required',
        ], [
            //'lending_start_date.required' => 'برجاء كتابة تاريخ الإستعارة',
            //'lending_end_date.required' => 'برجاء كتابة تاريخ الرد  ',
            'rotba.required' => 'برجاء كتابة الرتبة / الدرجة',
            'lender_name.required' => 'برجاء كتابة إسم المستعير',
            'unit.required' => 'برجاء كتابة إسم الوحدة',
            'mobile_number.required' => 'برجاء كتابة رقم هاتف المستعير',
        ]);

        $lending_library = lending_library::where('id' , $request->book_id)->first();
        $lending_library->available_copies = $lending_library->book_copies - 1;
        $lending_library->pending_copies = $lending_library->book_copies - $lending_library->available_copies;
        $lending_library->save();


        $lending_request = new lending_log();
        $lending_request->book_id = $request->book_id;
        $lending_request->lending_start_date = Carbon::now();
        $lending_request->lending_end_date = "-";
        $lending_request->rotba = $request->rotba;
        $lending_request->lender_name = $request->lender_name;
        $lending_request->unit = $request->unit;
        $lending_request->mobile_number = $request->mobile_number;
        $lending_request->save();

    }


    public function lending_log(){
        $lending_request =  lending_log::all();
        $lending_library =  lending_library::all();
        return view('lending_library.lending_log' , ['logs' => $lending_request , 'books' =>$lending_library]);
    }

    public function request_lend_restore($logId,$bookId){


        $lending_log = lending_log::where('id' , $logId)->first();
        $lending_log->lending_end_date = Carbon::now();
        $lending_log->is_active = 0;
        $lending_log->save();

        $lending_library = lending_library::where('id' , $bookId)->first();
        $lending_library->available_copies = $lending_library->available_copies + 1 ;
        $lending_library->pending_copies = $lending_library->book_copies - $lending_library->available_copies  ;
        $lending_library->save() ;

    }


    public function add_lending_subjects(){
        return view('lending_library.add_lending_subjects');
    }

    public function create_lending_subject(Request $request){

        if($request->library == 1){
            $request->section = 0;
        }

        $request->validate([
            'subject_name' => 'required',
            'library' => 'required',
            //'section' => 'required',
        ]);


        $lending_subject = new lending_subject();

        $lending_subject->name = $request->subject_name;
        $lending_subject->library_id = $request->library;
        $lending_subject->section_id = $request->section;
        $lending_subject->save();
    }

    public function get_lending_subjects($libraryId,$sectionId){
        $lending_subject = lending_subject::where([['library_id' , $libraryId],['section_id' , $sectionId]])->get();
        return $lending_subject;
    }

    public function lending_full_search(){
        $lending_library = lending_library::all();
        return view('lending_library.lending_full_search' ,['books' => $lending_library]);
    }


}

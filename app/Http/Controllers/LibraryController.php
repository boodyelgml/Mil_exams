<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\factions;
use App\Models\final_result;
use App\Models\item;
use App\Models\item_cat;
use App\Models\item_details;
use App\Models\lending_library;
use App\Models\subject;
use App\Models\User;
use Illuminate\Http\Request;

class LibraryController extends Controller
{


    public function to_upload_files()
    {
        return view('normal_library.shared.upload');
    }


    public function uploadSubmit(Request $request)
    {

        $item_cat = new item_cat();
        if (strlen($request->cat)) {

            $item_cat->name = $request->cat;
            $item_cat->subject_id = $request->subject;
            $item_cat->save();
        }

        $i = 0;
        foreach ($request->file('files') as $file) {
            $items = new item();

            if ($item_cat->id != null) {
                $items->cat = $item_cat->id;
            }

            // name it differently by time and count
            $file_name = time() . $i . '.' . $file->getClientOriginalExtension();
            // move the file to desired folder
            $file->move('files/', $file_name);
            // assign the location of folder to the model
            $items->name = $file_name;
            $items->original_name = $file->getClientOriginalName();
            $items->category = $request->library;
            $items->subject_id = $request->subject;
            $items->section_id = $request->section;
            $items->save();
            $i++;
        }
        return redirect()->back()->with('message', 'تم الرفع بنجاح');
    }


    public function uploadHereSubmit(Request $request)
    {

        $i = 0;
        foreach ($request->file('files') as $file) {
            $items = new item();
            $items->cat = $request->cat_id;
            // name it differently by time and count
            $file_name = time() . $i . '.' . $file->getClientOriginalExtension();
            // move the file to desired folder
            $file->move('files/', $file_name);
            // assign the location of folder to the model
            $items->name = $file_name;
            $items->original_name = $file->getClientOriginalName();
            $items->category = $request->library_id;
            $items->subject_id = $request->subject_id;
            $items->section_id = $request->section_id;
            $items->save();
            $i++;
        }
        return redirect()->back()->with('message', 'تم الرفع بنجاح');
    }


    public function upload_here($cat_id, $subject_id)
    {
        $library_id = subject::where('id', $subject_id)->first()->library_id;
        $section_id = subject::where('id', $subject_id)->first()->section_id;

        return view('normal_library.shared.upload_here', ['cat_id' => $cat_id, 'subject_id' => $subject_id, 'library_id' => $library_id, 'section_id' => $section_id]);
    }

    public function library()
    {
        return view('normal_library.index');
    }



    public function open_library($libraryId, $sectionId)
    {


        //$allFiles = item::where([['category', $libraryId] , ['section_id' , $sectionId]])->get();

        $allSubjects = subject::where([['library_id', $libraryId], ['section_id', $sectionId]])->get();

        // $images_ex = ['peg', 'jpg', 'png', 'PNG'];
        // $motawara_ex = ['ppt', 'pptx', 'pptm'];
        // $videos_ex = ['mp4', 'mpeg4', '3gp', 'FLV'];
        // $audios_ex = ['mp3', 'M4A', 'FLAC', 'WAV', 'WMA', 'AAC'];
        // $books_ex = ['xls', 'pdf', 'docx', 'doc', 'docs', 'ocx'];

        // $images =  array();
        // $videos = array();
        // $files = array();



        // foreach ($allFiles as $file) {

        //     $ext = substr($file->name, -3);
        //     $ext2 = substr($file->name, -4);

        //     if (in_array($ext, $videos_ex) || in_array($ext2, $videos_ex)) {
        //         $motawara_ex[] = $file;
        //     } elseif (in_array($ext, $books_ex) || in_array($ext2, $books_ex)) {
        //         $files[] = $file;
        //     } elseif (in_array($ext, $motawara_ex) || in_array($ext2, $books_ex)) {
        //         $motawara_ex[] = $file;
        //     } elseif (in_array($ext, $audios_ex) || in_array($ext2, $books_ex)) {
        //         $motawara_ex[] = $file;
        //     }
        // }


        return view('normal_library.shared.open_library', ['subjects' => $allSubjects]);
    }



    public function open_mil_library()
    {
        return view('normal_library.mil_library.mil_library');
    }



    public function open_normal_library()
    {
        return view('normal_library.culture_library.normal_library');
    }



    public function add_subjects()
    {
        return view('normal_library.shared.add_subjects');
    }



    public function create_subject(Request $request)
    {
        $subject = new subject();
        $subject->name = $request->subject_name;
        $subject->library_id = $request->library;
        $subject->section_id = $request->section;
        $subject->save();
    }



    public function get_subjects($id, $section)
    {
        $subject = subject::where([['library_id', $id], ['section_id', $section]])->get();
        return $subject;
    }



    public function full_search()
    {

        $items = item::all();
        $newItems = array();
        return view('normal_library.search.full_search', ['items' => $newItems]);
    }



    public function open_library_subject_files($subject_id)
    {

        $lending_library = item::where('subject_id', $subject_id)->get();
        $item_cat = item_cat::all();

        return view('normal_library.shared.open_library_subject_files', ['books' => $lending_library, 'item_cat' => $item_cat]);
    }



    public function sub_subject($subject_id, $cat_id)
    {
        $lending_library = item::where([['subject_id', $subject_id], ['cat', $cat_id]])->get();
        return view('normal_library.shared.sub_subject', ['books' => $lending_library, 'cat_id' => $cat_id, 'subject_id' => $subject_id]);
    }


    public function get_books_result($fileName)
    {

        $lending_library = item::where('original_name', 'LIKE', '%' . $fileName . '%')->get();

        $items = item::all();
        $cats = item_cat::all();
        $subject = subject::all();
        $newItems = array();

        foreach ($lending_library as $item) {
            if(subject::where('id' , $item->subject_id)->first() != null){
                $item->subject_id = subject::where('id' , $item->subject_id)->first()->name;
            }
            $newItems[] = $item;
        }

        return $newItems;
    }


    public function delete_item($itemId)
    {
        $item = item::where('id', $itemId)->first();

        if (file_exists(public_path('files/' . $item->name))) {
            unlink(public_path('files/' . $item->name));
        } else {
            dd('File does not exists.');
        }

        $item->delete();
    }

    public function delete_lending_book($itemId)
    {
        $item = lending_library::where('id', $itemId)->first();

        $item->delete();
    }
}

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// ===================================
// Home & Admin
// ===================================

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');




Route::get('/to_admin_dashboard',[
    'uses' => 'App\Http\Controllers\UserController@to_admin_dashboard',
    'middleware' => 'roles',
    'roles' => ['admin']
] )->name("to_admin_dashboard");



// ===================================
// Exams & Questions
// ===================================

Route::get(
    '/add_exam',
    [
        'uses' => 'App\Http\Controllers\ExamFormController@to_add_exam_view',
        'middleware' => 'roles',
        'roles' => ['admin']
    ]
)->name("addNewExam");

Route::post(
    '/create_exam',
    [
        'uses' => 'App\Http\Controllers\ExamFormController@create_exam',
        'middleware' => 'roles',
        'roles' => ['admin']
    ]
)->name("createNewExam");

Route::get(
    '/add_question',
    [
        'uses' => 'App\Http\Controllers\ExamFormQuestionsController@to_add_question_view',
        'middleware' => 'roles',
        'roles' => ['admin']
    ]
)->name("add_question");

Route::post(
    '/create_question',
    [
        'uses' => 'App\Http\Controllers\ExamFormQuestionsController@create_question',
        'middleware' => 'roles',
        'roles' => ['admin']
    ]
)->name("create_question");


Route::get('/to_exams', 'App\Http\Controllers\UserController@to_exams')->name("to_exams");
Route::get('/checkIfUserExist', 'App\Http\Controllers\ExamFormController@checkIfUserExist')->name("checkIfUserExist");
Route::get('/startExam', 'App\Http\Controllers\ExamFormController@startExam')->name("startExam");
Route::get('/start_exam/{id}', 'App\Http\Controllers\ExamFormController@start_exam')->name("start_exam");
Route::post('/finishExam', 'App\Http\Controllers\ExamFormController@finishExam')->name("finishExam");




// results
Route::get('/getLastResult/{id}',[
    'uses' => 'App\Http\Controllers\ExamFormQuestionsController@getLastResult',
    'middleware' => 'roles',
    'roles' => ['admin']
] )->name("getLastResult");


Route::get('/get_result/{id}', [
    'uses' => 'App\Http\Controllers\ExamFormQuestionsController@get_result',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("get_result");


Route::get('/show_one_user/{id}', [
    'uses' => 'App\Http\Controllers\UserController@show_one_user',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("show_one_user");


Route::post('/re_exam/{id}', [
    'uses' => 'App\Http\Controllers\UserController@re_exam',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("re_exam");

Route::get('/result_by_unit', [
    'uses' => 'App\Http\Controllers\UserController@result_by_unit',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("result_by_unit");

Route::get('/custom_result', [
    'uses' => 'App\Http\Controllers\UserController@custom_result',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("custom_result");

Route::get('/get_custom_results/{id}', [
    'uses' => 'App\Http\Controllers\UserController@get_custom_results',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("get_custom_results");

Route::get('/get_custom_result_data/{id}', [
    'uses' => 'App\Http\Controllers\UserController@get_custom_result_data',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("get_custom_result_data");


Route::get('/get_unit_results/{unit}', [
    'uses' => 'App\Http\Controllers\UserController@get_unit_results',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("get_unit_results");


//timer
Route::post('/changeTimer', [
    'uses' => 'App\Http\Controllers\ExamFormQuestionsController@changeTimer',
    'middleware' => 'roles',
    'roles' => ['admin']
])->name("changeTimer");


// ===================================
// User
// ===================================

Route::get( '/addUser', [ 'uses' => 'App\Http\Controllers\UserController@addUser',  ] )->name("addNewUser");
Route::post( '/createUser', [ 'uses' => 'App\Http\Controllers\UserController@createUser' ] )->name("createUser");
Route::put( '/updateUser', [ 'uses' => 'App\Http\Controllers\UserController@updateUser', ] )->name("updateUser");





// ===================================
// Library
// ===================================
Route::get('/library', 'App\Http\Controllers\LibraryController@library')->name("library");
Route::get('/open_library/{libraryId}/{sectionId}', 'App\Http\Controllers\LibraryController@open_library')->name("open_library");
Route::get('/open_mil_library', 'App\Http\Controllers\LibraryController@open_mil_library')->name("open_mil_library");
Route::get('/open_normal_library', 'App\Http\Controllers\LibraryController@open_normal_library')->name("open_normal_library");
Route::get('/full_search', 'App\Http\Controllers\LibraryController@full_search')->name("full_search");
Route::get('/lending_full_search', 'App\Http\Controllers\LendingController@lending_full_search')->name("lending_full_search");
Route::get('/open_library_subject_files/{subject_id}', 'App\Http\Controllers\LibraryController@open_library_subject_files')->name("open_library_subject_files");
Route::get('/upload_here/{cat_id}/{subject_id}', 'App\Http\Controllers\LibraryController@upload_here')->name("upload_here");

Route::get('/get_books_result/{filename}', 'App\Http\Controllers\LibraryController@get_books_result')->name("get_books_result");
Route::get('/sub_subject/{subjectId}/{catId}', 'App\Http\Controllers\LibraryController@sub_subject')->name("sub_subject");


Route::group(['middleware' => 'roles' , 'roles' => ['admin']], function(){

    // Upload Files
    Route::get('file','App\Http\Controllers\LibraryController@to_upload_files')->name('to_upload_files');
    Route::post('uploadSubmit','App\Http\Controllers\LibraryController@uploadSubmit')->name('uploadSubmit');
    Route::post('uploadHereSubmit','App\Http\Controllers\LibraryController@uploadHereSubmit')->name('uploadHereSubmit');
    Route::delete('delete_item/{item_id}','App\Http\Controllers\LibraryController@delete_item')->name('delete_item');
    Route::delete('delete_lending_book/{item_id}','App\Http\Controllers\LibraryController@delete_lending_book')->name('delete_lending_book');

    Route::get('/bulk_re_exam', 'App\Http\Controllers\UserController@bulk_re_exam')->name("bulk_re_exam");
    //weapon
    Route::get('/add_weapon', 'App\Http\Controllers\UserController@add_weapon')->name("add_weapon");
    Route::post('/create_weapon', 'App\Http\Controllers\UserController@create_weapon')->name("create_weapon");


    //subjects
    Route::get('/add_subjects', 'App\Http\Controllers\LibraryController@add_subjects')->name("add_subjects");
    Route::post('/create_subject', 'App\Http\Controllers\LibraryController@create_subject')->name("create_subject");
    Route::get('/get_subjects/{id}/{subject}', 'App\Http\Controllers\LibraryController@get_subjects')->name("get_subjects");


    // lending
    Route::get('/open_lending_page', 'App\Http\Controllers\LendingController@open_lending_page')->name("open_lending_page");
    Route::get('/lending_list_view/{libraryId}/{sectionId}', 'App\Http\Controllers\LendingController@lending_list_view')->name("lending_list_view");
    Route::get('/add_new_books_to_lending_library_view', 'App\Http\Controllers\LendingController@add_new_books_to_lending_library_view')->name("add_new_books_to_lending_library_view");
    Route::post('/create_lending_Book', 'App\Http\Controllers\LendingController@create_lending_Book')->name("create_lending_Book");
    Route::post('/add_lending_Request', 'App\Http\Controllers\LendingController@add_lending_Request')->name("add_lending_Request");
    Route::get('/to_lending_military_library', 'App\Http\Controllers\LendingController@to_lending_military_library')->name("to_lending_military_library");
    Route::get('/request_lend/{bookId}', 'App\Http\Controllers\LendingController@request_lend')->name("request_lend");
    Route::get('/lending_log', 'App\Http\Controllers\LendingController@lending_log')->name("lending_log");
    Route::post('/request_lend_restore/{logId}/{bookId}', 'App\Http\Controllers\LendingController@request_lend_restore')->name("request_lend_restore");
    Route::get('/add_lending_subjects', 'App\Http\Controllers\LendingController@add_lending_subjects')->name("add_lending_subjects");
    Route::post('/create_lending_subject', 'App\Http\Controllers\LendingController@create_lending_subject')->name("create_lending_subject");
    Route::get('/get_lending_subjects/{libraryId}/{sectionId}', 'App\Http\Controllers\LendingController@get_lending_subjects')->name("get_lending_subjects");
    Route::get('/open_subject_books/{subject_id}', 'App\Http\Controllers\LendingController@open_subject_books')->name("open_subject_books");

    // units
    Route::get('/add_units', 'App\Http\Controllers\UnitController@add_units')->name("add_units");
    Route::post('/create_unit', 'App\Http\Controllers\UnitController@create_unit')->name("create_unit");

    //level
    Route::get('/add_levels', 'App\Http\Controllers\levelController@add_level')->name("add_levels");
    Route::get('/deleteView', 'App\Http\Controllers\DeleteController@deleteView')->name("deleteView");
    Route::get('/exams_list', 'App\Http\Controllers\DeleteController@exams_list')->name("exams_list");
    Route::get('/change_exam_questions_count/{examId}', 'App\Http\Controllers\DeleteController@change_exam_questions_count')->name("change_exam_questions_count");
    Route::post('/update_exam_questions_count', 'App\Http\Controllers\DeleteController@update_exam_questions_count')->name("update_exam_questions_count");
    Route::post('/create_level', 'App\Http\Controllers\levelController@create_level')->name("create_level");


    Route::get('/review_exam_questions/{examId}', 'App\Http\Controllers\DeleteController@review_exam_questions')->name("review_exam_questions");
    Route::delete('/delete_exam/{examId}/{questionId}', 'App\Http\Controllers\DeleteController@delete_exam')->name("delete_exam");
    Route::delete('/delete_exam_by_id/{examId}', 'App\Http\Controllers\DeleteController@delete_exam_by_id')->name("delete_exam_by_id");
    Route::delete('/delete_level/{levelId}', 'App\Http\Controllers\DeleteController@delete_level')->name("delete_level");
});



Auth::routes();

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Stud_editController;
use App\Http\Controllers\LogController;
use App\Student;
use App\Book;
use App\Admin;
use App\Log;



Route::get('/', function () {
    return view('welcome');
});
//sign up sign in
Route::get('/register','RegistrationController@index');
Route::post('/register','RegistrationController@register');
Route::get('/student/view','RegistrationController@view');
Route::get('/login','RegistrationController@loginview');
Route::post('/login','RegistrationController@login');

Route::get('/adminlogin','RegistrationController@adminview');
Route::post('/adminlogin','RegistrationController@adminlogin');

Route::get('/logout',function()
{
 if(session()->has('email'))
 {
   session()->pull('email');
 }
 return redirect('/');
});

Route::get('/studLogout',function()
{
 if(session()->has('email'))
 {
   session()->pull('email');
 }
 return redirect('/');
});


//book details
Route::resource('panel','BookController');
Route::get('book_delete/{id}','BookController@destroy');
Route::get('panel.create','BookController@create');
Route::post('panel.create','BookController@store');
Route::get('panel.edit/{id}','BookController@edit');
Route::post('p_update/{id}','BookController@update')->name('p_update');
Route::get('/issue/{id}','BookController@view');

//student details
Route::resource('student','StudentController');
Route::get('student_delete/{id}','StudentController@destroy');
Route::get('student.create','StudentController@create');
Route::post('student.create','StudentController@store');
Route::get('student.edit/{id}','StudentController@edit');
Route::post('s_update/{id}','StudentController@update')->name('s_update');

Route::get('details','LogController@index');
Route::get('s_issue.issue','LogController@issue');
Route::post('s_issue.issue','LogController@store');
Route::get('s_issue.reissue','LogController@reissueView');
Route::post('s_issue.reissue','LogController@reissue');



Route::get('/','RegistrationController@nav');
Route::get('layout.admin_nav','RegistrationController@adnav');

Route::get('st_show','LogController@show');





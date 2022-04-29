<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\Guard;


//sign up sign in
Route::get('student/register','RegistrationController@index');
Route::post('student/register','RegistrationController@register');
Route::get('/student/view','RegistrationController@view');
Route::get('/login','RegistrationController@loginView');
Route::post('/login','RegistrationController@login');
Route::get('/adminLogin','RegistrationController@adminView');
Route::post('/adminLogin','RegistrationController@adminLogin');
Route::get('/logout','RegistrationController@logout');

Route::group(['middleware'=>'guard'],function()
{
    //book details
    Route::resource('book','BookController');
    Route::delete('book_delete/{id}','BookController@destroy');
    Route::get('book.create','BookController@create');
    Route::post('book.create','BookController@store');
    Route::get('book.edit/{id}','BookController@edit');
    Route::post('book_update/{id}','BookController@update')->name('book_update');
    Route::get('/issue/{id}','BookController@view');

    //student details
    Route::resource('student','StudentController');
    Route::delete('student_delete/{id}','StudentController@destroy');
    Route::get('student.create','StudentController@create');
    Route::post('student.create','StudentController@store');
    Route::get('student.edit/{id}','StudentController@edit');
    Route::post('student_update/{id}','StudentController@update')->name('student_update');

    //student information
    Route::get('book_issue.issue','LogController@issue');
    Route::post('book_issue.issue','LogController@store');
    Route::get('book_issue.reissue','LogController@reissueView');
    Route::post('book_issue.reissue','LogController@reissue');
    Route::get('student_information','LogController@studentInformation');
});


Route::get('/','RegistrationController@navbar');
Route::get('layout.admin_nav','RegistrationController@adminNavbar');



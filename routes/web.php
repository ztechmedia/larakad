<?php

define('SCHOOL_NAME', 'SDN 1 CIMUNING');

function setTitle($text) {
    return SCHOOL_NAME . ' | ' . $text;
}

Route::get('/logout', '/Auth/LoginController@logout');
Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController', ['except' => ['show', 'index', 'edit']]);
    Route::get('users/tables/{level}', ['as' => 'users.index', 'uses' => 'UserController@index']);
    Route::get('users/{id}/{level}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    
    Route::resource('teachers', 'TeacherController', ['except' => ['show']]);
    Route::resource('students', 'StudentController', ['except' => ['show']]);
    Route::resource('levels', 'LevelController', ['except' => ['show']]);
    
    Route::resource('classes', 'ClassController', ['except' => ['show', 'create']]);
    Route::get('classes/class-list/{level}', ['as' => 'classes.list', 'uses' => 'ClassController@classList']);
    Route::get('classes/create/{level}', ['as' => 'classes.create', 'uses' => 'ClassController@create']);
    
    Route::resource('subjects', 'SubjectController', ['except' => ['show']]);
    
    Route::resource('schedules', 'ScheduleController', ['except' => ['show', 'create']]);
    Route::get('schedules/class/{level}', ['as' => 'schedules.classes', 'uses' => 'ScheduleController@classes']);
    Route::get('schedules/list/{class}', ['as' => 'schedules.list', 'uses' => 'ScheduleController@list']);
    Route::get('schedules/create/{class}', ['as' => 'schedules.create', 'uses' => 'ScheduleController@create']);
});

<?php

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
    Route::get('classes/mapping', ['as' => 'classes.mapping', 'uses' => 'ClassController@mapping']);
    Route::get('classes/mapping_student/{class}/{year}', ['as' => 'classes.mapping_student', 'uses' => 'ClassController@mappingStudent']);
    Route::get('classes/mapping_registered_student/{class}/{year}', ['as' => 'classes.mapping_registered_student', 'uses' => 'ClassController@mappingRegisteredStudent']);
    Route::delete('classes/mapping_remove_student/{student}/{class}/{year}', ['as' => 'classes.mapping_remove_student', 'uses' => 'ClassController@mappingRemoveStudent']);
    Route::post('classes/add_student', ['as' => 'classes.add_student', 'uses' => 'ClassController@addStudentToMapClass']);
    
    Route::resource('subjects', 'SubjectController', ['except' => ['show']]);
    
    Route::resource('schedules', 'ScheduleController', ['except' => ['show', 'create']]);
    Route::get('schedules/class/{level}', ['as' => 'schedules.classes', 'uses' => 'ScheduleController@classes']);
    Route::get('schedules/list/{class}/{year}/{semester}', ['as' => 'schedules.list', 'uses' => 'ScheduleController@list']);
    Route::get('schedules/create/{class}/{year}/{semester}', ['as' => 'schedules.create', 'uses' => 'ScheduleController@create']);

    Route::get('student_values', ['as' => 'student_values', 'uses' => 'StudentValuesController@index']);
    Route::get('student_values/student_list/{class}/{year}', ['as' => 'student_values.student_list', 'uses' => 'StudentValuesController@studentList']);
    Route::get('student_values/input_values/{student}/{class}/{year}/{semester}/{mode}', ['as' => 'student_values.input_values', 'uses' => 'StudentValuesController@inputValues']);
    Route::post('student_values/store', ['as' => 'student_values.store', 'uses' => 'StudentValuesController@storeValues']);
});

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Homepage is just a login page
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/vacancies');
    }

    return view('auth.login');
});

Route::auth();

// We don't allow new users
Route::match(['get', 'post'], 'register', function () {
    return redirect('/')->with('error', 'This feature is disabled.');
});

// Routes for logged users
Route::group(['middleware' => 'auth'], function () {

    Route::resource('sources', 'SourceController', ['only' => ['index', 'edit', 'update']]);
    Route::get('sources/refresh', ['uses' => 'SourceController@refresh', 'as' => 'sources.refresh']);

    Route::get('vacancies/search', ['uses' => 'VacancyController@search', 'as' => 'vacancies.search']);
    Route::resource('vacancies', 'VacancyController');
});

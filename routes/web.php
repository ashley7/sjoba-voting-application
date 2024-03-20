<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('welcome');
});

 Route::get('vote_time','VoteProcessController@create');

Auth::routes();
 
Auth::routes(['register'=>false]);

Route::group(['middleware' => 'auth', 'middleware'=>'verified'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('voters','VoteController');

    Route::resource('candidate_category','CandidateCategoryController');

    Route::resource('candidate','CandidateController');

    Route::resource('vote_control','VoteProcessController');

    Route::get('bullot_paper','HomeController@bullotPaper')->name('bullot_paper');

    Route::post('vote','HomeController@vote');

    Route::get('voters_that_voted','HomeController@thoseThatVoted');

});

 

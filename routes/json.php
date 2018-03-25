<?php

/*
 * AUTH Json routes
 */

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function () {
    Route::get('job/client', USER_JOB . "@indexByUserId")->name('job.client');
});
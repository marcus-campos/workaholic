<?php

/*
 * AUTH Json routes
 */

Route::group(['prefix' => 'json', 'middleware' => 'auth'], function () {
    /*
     *  Jobs
     */

    Route::get('job', USER_JOB . "@indexAll");
    Route::get('job/client', USER_JOB . "@indexByUserId");
});
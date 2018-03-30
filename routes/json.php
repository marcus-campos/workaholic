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

    /*
     * Proposal
     */
    Route::post('/proposal/store', USER_PROPOSAL. "@store");
    Route::get('/proposal/{id}', USER_PROPOSAL. "@show");
    Route::get('/proposal/job/{id}', USER_PROPOSAL. "@showJobProposal");
});
<?php

/*
 * AUTH Json routes
 */

Route::group(['prefix' => 'json', 'middleware' => 'auth'], function () {
    /*
     *  Jobs
     */

    Route::get('job', USER_JOB . "@indexAll");
    Route::get('job/client', USER_JOB . "@indexByClientId");
    Route::get('job/worker', USER_JOB . "@indexByWorkerId");

    /*
     * Proposal
     */
    Route::post('/proposal', USER_PROPOSAL. "@store");
    Route::get('/proposal/{id}', USER_PROPOSAL. "@showJsonProposal");
    Route::get('/proposal/job/{id}', USER_PROPOSAL. "@showJsonJobProposal");

    /*
     * Proposal comments
     */
    Route::get('/proposal/comment', USER_PROPOSAL_COMMENT.'@index');
    Route::post('/proposal/comment', USER_PROPOSAL_COMMENT.'@store');

    /*
    *  City
    */
    Route::get('/city/name/{name}', CITY_CONTROLLER.'@getCityByName');

});
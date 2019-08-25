<?php

use Illuminate\Http\Request;

/*
 * USER
 */
const USER = "User\UserController";
const USER_DASHBOARD = 'User\Dashboard\DashboardController';
const USER_JOB = 'User\Job\JobController';
const USER_PROPOSAL = 'User\Proposal\ProposalController';
const USER_PROPOSAL_COMMENT = 'User\Proposal\ProposalCommentController';
const USER_PROFILE = 'User\Profile\ProfileController';
const USER_MY_ACCOUNT = 'User\MyAccount\MyAccountController';
const USER_ADDRESS = 'User\UserAddressController';

/*
 * ADMIN
 */

const ADMIN_DASHBOARD = 'Admin\Dashboard\DashboardController';

/*
 * AUTH
 */
const AUTH_CONTROLLER = 'AuthController';
const LOGIN_CONTROLLER = 'Auth\LoginController';
const FORGOT_PASSWORD = 'Auth\ForgotPasswordController';
const REGISTER_CONTROLLER = 'Auth\RegisterController';
const RESET_PASSWORD = 'Auth\ResetPasswordController';

/*
 * CITY
 */

const CITY_CONTROLLER = 'CityController';

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    
    // Authenticated routes
    Route::group(['middleware' => 'auth:api'], function () {
        // JOB
        Route::group(['prefix' => 'jobs'], function () {
            Route::get('/', USER_JOB.'@index');
            Route::get('categories', USER_JOB.'@categories');
            Route::post('/', USER_JOB.'@store');
            Route::put('{jobId}', USER_JOB.'@update');
            Route::delete('{jobId}', USER_JOB.'@destroy');

            // COMPANY
            Route::group(['prefix' => 'company'], function () {
                Route::get('accepted', USER_JOB.'@indexByCompanyAccepted');
                Route::get('done', USER_JOB.'@indexByCompanyDone');
            });
        });
    });
    
    // AUTH
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', AUTH_CONTROLLER.'@login')->name('login');
        Route::post('logout', AUTH_CONTROLLER.'@logout')->name('logout')->middleware('auth:api');
        Route::post('refresh', AUTH_CONTROLLER.'@refresh')->name('refresh')->middleware('auth:api');
        Route::post('me', AUTH_CONTROLLER.'@me')->name('me')->middleware('auth:api');
        Route::post('register', REGISTER_CONTROLLER . '@create')->name('register');
    });
});
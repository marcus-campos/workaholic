<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return redirect()->to(route('user.job.index')); });

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function () {

    /*
     *  Dashboard
     */
    Route::resource('dashboard', USER_DASHBOARD, ['only' => [
        'index', 'show'
    ]]);

    /*
     *  Jobs
     */
    Route::get('job/client', USER_JOB . '@index')->name('job.client');
    Route::get('job/worker', USER_JOB . '@index')->name('job.worker');
    Route::resource('job', USER_JOB);

    /*
     * Proposal
     */

    Route::get('proposal/job/{id}', USER_PROPOSAL.'@show')->name('proposal.job.show');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {


    Route::get('dashboard', ADMIN_DASHBOARD.'@index');

});


/*
 * =====================================
 * AUTH
 * =====================================
 */


//AUTH
Route::group(['prefix' => 'auth'], function () {
    // Login Routes
    Route::get('login', function () {
        return view('auth.login');
    })->name('login.form');

    Route::post('login', LOGIN_CONTROLLER . '@login')->name('login');

    Route::get('logout', LOGIN_CONTROLLER . '@logout')->name('logout');

    // Registration Routes
    Route::get('register', function () {
        return view('auth.register');
    })->name('register.form');

    Route::post('register', REGISTER_CONTROLLER . '@register')->name('register');
});

//RESET PASSWORD
Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
    // Password Reset Routes...
    Route::get('reset', function () {
        return view('auth.passwords.email');
    });

    //Route::post('email', FORGOT_PASSWORD . '@sendResetLinkEmail')->name('reset');
    Route::post('email', function () {
        return "Função desabilitada temporariamente";
    })->name('reset');

    //RESET PASSWORD
    Route::group(['prefix' => 'reset', 'as' => 'reset.'], function () {
        Route::post('/', RESET_PASSWORD . '@reset');
        Route::get('reset/{token}', function () {
            return view('auth.passwords.reset');
        });
    });
});
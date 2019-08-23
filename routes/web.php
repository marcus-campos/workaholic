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

// Route::get('/', function () {

//     if (auth()->check() && auth()->user()->role == 'admin') {
//         return redirect()->to(route('admin.dashboard.index'));
//     }
//     return redirect()->to(route('user.job.index'));
// });

// Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function () {

//     /*
//      *  Dashboard
//      */
//     Route::resource('dashboard', USER_DASHBOARD, ['only' => [
//         'index', 'show'
//     ]]);

//     /*
//      *  Jobs
//      */
//     Route::get('job/client', USER_JOB . '@index')->name('job.client')->middleware('company');
//     Route::get('job/client/accepted', USER_JOB . '@index')->name('job.client.accepted')->middleware('company');
//     Route::get('job/client/done', USER_JOB . '@index')->name('job.client.done')->middleware('company');
//     Route::get('job/worker', USER_JOB . '@index')->name('job.worker')->middleware('freelancer');
//     Route::resource('job', USER_JOB);

//     /*
//      * Proposal
//      */

//     Route::get('proposal/job/{id}', USER_PROPOSAL.'@show')->name('proposal.job.show');
//     Route::put('proposal/accept', USER_PROPOSAL.'@acceptProposal')->name('proposal.job.accept')->middleware('company');
//     Route::put('proposal/update/activities', USER_PROPOSAL.'@updateActivities')->name('proposal.job.updateActivities')->middleware('company');

//     /*
//      * Profile
//      */

//     Route::get('{id}/profile', USER_PROFILE.'@show')->name('profile.index');

//     /*
//      * My Account
//      */

//     Route::group(['prefix' => 'my-account', 'as' => 'my-account.'], function () {
//         Route::get('/', USER_MY_ACCOUNT.'@index')->name('index');
//     });

//     /*
//      * User Address
//      */

//     Route::group(['prefix' => 'address', 'as' => 'address.'], function () {
//         Route::get('/', USER_ADDRESS.'@index')->name('index');
//         Route::put('{id}/primary', USER_ADDRESS.'@setPrimary')->name('index');
//         Route::post('/', USER_ADDRESS.'@store')->name('store');
//         Route::put('{id}', USER_ADDRESS.'@update')->name('update');
//         Route::delete('{id}', USER_ADDRESS.'@destroy')->name('destroy');
//     });

//     /*
//      * User
//      */

//     Route::get('auth', USER.'@getAuthUser')->name('auth');
//     Route::put('{id}', USER.'@update')->name('update');
//     Route::put('{id}/password', USER.'@updatePassword')->name('updatePassword');
//     Route::put('{id}/photo', USER.'@profilePhoto')->name('photo');
// });

// /*
//  * =====================================
//  * ADMIN
//  * =====================================
//  */
// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {

//     Route::get('dashboard', ADMIN_DASHBOARD.'@index')->name('dashboard.index');

// });


// /*
//  * =====================================
//  * AUTH
//  * =====================================
//  */


// //AUTH
// Route::group(['prefix' => 'auth'], function () {
//     // Login Routes
//     Route::get('login', function () {
//         return view('auth.login');
//     })->name('login.form');

//     Route::post('login', LOGIN_CONTROLLER . '@login')->name('login');

//     Route::get('logout', LOGIN_CONTROLLER . '@logout')->name('logout');

//     // Registration Routes
//     Route::get('register', function (\Illuminate\Http\Request $request) {
//         return view('auth.register', compact('request'));
//     })->name('register.form');

//     Route::post('register', REGISTER_CONTROLLER . '@register')->name('register');
// });

// //RESET PASSWORD
// Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
//     // Password Reset Routes...
//     Route::get('reset', function () {
//         return view('auth.passwords.email');
//     });

//     //Route::post('email', FORGOT_PASSWORD . '@sendResetLinkEmail')->name('reset');
//     Route::post('email', function () {
//         return "Função desabilitada temporariamente";
//     })->name('reset');

//     //RESET PASSWORD
//     Route::group(['prefix' => 'reset', 'as' => 'reset.'], function () {
//         Route::post('/', RESET_PASSWORD . '@reset');
//         Route::get('reset/{token}', function () {
//             return view('auth.passwords.reset');
//         });
//     });
// });
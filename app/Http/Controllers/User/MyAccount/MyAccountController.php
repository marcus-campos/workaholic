<?php

namespace App\Http\Controllers\User\MyAccount;

use App\Http\Controllers\Controller;

class MyAccountController extends Controller
{
    public function index()
    {
        return view('app.user.my-account.index');
    }
}

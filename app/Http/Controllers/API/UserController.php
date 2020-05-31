<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    public function index()
    {

        return User::pluck('name');
    }
}

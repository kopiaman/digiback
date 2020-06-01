<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    /**
     * @OA\Get(
     *      path="/users",
     *      summary="List of users name",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),

     *     )
     *
     */
    public function index()
    {

        return User::pluck('name');
    }
}

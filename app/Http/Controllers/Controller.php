<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Digi Assesment Doc",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="kopiaman@yahoo.com"
     *      )
     * )
     */

    /**
     *
     *  *  @OA\Server(
     *      url="https://digiback.suaquran.com/api",
     *      description="Live Server"
     *  )
     *
     *
     * @OA\Server(
     *      url="http://digiback.test/api",
     *      description="Local Development"
     * )
     *

     *
     *
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

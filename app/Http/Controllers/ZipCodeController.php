<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     *
     * @return  JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->sendResponse([], '$message');
    }
}

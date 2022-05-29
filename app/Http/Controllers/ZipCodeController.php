<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

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
    global $zip_codes;

    include storage_path('zip_codes.php');

    return Response::json($zip_codes->first(), 200, [], JSON_PRETTY_PRINT);
  }

}

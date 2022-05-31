<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZipCodeResource;
use App\Models\ZipCode;
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
    return Response::json(
      new ZipCodeResource(
        ZipCode::findOrFail(
          $request->route('zip_code')
        )
      )
    );
  }

}

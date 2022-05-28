<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Response;

class Controller extends BaseController
{

  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function sendResponse($result, $message): JsonResponse
  {
    $data = [
      'success' => true,
      'result'  => $result,
      'message' => $message,
    ];

    return Response::json($data, 200, [], JSON_PRETTY_PRINT);
  }

  public function sendError($error): JsonResponse
  {
    $data = [
      'success' => false,
      'message' => $error,
    ];

    return Response::json($data, 404, [], JSON_PRETTY_PRINT);
  }

}

<?php

namespace App\Http\Controllers;

use App\Handlers\AuditLogger;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data, $code = Response::HTTP_OK)
    {

        $message = Response::$statusTexts[$code];
        return response()->json(['message' => $message, 'data' => $data], $code);
    }

    public function errorResponse($message, $code,$logIt= false,$activity=null)
    {

        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}

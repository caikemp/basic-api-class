<?php
namespace App\Utils;

use Validator;


class RequestValidator extends Validator
{

    public static function requestResponse($error)
    {
        return response()->json([
            'success' => false,
            'error' => $error,
        ], 401);
    }
    
}

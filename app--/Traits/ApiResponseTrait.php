<?php

namespace App\Traits;

trait ApiResponseTrait
{

    public $PaginateNumber = 10;
    public function sendResponse($data = null, $error = null, $code = 200)
    {
        $array = [
            'data' => $data,
            'status' => in_array($code, $this->SucessCode()) == 200 ? true : false,
            'error' => $error,

        ];

        return response($array, $code);
    } //end of sendResponse


    public function sendError($error, $errorMessages = [], $code = 200)
    {



        $response = [
            'data' => null,
            'status' => false,
            'error' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['error'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function SucessCode()
    {
        $array = ['200', '201', '202'];
        return $array;
    }
    public function notFoundResponse()
    {
        return $this->sendResponse(null, 'Data Not Found', 404);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Response;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    private $statusCode = 200;

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function responseNotFound($message = 'Not Found')
    {
        return $this->responseError($message);
    }

    public function responseError($message)
    {
        return $this->response([
            'status' => 'failed',
            'status_code' => $this->getStatusCode(),
            'message' => $message
        ]);
    }

    public function responseSuccess($data)
    {
        return $this->response([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'data' => $data
        ]);
    }

    public function response($data)
    {
        return Response::json($data);
    }
}

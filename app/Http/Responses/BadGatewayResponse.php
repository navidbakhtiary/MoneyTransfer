<?php

namespace App\Http\Responses;

use App\Http\Resources\ErrorResource;

class BadGatewayResponse
{
    private static function getStatus()
    {
        return config('payconfig.responses.status.BadGateway');
    }

    public static function defaultResponse($error)
    {
        return Response::send(
            new ErrorResource(['message' => $error]),
            self::getStatus()
        );
    }
}

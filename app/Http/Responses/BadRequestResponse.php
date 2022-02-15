<?php

namespace App\Http\Responses;

use App\Http\Resources\ErrorResource;

class BadRequestResponse
{
    private static function getStatus()
    {
        return config('payconfig.responses.status.BadRequest');
    }

    public static function defaultResponse($errors)
    {
        return Response::send(
            new ErrorResource($errors),
            self::getStatus()
        );
    }

}

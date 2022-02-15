<?php

namespace App\Http\Responses;

use App\Http\Resources\DataResource;
use App\Http\Resources\TransferResource;

class CreatedResponse
{
    private static function getStatus()
    {
        return config('payconfig.responses.status.Created');
    }

    public static function defaultResponse($message)
    {
        return Response::send(
            new DataResource(['message' => $message]),
            self::getStatus()
        );
    }

    public static function transferStore($transfer)
    {
        return Response::send(
            new DataResource([
                'transfer' => new TransferResource($transfer)
            ]),
            self::getStatus()
        );
    }

}

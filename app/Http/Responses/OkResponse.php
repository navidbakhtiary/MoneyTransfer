<?php

namespace App\Http\Responses;

use App\Http\Resources\DataResource;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\TransferResource;

class OkResponse
{
    private static function getStatus()
    {
        return config('payconfig.responses.status.Ok');
    }

    public static function defaultResponse($message)
    {
        return Response::send(
            new DataResource(['message' => $message]),
            self::getStatus()
        );
    }

    public static function transferIndex($transfers)
    {
        return Response::send(
            new DataResource([
                'transfers' => TransferResource::collection($transfers),
                'paginate' => new PaginateResource($transfers)
            ]),
            self::getStatus()
        );
    }

}

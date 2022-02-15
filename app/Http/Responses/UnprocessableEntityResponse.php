<?php

namespace App\Http\Responses;

use App\Http\Resources\ErrorResource;

class UnprocessableEntityResponse
{
    private static function getStatus()
    {
        return config('payconfig.responses.status.UnprocessableEntity');
    }

    public static function defaultResponse()
    {
        return Response::send(
            new ErrorResource(['message' => 'در ثبت اطلاعات جدید مشکلی رخ داده است']),
            self::getStatus()
        );
    }

}

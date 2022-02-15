<?php

namespace App\Http\Responses;

class Response
{
    public static function send($result, $status)
    {
        return response($result, $status)
            ->header('Content-Type', 'application/json');
    }
}

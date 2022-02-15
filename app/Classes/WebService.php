<?php

namespace App\Classes;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebService
{
    public static $client_id = '123456';
    public static $token = 'abcdefg';
    public static $successful_code = 200;

    public static function transferTo(User $user, Transfer $transfer)
    {
        $http_request = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . self::$token
            ])->post(
                'https://apibeta.finnotech.ir/oak/v2/clients/'. self::$client_id .'/transferTo?trackId=' . $transfer->track_id,
                [
                    'amount' => $transfer->amount ,
                    'description' => $transfer->description,
                    'destinationFirstname' => $transfer->destination_first_name,
                    'destinationLastname' => $transfer->destinationLastname,
                    'destinationNumber' => $transfer->destination_number,
                    'paymentNumber' => $transfer->payment_number,
                    'deposit' => $transfer->deposit,
                    'sourceFirstName' => $user->first_name,
                    'sourceLastName' => $user->last_name,
                    'reasonDescription' => $transfer->reason_description_id
                ]
            );
        $response = $http_request->object();
        if (isset($response->status)) {
            return $response;
        }
        return null;
    }
}

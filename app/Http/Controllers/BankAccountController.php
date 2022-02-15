<?php

namespace App\Http\Controllers;

use App\Http\Responses\BadRequestResponse;
use App\Http\Responses\CreatedResponse;
use App\Http\Responses\UnprocessableEntityResponse;
use App\Rules\BankAccountRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankAccountController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'account_number' => ['required', 'string', new BankAccountRule()],
            'bank_name' => 'required|string|max:30',
            'description' => 'nullable|string|max:100',
        ]);
        if ($validation->fails()) {
            return BadRequestResponse::defaultResponse($validation->errors()->messages());
        }
        $user = Auth::user();
        $account = $user->bankAccounts()->create($request->all());
        if($account){
            return CreatedResponse::defaultResponse('حساب بانکی جدید به حسابهای شما افزوده شد');
        }
        return UnprocessableEntityResponse::defaultResponse();
    }
}

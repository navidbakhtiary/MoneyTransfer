<?php

namespace App\Http\Controllers;

use App\Classes\WebService;
use App\Http\Responses\BadGatewayResponse;
use App\Http\Responses\BadRequestResponse;
use App\Http\Responses\CreatedResponse;
use App\Http\Responses\OkResponse;
use App\Rules\BankAccountRule;
use App\Rules\UserBankAccountExistsRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transfers = $user->transfers()->paginate(10);
        return OkResponse::transferIndex($transfers);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'amount' => 'required|integer|min:1',
            'description' => 'required|string|max:30',
            'destination_first_name' => 'required|string|min:2|max:33',
            'destination_last_name' => 'required|string|min:2|max:33',
            'destination_number' => ['required', 'string', new BankAccountRule()],
            'payment_number' => 'nullable|numeric|max:30',
            'reason_description_id' => 'nullable|integer|exists:reason_description,id',
            'deposit' => ['required', 'string', new UserBankAccountExistsRule()],
            'second_password' => 'nullable|string'
        ]);
        if ($validation->fails()) {
            return BadRequestResponse::defaultResponse($validation->errors()->messages());
        }
        $user = Auth::user();
        $transfer = $user->transfers()->create($request->all());
        $result = WebService::transferTo($user, $transfer);
        if ($result) {
            switch ($result->status) {
                case 'DONE':
                    $successful_result = $result->result;
                    $transfer->status = $result->status;
                    $transfer->inquiry_date = $successful_result->inquiryDate;
                    $transfer->inquiry_sequence = $successful_result->inquirySequence;
                    $transfer->inquiry_time = $successful_result->inquiryTime;
                    $transfer->ref_code = $successful_result->refCode;
                    $transfer->message = $successful_result->message;
                    $transfer->type = $successful_result->type;
                    if($transfer->save()){
                        return CreatedResponse::transferStore($transfer);
                    }
                    return OkResponse::defaultResponse('تراکنش با موفقیت در بانک های مبدا و مقصد انجام شد');
                    break;
                case 'FAILED':
                    $failed_result = $result->error;
                    $transfer->status = $result->status;
                    $transfer->message = $failed_result->message;
                    $transfer->error_code = $failed_result->code;
                    if ($transfer->save()) {
                        return BadRequestResponse::defaultResponse($transfer);
                    }
                    return BadRequestResponse::defaultResponse(['تراکنش ناموفق بود']);
                    break;
                default:
                    return BadGatewayResponse::defaultResponse('نتیجه تراکنش نامشخص بود');
                    break;
            }
        } else {
            return BadGatewayResponse::defaultResponse('نتیجه تراکنش نامشخص بود');
        }
    }
}

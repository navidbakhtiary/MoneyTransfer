<?php

namespace App\Http\Resources;

use App\Models\ReasonDescription;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'track_id' => $this->track_id,
            'deposit' => $this->deposit,
            'amount' => $this->amount,
            'description' => $this->description,
            'destination_first_name' => $this->destination_first_name,
            'destination_last_name' => $this->destination_last_name,
            'destination_number' => $this->destination_number,
            'payment_number' => $this->payment_number,
            'reason_description' => ReasonDescription::find($this->reason_description_id)->description,
            'status' => $this->status,
            'inquiry_date' => $this->inquiry_date,
            'inquiry_sequence' => $this->inquiry_sequence,
            'inquiry_time' => $this->inquiry_time,
            'ref_code' => $this->ref_code,
            'type' => $this->type,
            'error_code' => $this->error_code,
            'message' => $this->message,
        ];
    }
}

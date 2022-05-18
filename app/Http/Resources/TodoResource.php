<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $arrayData = [
            'id' => $this->id,
            'message' => $this->message
        ];

        if($this->is_complete == '0'){
            $arrayData['is_complete'] = 'Incomplete';
        }else {
            $arrayData['is_complete'] = 'Completed';

        }

        return $arrayData;
    }
}

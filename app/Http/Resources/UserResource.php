<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function with($request){
        return ['response_code' => '00','response_message' => "silahkan cek email"];
    }
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
                'updated_at' => $this->updated_at,
                'created_at' => $this->created_at,
                'id' => $this->id,
            ]
        ];
    }
}

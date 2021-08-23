<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $tokenResult = $this->createAuthToken($this->customer);


        return [
            'userType' => $this->userType,
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'expires_at' => $this->expires_at,
        ];
    }
}

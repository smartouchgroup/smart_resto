<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetCommandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray([
            'username' => $this->employee->user->firstname . ' ' .$this->employee->user->lastname,
            'le plat commandé' => $this->dishes->name,
            'status' => $this->done
        ]);
    }
}

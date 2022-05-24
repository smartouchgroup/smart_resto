<?php

namespace App\Http\Resources;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'userId' => $this->user->firstname . $this->user->lastname ,
            'organizationId' =>$this->user->custom->organization->user->firstname,
            'groupId' => $this->custom->group->name
        ]);
    }
}


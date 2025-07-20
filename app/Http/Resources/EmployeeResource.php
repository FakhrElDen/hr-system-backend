<?php

namespace App\Http\Resources;

use App\Enums\EmployeeStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'salary' => $this->salary,
            'status' => EmployeeStatus::getStringValue($this->status),
            'department' => $this->whenLoaded('department'),
            'photo' => $this->photo,
            'hired_at' => $this->hired_at,
            'created_at' => $this->note,
        ];
    }
}

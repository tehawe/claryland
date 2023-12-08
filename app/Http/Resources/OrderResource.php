<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'invoice' => $this->invoice,
            'customer_name' => $this->customer_name,
            'customer_contact' => $this->customer_contact,
            'customer_email' => $this->customer_email,
            'package_id' => $this->package_id,
        ];
    }
}

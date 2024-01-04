<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'age' => $this->age,
            'ticket_code' => $this->ticket_code,
            'check_in' => $this->updated_at->diffForHumans(),
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'item_id' => $this->item_id,
        ];
    }
}

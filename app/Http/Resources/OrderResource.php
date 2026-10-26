<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'order_number'     => $this->order_number,
            'status'           => $this->status,
            'customer'         => [
                'name'  => $this->customer_name,
                'email' => $this->customer_email,
                'phone' => $this->customer_phone,
            ],
            'shipping_address' => $this->shipping_address,
            'items'            => OrderItemResource::collection($this->whenLoaded('items')),
            'pricing'          => [
                'subtotal'        => (float) $this->subtotal,
                'tax'             => (float) $this->tax,
                'shipping_charge' => (float) $this->shipping_charge,
                'total'           => (float) $this->total,
            ],
            'notes'            => $this->notes,
            'timestamps'       => [
                'ordered_at'   => $this->created_at->toISOString(),
                'confirmed_at' => $this->confirmed_at?->toISOString(),
                'shipped_at'   => $this->shipped_at?->toISOString(),
                'delivered_at' => $this->delivered_at?->toISOString(),
                'cancelled_at' => $this->cancelled_at?->toISOString(),
            ],
        ];
    }
}

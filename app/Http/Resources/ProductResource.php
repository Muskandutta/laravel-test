<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'slug'                => $this->slug,
            'sku'                 => $this->sku,
            'description'         => $this->description,
            'price'               => (float) $this->price,
            'price_formatted'     => '₹' . number_format($this->price, 2),
            'stock_quantity'      => $this->stock_quantity,
            'status'              => $this->status,
            'is_in_stock'         => $this->is_in_stock,
            'is_low_stock'        => $this->is_low_stock,
            'image_url'           => $this->image_url,
            'category'            => new CategoryResource($this->whenLoaded('category')),
            'created_at'          => $this->created_at->toISOString(),
            'updated_at'          => $this->updated_at->toISOString(),
        ];
    }
}

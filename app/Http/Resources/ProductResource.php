<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'category_id'  => $this->category_id,
            'category'     => new CategoryResource($this->whenLoaded('category')),
            'latest_price' => $this->latestPrice ? [
                'id'         => $this->latestPrice->id,
                'price'      => $this->latestPrice->price,
                'created_at' => $this->latestPrice->created_at,
            ] : null,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}

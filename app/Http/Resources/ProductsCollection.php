<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($element) {
                return [
                    'id' => $element->id,
                    'name' => $element->name,
                    'description' => $element->description,
                    'priceMxn' => "$" . ($element->price / 100),
                    'priceNumber' => $element->price,
                    'image' => $element->image_url
                ];
            })
        ];
    }
}

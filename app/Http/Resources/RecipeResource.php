<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'code' => $this->code,
            'recipe_amount' => $this->recipe_amount,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name,
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'recipe_items' => $this->recipeItems
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'posts'=> $this->posts,
            // 'posts'=> PostResource::collection($this->posts),
            // 'posts' => PostResource::collection($this->whenLoaded('posts'))
        ];

    }
}

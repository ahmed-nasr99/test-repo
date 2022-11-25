<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'post_title' => $this->resource->title,
            'post_content' => $this->resource->content,
            'post_author' => $this->resource->author,
            'is_published' => (bool) $this->resource->published,
            'deleted' => !is_null($this->resource->deleted_at),
        ];
    }
}

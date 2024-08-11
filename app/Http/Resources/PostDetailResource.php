<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'title' => $this->title,
            'news_content' => $this->news_content,
            'author'=> $this->author,
            'writer'=> $this->whenLoaded('writer'),
            'comments'=> $this->whenLoaded('comments',function(){
                return collect($this->comments)->each(function($comment){
                    $comment->commentator;
                    return $comment;
                });
            }),
            'comments_count'=> $this->whenLoaded('comments',function(){
                return count($this->comments);
            }),
            'created_at' => date_format($this->created_at,'Y/m/d H:i:s')
        ];
    }
}

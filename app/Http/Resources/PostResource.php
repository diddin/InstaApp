<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'caption'   => $this->caption,
            'image_url' => asset('storage/' . $this->image),
            'created_at' => $this->created_at->diffForHumans(),
            // 'user' => [
            //     'id'   => $this->user->id,
            //     'name' => $this->user->name,
            // ],
            'user' => new UserResource($this->user),
            'likes_count' => $this->likes->count(),
            'liked_by_user' => $this->likes->contains('user_id', Auth::user()->id),
            // 'comments' => $this->comments->map(function ($comment) {
            //     return [
            //         'id'      => $comment->id,
            //         'content' => $comment->content,
            //         'user'    => [
            //             'id'   => $comment->user->id,
            //             'name' => $comment->user->name,
            //         ],
            //         'created_at' => $comment->created_at->diffForHumans(),
            //     ];
            // }),
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}

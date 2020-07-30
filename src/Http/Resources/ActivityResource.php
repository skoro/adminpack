<?php

namespace Skoro\AdminPack\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'created' => $this->created_at->timestamp,
            'created_ago' => $this->created_at->ago(),
            'event' => $this->event,
            'message' => $this->message,
            'user' => $this->user ? $this->user->name : '?',
        ];
    }
}

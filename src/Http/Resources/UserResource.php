<?php

namespace Skoro\AdminPack\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'role' => $this->role->name,
            'created' => $this->created_at->timestamp,
            'created_ago' => $this->created_at->ago(),
            'links' => [
                'edit' => route('admin.user.edit', $this),
            ],
        ];
    }
}

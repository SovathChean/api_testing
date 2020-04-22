<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\User;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'data' => $this->collection,
          'id' => $this->id,
          'name' => $this->name,
          'email' => $this->email,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
        ];
    }
}

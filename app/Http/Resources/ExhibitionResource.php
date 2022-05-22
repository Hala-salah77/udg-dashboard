<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;
class ExhibitionResource extends JsonResource
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
            'id'=> $this->id,
            'enTitle'=> $this->enTitle,
            'arTitle'=> $this->arTitle,
            'link'=> $this->link,
            'activationLink'=> $this->activationLink,
            'images'=> ImageResource::collection($this->images),

        ];
    }
}

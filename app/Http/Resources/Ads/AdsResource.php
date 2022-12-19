<?php

namespace App\Http\Resources\Ads;

use App\EnumManager\AdsTypeEnum;
use App\Http\Resources\Advertiser\AdvertiserResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $type = match ($this->type) {
            AdsTypeEnum::Free => 'Free',
            AdsTypeEnum::Paid => 'Paid'
        };
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'advertiser' => AdvertiserResource::make($this->whenLoaded('advertiser')),
            'type' => $type,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'start_date' => $this->start_date->format('dM Y')
        ];
    }
}

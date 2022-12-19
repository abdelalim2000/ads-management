<?php

namespace App\Http\Resources\Advertiser;

use App\Http\Resources\Ads\AdsResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AdvertiserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'ads_count' => $this->whenCounted('ads_count'),
            'ads' => AdsResource::collection($this->whenLoaded('ads')),
        ];
    }
}

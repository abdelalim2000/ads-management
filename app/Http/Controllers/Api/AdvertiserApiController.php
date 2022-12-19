<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Advertiser\AdvertiserResource;
use App\Models\Advertiser;

class AdvertiserApiController extends Controller
{
    public function show(Advertiser $advertiser): AdvertiserResource
    {
        $advertiser->load('ads')->loadCount('ads');
        return AdvertiserResource::make($advertiser)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }
}

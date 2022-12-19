<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ads\AdsResource;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdsApiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $ads = Ads::query()
            ->with('category', 'tags', 'advertiser')
            ->when($request->has('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->has('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('tags.id', $request->tag);
                });
            })
            ->paginate($request->per_page ?? 6);

        return AdsResource::collection($ads)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }
}

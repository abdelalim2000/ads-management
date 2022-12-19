<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ads;
use App\Models\Advertiser;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create();
        Tag::factory(15)->create();
        Advertiser::factory(100)->create();
        Ads::factory(250)->create();

        $tags = Tag::all();
        Ads::all()->each(function ($ad) use ($tags) {
            $ad->tags()->sync($tags->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}

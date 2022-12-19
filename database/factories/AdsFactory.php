<?php

namespace Database\Factories;

use App\EnumManager\AdsTypeEnum;
use App\Models\Ads;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ads>
 */
class AdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'description' => $this->faker->sentence(10),
            'category_id' => $this->faker->numberBetween(1, 5),
            'advertiser_id' => $this->faker->numberBetween(1, 100),
            'start_date' => $this->faker->dateTimeThisYear(),
            'type' => $this->faker->randomElement([AdsTypeEnum::Free, AdsTypeEnum::Paid]),
        ];
    }
}

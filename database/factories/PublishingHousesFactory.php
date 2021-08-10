<?php

namespace Database\Factories;

use App\Models\PublishingHouses;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublishingHousesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublishingHouses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company(),
            'link' => $this->faker->url()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Authors;
use App\Models\Books;
use App\Models\PublishingHouses;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Books::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'publishing_house_id' => function () {
                return PublishingHouses::all('id')->random();
            },
            'author_id' => function () {
                return Authors::all('id')->random();
            },
            'isbn' =>$this->faker->numerify("#-######-######-#"),
            'page_count' => $this->faker->biasedNumberBetween(100, 1000),
        ];
    }
}

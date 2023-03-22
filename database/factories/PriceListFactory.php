<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PriceList;
use App\Models\User;

class PriceListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PriceList::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'must_be_sync' => $this->faker->boolean,
            'sync_at' => $this->faker->dateTime(),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}

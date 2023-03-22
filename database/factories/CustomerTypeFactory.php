<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CustomerType;
use App\Models\PriceList;
use App\Models\User;

class CustomerTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'description' => $this->faker->name,
            'price_list_id' => PriceList::factory(),
            'must_be_sync' => $this->faker->boolean,
            'sync_at' => $this->faker->dateTime(),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}

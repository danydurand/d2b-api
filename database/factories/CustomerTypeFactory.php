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
        $user_id = User::inRandomOrder()->first()->id;
        $price_list_id = PriceList::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'code'          => $this->faker->regexify('[A-Z0-9]{6}'),
            'description'   => Str::upper($this->faker->name),
            'price_list_id' => $price_list_id,
            'must_be_sync'  => $must_be_sync,
            'sync_at'       => $must_be_sync ? null : $this->faker->dateTime(),
            'created_by'    => $user_id,
            'updated_by'    => $user_id,
        ];
    }
}

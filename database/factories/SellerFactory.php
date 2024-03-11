<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Seller;
use App\Models\User;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id = User::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;
        $name = $this->faker->name;

        return [
            'name'               => Str::upper($name),
            'sales_commission'   => $this->faker->randomFloat(2, 0, 999.99),
            'collect_commission' => $this->faker->randomFloat(2, 0, 999.99),
            'login'              => $this->faker->regexify('[a-z0-9]{8}'),
            'password'           => $this->faker->password,
            'last_login_at'      => $this->faker->dateTimeThisMonth(),
            'must_be_sync'       => $must_be_sync,
            'sync_at'            => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'         => $user_id,
            'updated_by'         => $user_id,
        ];
    }
}

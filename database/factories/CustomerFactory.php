<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Seller;
use App\Models\User;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id = User::inRandomOrder()->first()->id;
        $customer_type_id = CustomerType::inRandomOrder()->first()->id;
        $seller_id = Seller::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'code' => $this->faker->regexify('[A-Z0-9]{6}'),
            'fiscal_number' => $this->faker->regexify('[A-Z0-9]{30}'),
            'business_name' => Str::upper($this->faker->company()),
            'customer_type_id' => $customer_type_id,
            'seller_id' => $seller_id,
            'fiscal_address' => Str::upper($this->faker->address()),
            'dispatch_address' => Str::upper($this->faker->address()),
            'phones' => $this->faker->regexify('[0-9]{60}'),
            'contact_name' => $this->faker->regexify('[A-Z]{60}'),
            'must_be_sync' => $must_be_sync,
            'sync_at' => $must_be_sync ? null : $this->faker->dateTime(),
            'created_by' => $user_id,
            'updated_by' => $user_id,
        ];
    }
}

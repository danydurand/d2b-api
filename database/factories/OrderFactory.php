<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentCondition;
use App\Models\Seller;
use App\Models\Transport;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id              = User::inRandomOrder()->first()->id;
        $customer_id          = Customer::inRandomOrder()->first()->id;
        $seller_id            = Seller::inRandomOrder()->first()->id;
        $transport_id         = Transport::inRandomOrder()->first()->id;
        $payment_condition_id = PaymentCondition::inRandomOrder()->first()->id;
        $currency_id          = Currency::inRandomOrder()->first()->id;
        $must_be_sync         = $this->faker->boolean;

        return [
            'number'               => $this->faker->regexify('[0-9]{6}'),
            'customer_id'          => $customer_id,
            'seller_id'            => $seller_id,
            'transport_id'         => $transport_id,
            'status'               => Str::upper($this->faker->randomLetter),
            'description'          => Str::upper(Str::substr($this->faker->text,0,20)),
            'order_date'           => $this->faker->dateTime(),
            'payment_condition_id' => $payment_condition_id,
            'currency_id'          => $currency_id,
            'due_date'             => $this->faker->dateTime(),
            'comments'             => $this->faker->regexify('[A-Z0-9]{30}'),
            'rate'                 => $this->faker->randomFloat(5, 0, 99999.99999),
            'balance'              => $this->faker->randomFloat(5, 0, 99999.99999),
            'gross_amount'         => $this->faker->randomFloat(5, 0, 99999.99999),
            'net_amount'           => $this->faker->randomFloat(5, 0, 99999.99999),
            'global_discount'      => $this->faker->randomFloat(5, 0, 99999.99999),
            'total_surcharge'      => $this->faker->randomFloat(5, 0, 99999.99999),
            'total_freight'        => $this->faker->randomFloat(5, 0, 99999.99999),
            'must_be_sync'         => $must_be_sync,
            'sync_at'              => $must_be_sync ? null : $this->faker->dateTime(),
            'created_by'           => $user_id,
            'updated_by'           => $user_id,
        ];
    }
}

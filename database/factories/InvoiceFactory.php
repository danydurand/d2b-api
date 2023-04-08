<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\ConditionPayment;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Seller;
use App\Models\Transport;
use App\Models\User;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id              = User::inRandomOrder()->first()->id;
        $customer_id          = Customer::inRandomOrder()->first()->id;
        $seller_id            = Seller::inRandomOrder()->first()->id;
        $transport_id         = Transport::inRandomOrder()->first()->id;
        $currency_id          = Currency::inRandomOrder()->first()->id;
        $branch_id            = Branch::inRandomOrder()->first()->id;
        $condition_payment_id = ConditionPayment::inRandomOrder()->first()->id;
        $must_be_sync         = $this->faker->boolean;

        return [
            'name'                       => Str::upper($this->faker->name),
            'fiscal_number'              => $this->faker->regexify('[A-Z0-9]{18}'),
            'fiscal_number2'             => $this->faker->regexify('[A-Z0-9]{18}'),
            'customer_id'                => $customer_id,
            'seller_id'                  => $seller_id,
            'transport_id'               => $transport_id,
            'currency_id'                => $currency_id,
            'branch_id'                  => $branch_id,
            'condition_payment_id'       => $condition_payment_id,
            'control_number'             => $this->faker->numberBetween(10000, 50000),
            'status'                     => $this->faker->randomLetter,
            'exchange_rate'              => $this->faker->randomFloat(5, 0, 99.99999),
            'description'                => Str::upper(Str::substr($this->faker->text, 0, 20)),
            'balance'                    => $this->faker->randomFloat(5, 0, 99999.99999),
            'bill_date'                  => $this->faker->dateTime(),
            'due_date'                   => $this->faker->dateTime(),
            'comments'                   => Str::upper(Str::substr($this->faker->text, 0, 30)),
            'delivery_address'           => Str::upper($this->faker->address()),
            'gross_amount'               => $this->faker->randomFloat(5, 0, 99999.99999),
            'net_amount'                 => $this->faker->randomFloat(5, 0, 99999.99999),
            'global_discount_percentage' => $this->faker->regexify('[0-9]{3}'),
            'global_discount_amount'     => $this->faker->randomFloat(5, 0, 99999.99999),
            'surcharge_percentage'       => $this->faker->regexify('[0-9]{3}'),
            'surcharge_amount'           => $this->faker->randomFloat(5, 0, 99999.99999),
            'freight_amount'             => $this->faker->randomFloat(5, 0, 99999.99999),
            'pay_back_amount'            => $this->faker->randomFloat(5, 0, 99999.99999),
            'tax_amount'                 => $this->faker->randomFloat(5, 0, 999.99999),
            'pay_back_tax_amount'        => $this->faker->randomFloat(5, 0, 99999.99999),
            'liqour_tax_amount'          => $this->faker->randomFloat(5, 0, 999.99999),
            'nullified'                  => $this->faker->boolean,
            'printed'                    => $this->faker->boolean,
            'field1'                     => null,
            'field2'                     => null,
            'field3'                     => null,
            'field4'                     => null,
            'field5'                     => null,
            'field6'                     => null,
            'field7'                     => null,
            'field8'                     => null,
            'other1'                     => null,
            'other2'                     => null,
            'other3'                     => null,
            'aux01'                      => null,
            'aux02'                      => null,
            'generic_customer_phone'     => null,
            'must_be_sync'               => $must_be_sync,
            'sync_at'                    => $must_be_sync ? null : $this->faker->dateTime(),
            'created_by'                 => $user_id,
            'updated_by'                 => $user_id,
        ];
    }
}

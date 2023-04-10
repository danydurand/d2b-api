<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\DocumentCxc;
use App\Models\DocumentType;
use App\Models\Seller;
use App\Models\User;

class DocumentCxcFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentCxc::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id          = User::inRandomOrder()->first()->id;
        $document_type_id = DocumentType::inRandomOrder()->first()->id;
        $customer_id      = Customer::inRandomOrder()->first()->id;
        $seller_id        = Seller::inRandomOrder()->first()->id;
        $branch_id        = Branch::inRandomOrder()->first()->id;
        $currency_id      = Currency::inRandomOrder()->first()->id;
        $must_be_sync     = $this->faker->boolean;

        return [
            'document_type_id'  => $document_type_id,
            'document_number'   => $this->faker->numberBetween(1, 10000),
            'nullified'         => $this->faker->boolean,
            'control_number'    => $this->faker->numberBetween(20000, 50000),
            'customer_id'       => $customer_id,
            'seller_id'         => $seller_id,
            'branch_id'         => $branch_id,
            'is_tax_payer'      => $this->faker->boolean,
            'document_date'     => $this->faker->dateTimeThisMonth(),
            'due_date'          => $this->faker->dateTimeThisMonth(),
            'tax_type'          => Str::upper($this->faker->randomLetter),
            'exchange_rate'     => $this->faker->randomFloat(5, 0, 99.99999),
            'currency_id'       => $currency_id,
            'tax_amount'        => $this->faker->randomFloat(5, 0, 9999.99999),
            'gross_amount'      => $this->faker->randomFloat(5, 0, 9999.99999),
            'discounts'         => $this->faker->regexify('[A-Z0-9]{10}'),
            'discount_amount'   => $this->faker->randomFloat(5, 0, 99.99999),
            'surcharge'         => $this->faker->regexify('[A-Z0-9]{10}'),
            'surcharge_amount'  => $this->faker->randomFloat(5, 0, 99999.99999),
            'other_amount'      => $this->faker->randomFloat(5, 0, 99999.99999),
            'net_amount'        => $this->faker->randomFloat(5, 0, 99999.99999),
            'balance'           => $this->faker->randomFloat(5, 0, 99999.99999),
            'liqour_tax_amount' => $this->faker->randomFloat(5, 0, 99999.99999),
            'comments'          => null,
            'field1'            => null,
            'field2'            => null,
            'field3'            => null,
            'field4'            => null,
            'field5'            => null,
            'field6'            => null,
            'field7'            => null,
            'field8'            => null,
            'other1'            => null,
            'other2'            => null,
            'other3'            => null,
            'aux01'             => null,
            'aux02'             => null,
            'record_date'       => $this->faker->dateTimeThisMonth(),
            'must_be_sync'      => $must_be_sync,
            'sync_at'           => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'        => $user_id,
            'updated_by'        => $user_id,
        ];
    }
}

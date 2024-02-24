<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\User;
use App\Models\Warehouse;

class InvoiceLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceLine::class;
    protected static $lastSequence = 0;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id      = User::inRandomOrder()->first()->id;
        // $invoice_id   = Invoice::inRandomOrder()->first()->id;
        $warehouse_id = Warehouse::inRandomOrder()->first()->id;
        $article_id   = Article::inRandomOrder()->first()->id;
        $sale_price   = $this->faker->randomFloat(5, 0.1, 999.99999);
        $qty          = $this->faker->randomFloat(5, 0, 50.99999);
        $net_line     = $sale_price * $qty;
        $must_be_sync = $this->faker->boolean;
        static::$lastSequence++;

        return [
            'invoice_id'                  => Invoice::factory(),
            'line_number'                 => static::$lastSequence,
            'origin_document_type'        => Str::upper($this->faker->randomLetter),
            'origin_line_number'          => static::$lastSequence,
            'article_id'                  => $article_id,
            'warehouse_id'                => $warehouse_id,
            'sub_total'                   => $this->faker->randomFloat(5, 0, 999.99999),
            'qty'                         => $qty,
            'qty_secondary_unit'          => $this->faker->randomFloat(5, 0, 999.99999),
            'pending'                     => $this->faker->randomFloat(5, 0, 999.99999),
            'sale_unit'                   => $this->faker->regexify('[A-Z0-9]{6}'),
            'sale_price'                  => $sale_price,
            'net_line'                    => $net_line,
            'discounts'                   => null,
            'tax_type'                    => Str::upper($this->faker->randomLetter),
            'average_unit_cost'           => $this->faker->randomFloat(5, 0, 99999.99999),
            'last_unit_cost'              => $this->faker->randomFloat(5, 0, 99999.99999),
            'average_unit_cost_oc'        => $this->faker->randomFloat(5, 0, 99999.99999),
            'last_unit_cost_oc'           => $this->faker->randomFloat(5, 0, 99999.99999),
            'pay_back_amount'             => $this->faker->randomFloat(5, 0, 99999.99999),
            'pay_back_total'              => $this->faker->randomFloat(5, 0, 99999.99999),
            'sale_price_oc'               => $this->faker->randomFloat(5, 0, 99999.99999),
            'article_generic_description' => null,
            'comments'                    => null,
            'total_units'                 => $this->faker->randomFloat(5, 0, 999.99999),
            'liqour_tax_amount'           => $this->faker->randomFloat(5, 0, 99.99999),
            'lot_number'                  => $this->faker->regexify('[A-Z0-9]{20}'),
            'lot_date'                    => $this->faker->dateTimeThisMonth(),
            'aux01'                       => null,
            'aux02'                       => null,
            'must_be_sync'                => $must_be_sync,
            'sync_at'                     => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'                  => $user_id,
            'updated_by'                  => $user_id,
        ];
    }
}

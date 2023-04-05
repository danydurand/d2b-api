<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\User;
use App\Models\Warehouse;

class OrderLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderLine::class;
    protected static $lastSequence = 0;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id      = User::inRandomOrder()->first()->id;
        $warehouse_id = Warehouse::inRandomOrder()->first()->id;
        $article_id   = Article::inRandomOrder()->first()->id;
        $qty          = $this->faker->randomFloat(5, 0, 30.99999);
        $sale_price   = $this->faker->randomFloat(5, 0, 999.99999);
        $net_amount   = $qty * $sale_price;
        $must_be_sync = $this->faker->boolean;
        static::$lastSequence++;

        return [
            'order_id'     => Order::factory(),
            'line_number'  => static::$lastSequence,
            'warehouse_id' => $warehouse_id,
            'article_id'   => $article_id,
            'qty'          => $qty,
            'sale_price'   => $sale_price,
            'sale_price2'  => $this->faker->randomFloat(5, 0, 999.99999),
            'net_amount'   => $net_amount,
            'must_be_sync' => $must_be_sync,
            'sync_at'      => $must_be_sync ? null : $this->faker->dateTime(),
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ];
    }
}

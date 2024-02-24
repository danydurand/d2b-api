<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Invoice;
use App\Models\StockWarehouse;
use App\Models\User;

class StockWarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockWarehouse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $warehouse_id = Warehouse::inRandomOrder()->first()->id;
        $article_id   = Article::inRandomOrder()->first()->id;
        $user_id      = User::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'warehouse_id'       => $warehouse_id,
            'article_id'         => $article_id,
            'actual_stock'       => $this->faker->randomFloat(5, 0, 9999.99999),
            'actual_sstock'      => $this->faker->randomFloat(5, 0, 9999.99999),
            'commited_stock'     => $this->faker->randomFloat(5, 0, 9999.99999),
            'commited_sstock'    => $this->faker->randomFloat(5, 0, 9999.99999),
            'to_arrive_stock'    => $this->faker->randomFloat(5, 0, 9999.99999),
            'to_arrive_sstock'   => $this->faker->randomFloat(5, 0, 9999.99999),
            'to_dispatch_stock'  => $this->faker->randomFloat(5, 0, 9999.99999),
            'to_dispatch_sstock' => $this->faker->randomFloat(5, 0, 9999.99999),
            'checked'            => Str::upper($this->faker->randomLetter),
            'must_be_sync'       => $must_be_sync,
            'sync_at'            => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'         => $user_id,
            'updated_by'         => $user_id,
        ];
    }
}

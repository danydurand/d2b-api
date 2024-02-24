<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\User;
use App\Models\Warehouse;

class WarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warehouse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $branch_id    = Branch::inRandomOrder()->first()->id;
        $user_id      = User::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'code'                   => $this->faker->regexify('[A-Z0-9]{6}'),
            'description'            => Str::upper(substr($this->faker->text,0,20)),
            'branch_id'              => $branch_id,
            'is_restricted_sales'    => $this->faker->boolean,
            'is_restricted_purchase' => $this->faker->boolean,
            'must_be_sync'           => $must_be_sync,
            'sync_at'                => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'             => $user_id,
            'updated_by'             => $user_id,
        ];

    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\SubBrand;
use App\Models\User;

class SubBrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubBrand::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $brand_id = Brand::inRandomOrder()->first()->id;
        $user_id  = User::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'brand_id'     => $brand_id,
            'description'  => Str::upper(substr($this->faker->text,0,20)),
            'must_be_sync' => $must_be_sync,
            'sync_at'      => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ];
    }
}

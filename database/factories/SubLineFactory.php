<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Line;
use App\Models\SubLine;
use App\Models\User;

class SubLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubLine::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $line_id = Line::inRandomOrder()->first()->id;
        $user_id = User::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'line_id'      => $line_id,
            'description'  => Str::upper(substr($this->faker->text,0,30)),
            'must_be_sync' => $must_be_sync,
            'sync_at'      => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ];
    }
}

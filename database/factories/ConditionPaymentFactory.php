<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\ConditionPayment;
use App\Models\User;

class ConditionPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConditionPayment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $branch_id    = Branch::inRandomOrder()->first()->id;
        $user_id      = User::inRandomOrder()->first()->id;
        $credit_days  = $this->faker->randomElement([15,30,45]);
        $must_be_sync = $this->faker->boolean;

        return [
            'description'  => Str::upper(Str::substr($this->faker->text,0,10)),
            'branch_id'    => $branch_id,
            'credit_days'  => $credit_days,
            'field1'       => null,
            'field2'       => null,
            'field3'       => null,
            'field4'       => null,
            'must_be_sync' => $must_be_sync,
            'sync_at'      => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ];
    }
}

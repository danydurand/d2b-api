<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DocumentType;
use App\Models\User;

class DocumentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id      = User::inRandomOrder()->first()->id;
        $must_be_sync = $this->faker->boolean;

        return [
            'description'  => Str::upper(substr($this->faker->text,0,20)),
            'must_be_sync' => $must_be_sync,
            'sync_at'      => $must_be_sync ? null : $this->faker->dateTimeThisMonth(),
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ];
    }
}

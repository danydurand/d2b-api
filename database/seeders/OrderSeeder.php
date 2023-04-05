<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Order::factory()
        // ->count(3)
        // ->has(OrderLine::factory()
        //     ->count(5)
        //     ->state(function (array $attributes, Order $order) {
        //         $lineNumbers = range(1, 5); // Create an array of line numbers from 1 to 5
        //         shuffle($lineNumbers); // Shuffle the array to get a random order of line numbers
        //         return [
        //             'line_number' => function () use (&$lineNumbers) {
        //                 return array_shift($lineNumbers); // Pop the first element of the array as the line number
        //             }
        //         ];
        //     })
        // )
        // ->create();

        Order::factory()
            ->count(4)
            ->hasOrderLines(5)
            ->create();

        Order::factory()
            ->count(10)
            ->hasOrderLines(4)
            ->create();

        Order::factory()
            ->count(5)
            ->hasOrderLines(9)
            ->create();

    }

}

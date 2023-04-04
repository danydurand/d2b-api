<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentCondition;
use App\Models\Seller;
use App\Models\Transport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OrderController
 */
class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('order.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OrderController::class,
            'store',
            \App\Http\Requests\Api\OrderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $number = $this->faker->word;
        $customer = Customer::factory()->create();
        $seller = Seller::factory()->create();
        $transport = Transport::factory()->create();
        $status = $this->faker->randomLetter;
        $description = $this->faker->text;
        $order_date = $this->faker->dateTime();
        $payment_condition = PaymentCondition::factory()->create();
        $currency = Currency::factory()->create();
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('order.store'), [
            'number' => $number,
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'transport_id' => $transport->id,
            'status' => $status,
            'description' => $description,
            'order_date' => $order_date,
            'payment_condition_id' => $payment_condition->id,
            'currency_id' => $currency->id,
            'must_be_sync' => $must_be_sync,
        ]);

        $orders = Order::query()
            ->where('number', $number)
            ->where('customer_id', $customer->id)
            ->where('seller_id', $seller->id)
            ->where('transport_id', $transport->id)
            ->where('status', $status)
            ->where('description', $description)
            ->where('order_date', $order_date)
            ->where('payment_condition_id', $payment_condition->id)
            ->where('currency_id', $currency->id)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('order.show', $order));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OrderController::class,
            'update',
            \App\Http\Requests\Api\OrderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $order = Order::factory()->create();
        $number = $this->faker->word;
        $customer = Customer::factory()->create();
        $seller = Seller::factory()->create();
        $transport = Transport::factory()->create();
        $status = $this->faker->randomLetter;
        $description = $this->faker->text;
        $order_date = $this->faker->dateTime();
        $payment_condition = PaymentCondition::factory()->create();
        $currency = Currency::factory()->create();
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('order.update', $order), [
            'number' => $number,
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'transport_id' => $transport->id,
            'status' => $status,
            'description' => $description,
            'order_date' => $order_date,
            'payment_condition_id' => $payment_condition->id,
            'currency_id' => $currency->id,
            'must_be_sync' => $must_be_sync,
        ]);

        $order->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($number, $order->number);
        $this->assertEquals($customer->id, $order->customer_id);
        $this->assertEquals($seller->id, $order->seller_id);
        $this->assertEquals($transport->id, $order->transport_id);
        $this->assertEquals($status, $order->status);
        $this->assertEquals($description, $order->description);
        $this->assertEquals($order_date, $order->order_date);
        $this->assertEquals($payment_condition->id, $order->payment_condition_id);
        $this->assertEquals($currency->id, $order->currency_id);
        $this->assertEquals($must_be_sync, $order->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('order.destroy', $order));

        $response->assertNoContent();

        $this->assertModelMissing($order);
    }
}

<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OrderLineController
 */
class OrderLineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $orderLines = OrderLine::factory()->count(3)->create();

        $response = $this->get(route('order-line.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OrderLineController::class,
            'store',
            \App\Http\Requests\Api\OrderLineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $order = Order::factory()->create();
        $line_number = $this->faker->numberBetween(-10000, 10000);
        $warehouse = Warehouse::factory()->create();
        $article = Article::factory()->create();
        $qty = $this->faker->randomFloat(/** decimal_attributes **/);
        $sale_price = $this->faker->randomFloat(/** decimal_attributes **/);
        $sale_price2 = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('order-line.store'), [
            'order_id' => $order->id,
            'line_number' => $line_number,
            'warehouse_id' => $warehouse->id,
            'article_id' => $article->id,
            'qty' => $qty,
            'sale_price' => $sale_price,
            'sale_price2' => $sale_price2,
            'must_be_sync' => $must_be_sync,
        ]);

        $orderLines = OrderLine::query()
            ->where('order_id', $order->id)
            ->where('line_number', $line_number)
            ->where('warehouse_id', $warehouse->id)
            ->where('article_id', $article->id)
            ->where('qty', $qty)
            ->where('sale_price', $sale_price)
            ->where('sale_price2', $sale_price2)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $orderLines);
        $orderLine = $orderLines->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $orderLine = OrderLine::factory()->create();

        $response = $this->get(route('order-line.show', $orderLine));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OrderLineController::class,
            'update',
            \App\Http\Requests\Api\OrderLineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $orderLine = OrderLine::factory()->create();
        $order = Order::factory()->create();
        $line_number = $this->faker->numberBetween(-10000, 10000);
        $warehouse = Warehouse::factory()->create();
        $article = Article::factory()->create();
        $qty = $this->faker->randomFloat(/** decimal_attributes **/);
        $sale_price = $this->faker->randomFloat(/** decimal_attributes **/);
        $sale_price2 = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('order-line.update', $orderLine), [
            'order_id' => $order->id,
            'line_number' => $line_number,
            'warehouse_id' => $warehouse->id,
            'article_id' => $article->id,
            'qty' => $qty,
            'sale_price' => $sale_price,
            'sale_price2' => $sale_price2,
            'must_be_sync' => $must_be_sync,
        ]);

        $orderLine->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($order->id, $orderLine->order_id);
        $this->assertEquals($line_number, $orderLine->line_number);
        $this->assertEquals($warehouse->id, $orderLine->warehouse_id);
        $this->assertEquals($article->id, $orderLine->article_id);
        $this->assertEquals($qty, $orderLine->qty);
        $this->assertEquals($sale_price, $orderLine->sale_price);
        $this->assertEquals($sale_price2, $orderLine->sale_price2);
        $this->assertEquals($must_be_sync, $orderLine->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $orderLine = OrderLine::factory()->create();

        $response = $this->delete(route('order-line.destroy', $orderLine));

        $response->assertNoContent();

        $this->assertModelMissing($orderLine);
    }
}

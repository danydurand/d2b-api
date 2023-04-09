<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Invoice;
use App\Models\StockWarehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\StockWarehouseController
 */
class StockWarehouseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $stockWarehouses = StockWarehouse::factory()->count(3)->create();

        $response = $this->get(route('stock-warehouse.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\StockWarehouseController::class,
            'store',
            \App\Http\Requests\Api\StockWarehouseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $invoice = Invoice::factory()->create();
        $article = Article::factory()->create();
        $actual_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $actual_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $commited_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $commited_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_arrive_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_arrive_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_dispatch_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_dispatch_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('stock-warehouse.store'), [
            'invoice_id' => $invoice->id,
            'article_id' => $article->id,
            'actual_stock' => $actual_stock,
            'actual_sstock' => $actual_sstock,
            'commited_stock' => $commited_stock,
            'commited_sstock' => $commited_sstock,
            'to_arrive_stock' => $to_arrive_stock,
            'to_arrive_sstock' => $to_arrive_sstock,
            'to_dispatch_stock' => $to_dispatch_stock,
            'to_dispatch_sstock' => $to_dispatch_sstock,
            'must_be_sync' => $must_be_sync,
        ]);

        $stockWarehouses = StockWarehouse::query()
            ->where('invoice_id', $invoice->id)
            ->where('article_id', $article->id)
            ->where('actual_stock', $actual_stock)
            ->where('actual_sstock', $actual_sstock)
            ->where('commited_stock', $commited_stock)
            ->where('commited_sstock', $commited_sstock)
            ->where('to_arrive_stock', $to_arrive_stock)
            ->where('to_arrive_sstock', $to_arrive_sstock)
            ->where('to_dispatch_stock', $to_dispatch_stock)
            ->where('to_dispatch_sstock', $to_dispatch_sstock)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $stockWarehouses);
        $stockWarehouse = $stockWarehouses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $stockWarehouse = StockWarehouse::factory()->create();

        $response = $this->get(route('stock-warehouse.show', $stockWarehouse));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\StockWarehouseController::class,
            'update',
            \App\Http\Requests\Api\StockWarehouseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $stockWarehouse = StockWarehouse::factory()->create();
        $invoice = Invoice::factory()->create();
        $article = Article::factory()->create();
        $actual_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $actual_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $commited_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $commited_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_arrive_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_arrive_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_dispatch_stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $to_dispatch_sstock = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('stock-warehouse.update', $stockWarehouse), [
            'invoice_id' => $invoice->id,
            'article_id' => $article->id,
            'actual_stock' => $actual_stock,
            'actual_sstock' => $actual_sstock,
            'commited_stock' => $commited_stock,
            'commited_sstock' => $commited_sstock,
            'to_arrive_stock' => $to_arrive_stock,
            'to_arrive_sstock' => $to_arrive_sstock,
            'to_dispatch_stock' => $to_dispatch_stock,
            'to_dispatch_sstock' => $to_dispatch_sstock,
            'must_be_sync' => $must_be_sync,
        ]);

        $stockWarehouse->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($invoice->id, $stockWarehouse->invoice_id);
        $this->assertEquals($article->id, $stockWarehouse->article_id);
        $this->assertEquals($actual_stock, $stockWarehouse->actual_stock);
        $this->assertEquals($actual_sstock, $stockWarehouse->actual_sstock);
        $this->assertEquals($commited_stock, $stockWarehouse->commited_stock);
        $this->assertEquals($commited_sstock, $stockWarehouse->commited_sstock);
        $this->assertEquals($to_arrive_stock, $stockWarehouse->to_arrive_stock);
        $this->assertEquals($to_arrive_sstock, $stockWarehouse->to_arrive_sstock);
        $this->assertEquals($to_dispatch_stock, $stockWarehouse->to_dispatch_stock);
        $this->assertEquals($to_dispatch_sstock, $stockWarehouse->to_dispatch_sstock);
        $this->assertEquals($must_be_sync, $stockWarehouse->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $stockWarehouse = StockWarehouse::factory()->create();

        $response = $this->delete(route('stock-warehouse.destroy', $stockWarehouse));

        $response->assertNoContent();

        $this->assertModelMissing($stockWarehouse);
    }
}

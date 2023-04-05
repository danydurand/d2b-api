<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\WarehouseController
 */
class WarehouseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $warehouses = Warehouse::factory()->count(3)->create();

        $response = $this->get(route('warehouse.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\WarehouseController::class,
            'store',
            \App\Http\Requests\Api\WarehouseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $code = $this->faker->word;
        $description = $this->faker->text;
        $branch = Branch::factory()->create();
        $is_restrcited_sales = $this->faker->boolean;
        $is_restrcited_purchase = $this->faker->boolean;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('warehouse.store'), [
            'code' => $code,
            'description' => $description,
            'branch_id' => $branch->id,
            'is_restrcited_sales' => $is_restrcited_sales,
            'is_restrcited_purchase' => $is_restrcited_purchase,
            'must_be_sync' => $must_be_sync,
        ]);

        $warehouses = Warehouse::query()
            ->where('code', $code)
            ->where('description', $description)
            ->where('branch_id', $branch->id)
            ->where('is_restrcited_sales', $is_restrcited_sales)
            ->where('is_restrcited_purchase', $is_restrcited_purchase)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $warehouses);
        $warehouse = $warehouses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->get(route('warehouse.show', $warehouse));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\WarehouseController::class,
            'update',
            \App\Http\Requests\Api\WarehouseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $warehouse = Warehouse::factory()->create();
        $code = $this->faker->word;
        $description = $this->faker->text;
        $branch = Branch::factory()->create();
        $is_restrcited_sales = $this->faker->boolean;
        $is_restrcited_purchase = $this->faker->boolean;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('warehouse.update', $warehouse), [
            'code' => $code,
            'description' => $description,
            'branch_id' => $branch->id,
            'is_restrcited_sales' => $is_restrcited_sales,
            'is_restrcited_purchase' => $is_restrcited_purchase,
            'must_be_sync' => $must_be_sync,
        ]);

        $warehouse->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $warehouse->code);
        $this->assertEquals($description, $warehouse->description);
        $this->assertEquals($branch->id, $warehouse->branch_id);
        $this->assertEquals($is_restrcited_sales, $warehouse->is_restrcited_sales);
        $this->assertEquals($is_restrcited_purchase, $warehouse->is_restrcited_purchase);
        $this->assertEquals($must_be_sync, $warehouse->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->delete(route('warehouse.destroy', $warehouse));

        $response->assertNoContent();

        $this->assertModelMissing($warehouse);
    }
}

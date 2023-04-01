<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\SaleUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SaleUnitController
 */
class SaleUnitControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $saleUnits = SaleUnit::factory()->count(3)->create();

        $response = $this->get(route('sale-unit.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SaleUnitController::class,
            'store',
            \App\Http\Requests\Api\SaleUnitStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('sale-unit.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $saleUnits = SaleUnit::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $saleUnits);
        $saleUnit = $saleUnits->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $saleUnit = SaleUnit::factory()->create();

        $response = $this->get(route('sale-unit.show', $saleUnit));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SaleUnitController::class,
            'update',
            \App\Http\Requests\Api\SaleUnitUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $saleUnit = SaleUnit::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('sale-unit.update', $saleUnit), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $saleUnit->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $saleUnit->description);
        $this->assertEquals($must_be_sync, $saleUnit->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $saleUnit = SaleUnit::factory()->create();

        $response = $this->delete(route('sale-unit.destroy', $saleUnit));

        $response->assertNoContent();

        $this->assertModelMissing($saleUnit);
    }
}

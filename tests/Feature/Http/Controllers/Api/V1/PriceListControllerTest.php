<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\PriceList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\V1\PriceListController
 */
class PriceListControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $priceLists = PriceList::factory()->count(3)->create();

        $response = $this->get(route('price-list.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\V1\PriceListController::class,
            'store',
            \App\Http\Requests\Api\V1\PriceListStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('price-list.store'), [
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $priceLists = PriceList::query()
            ->where('name', $name)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $priceLists);
        $priceList = $priceLists->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $priceList = PriceList::factory()->create();

        $response = $this->get(route('price-list.show', $priceList));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\V1\PriceListController::class,
            'update',
            \App\Http\Requests\Api\V1\PriceListUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $priceList = PriceList::factory()->create();
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('price-list.update', $priceList), [
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $priceList->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $priceList->name);
        $this->assertEquals($must_be_sync, $priceList->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $priceList = PriceList::factory()->create();

        $response = $this->delete(route('price-list.destroy', $priceList));

        $response->assertNoContent();

        $this->assertModelMissing($priceList);
    }
}

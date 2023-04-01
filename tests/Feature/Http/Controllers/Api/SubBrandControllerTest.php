<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Brand;
use App\Models\SubBrand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SubBrandController
 */
class SubBrandControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $subBrands = SubBrand::factory()->count(3)->create();

        $response = $this->get(route('sub-brand.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubBrandController::class,
            'store',
            \App\Http\Requests\Api\SubBrandStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $brand = Brand::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('sub-brand.store'), [
            'brand_id' => $brand->id,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $subBrands = SubBrand::query()
            ->where('brand_id', $brand->id)
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $subBrands);
        $subBrand = $subBrands->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $subBrand = SubBrand::factory()->create();

        $response = $this->get(route('sub-brand.show', $subBrand));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubBrandController::class,
            'update',
            \App\Http\Requests\Api\SubBrandUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $subBrand = SubBrand::factory()->create();
        $brand = Brand::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('sub-brand.update', $subBrand), [
            'brand_id' => $brand->id,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $subBrand->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($brand->id, $subBrand->brand_id);
        $this->assertEquals($description, $subBrand->description);
        $this->assertEquals($must_be_sync, $subBrand->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $subBrand = SubBrand::factory()->create();

        $response = $this->delete(route('sub-brand.destroy', $subBrand));

        $response->assertNoContent();

        $this->assertModelMissing($subBrand);
    }
}

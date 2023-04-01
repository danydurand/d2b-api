<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\BrandController
 */
class BrandControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $brands = Brand::factory()->count(3)->create();

        $response = $this->get(route('brand.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BrandController::class,
            'store',
            \App\Http\Requests\Api\BrandStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('brand.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $brands = Brand::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $brands);
        $brand = $brands->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brand.show', $brand));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BrandController::class,
            'update',
            \App\Http\Requests\Api\BrandUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $brand = Brand::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('brand.update', $brand), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $brand->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $brand->description);
        $this->assertEquals($must_be_sync, $brand->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('brand.destroy', $brand));

        $response->assertNoContent();

        $this->assertModelMissing($brand);
    }
}

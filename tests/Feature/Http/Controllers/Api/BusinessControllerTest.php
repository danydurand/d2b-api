<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\BusinessController
 */
class BusinessControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $businesses = Business::factory()->count(3)->create();

        $response = $this->get(route('business.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BusinessController::class,
            'store',
            \App\Http\Requests\Api\BusinessStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('business.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $businesses = Business::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $businesses);
        $business = $businesses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $business = Business::factory()->create();

        $response = $this->get(route('business.show', $business));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BusinessController::class,
            'update',
            \App\Http\Requests\Api\BusinessUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $business = Business::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('business.update', $business), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $business->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $business->description);
        $this->assertEquals($must_be_sync, $business->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $business = Business::factory()->create();

        $response = $this->delete(route('business.destroy', $business));

        $response->assertNoContent();

        $this->assertModelMissing($business);
    }
}

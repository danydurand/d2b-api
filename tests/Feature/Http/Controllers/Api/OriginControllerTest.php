<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Origin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OriginController
 */
class OriginControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $origins = Origin::factory()->count(3)->create();

        $response = $this->get(route('origin.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OriginController::class,
            'store',
            \App\Http\Requests\Api\OriginStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('origin.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $origins = Origin::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $origins);
        $origin = $origins->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $origin = Origin::factory()->create();

        $response = $this->get(route('origin.show', $origin));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OriginController::class,
            'update',
            \App\Http\Requests\Api\OriginUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $origin = Origin::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('origin.update', $origin), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $origin->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $origin->description);
        $this->assertEquals($must_be_sync, $origin->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $origin = Origin::factory()->create();

        $response = $this->delete(route('origin.destroy', $origin));

        $response->assertNoContent();

        $this->assertModelMissing($origin);
    }
}

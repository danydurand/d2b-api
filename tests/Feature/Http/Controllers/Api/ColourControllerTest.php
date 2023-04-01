<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Colour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ColourController
 */
class ColourControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $colours = Colour::factory()->count(3)->create();

        $response = $this->get(route('colour.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ColourController::class,
            'store',
            \App\Http\Requests\Api\ColourStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('colour.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $colours = Colour::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $colours);
        $colour = $colours->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $colour = Colour::factory()->create();

        $response = $this->get(route('colour.show', $colour));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ColourController::class,
            'update',
            \App\Http\Requests\Api\ColourUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $colour = Colour::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('colour.update', $colour), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $colour->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $colour->description);
        $this->assertEquals($must_be_sync, $colour->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $colour = Colour::factory()->create();

        $response = $this->delete(route('colour.destroy', $colour));

        $response->assertNoContent();

        $this->assertModelMissing($colour);
    }
}

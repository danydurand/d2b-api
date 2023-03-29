<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Line;
use App\Models\SubLine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SubLineController
 */
class SubLineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $subLines = SubLine::factory()->count(3)->create();

        $response = $this->get(route('sub-line.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubLineController::class,
            'store',
            \App\Http\Requests\Api\SubLineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $line = Line::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('sub-line.store'), [
            'line_id' => $line->id,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $subLines = SubLine::query()
            ->where('line_id', $line->id)
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $subLines);
        $subLine = $subLines->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $subLine = SubLine::factory()->create();

        $response = $this->get(route('sub-line.show', $subLine));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubLineController::class,
            'update',
            \App\Http\Requests\Api\SubLineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $subLine = SubLine::factory()->create();
        $line = Line::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('sub-line.update', $subLine), [
            'line_id' => $line->id,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $subLine->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($line->id, $subLine->line_id);
        $this->assertEquals($description, $subLine->description);
        $this->assertEquals($must_be_sync, $subLine->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $subLine = SubLine::factory()->create();

        $response = $this->delete(route('sub-line.destroy', $subLine));

        $response->assertNoContent();

        $this->assertModelMissing($subLine);
    }
}

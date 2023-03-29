<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Line;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\LineController
 */
class LineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $lines = Line::factory()->count(3)->create();

        $response = $this->get(route('line.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\LineController::class,
            'store',
            \App\Http\Requests\Api\LineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $category = Category::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('line.store'), [
            'category_id' => $category->id,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $lines = Line::query()
            ->where('category_id', $category->id)
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $lines);
        $line = $lines->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $line = Line::factory()->create();

        $response = $this->get(route('line.show', $line));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\LineController::class,
            'update',
            \App\Http\Requests\Api\LineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $line = Line::factory()->create();
        $category = Category::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('line.update', $line), [
            'category_id' => $category->id,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $line->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($category->id, $line->category_id);
        $this->assertEquals($description, $line->description);
        $this->assertEquals($must_be_sync, $line->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $line = Line::factory()->create();

        $response = $this->delete(route('line.destroy', $line));

        $response->assertNoContent();

        $this->assertModelMissing($line);
    }
}

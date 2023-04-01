<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ArticleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ArticleTypeController
 */
class ArticleTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $articleTypes = ArticleType::factory()->count(3)->create();

        $response = $this->get(route('article-type.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ArticleTypeController::class,
            'store',
            \App\Http\Requests\Api\ArticleTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('article-type.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $articleTypes = ArticleType::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $articleTypes);
        $articleType = $articleTypes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $articleType = ArticleType::factory()->create();

        $response = $this->get(route('article-type.show', $articleType));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ArticleTypeController::class,
            'update',
            \App\Http\Requests\Api\ArticleTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $articleType = ArticleType::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('article-type.update', $articleType), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $articleType->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $articleType->description);
        $this->assertEquals($must_be_sync, $articleType->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $articleType = ArticleType::factory()->create();

        $response = $this->delete(route('article-type.destroy', $articleType));

        $response->assertNoContent();

        $this->assertModelMissing($articleType);
    }
}

<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\DocumentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\DocumentTypeController
 */
class DocumentTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $documentTypes = DocumentType::factory()->count(3)->create();

        $response = $this->get(route('document-type.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DocumentTypeController::class,
            'store',
            \App\Http\Requests\Api\DocumentTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('document-type.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $documentTypes = DocumentType::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $documentTypes);
        $documentType = $documentTypes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $documentType = DocumentType::factory()->create();

        $response = $this->get(route('document-type.show', $documentType));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DocumentTypeController::class,
            'update',
            \App\Http\Requests\Api\DocumentTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $documentType = DocumentType::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('document-type.update', $documentType), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $documentType->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $documentType->description);
        $this->assertEquals($must_be_sync, $documentType->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $documentType = DocumentType::factory()->create();

        $response = $this->delete(route('document-type.destroy', $documentType));

        $response->assertNoContent();

        $this->assertModelMissing($documentType);
    }
}

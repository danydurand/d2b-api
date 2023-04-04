<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\BranchController
 */
class BranchControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $branches = Branch::factory()->count(3)->create();

        $response = $this->get(route('branch.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BranchController::class,
            'store',
            \App\Http\Requests\Api\BranchStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('branch.store'), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $branches = Branch::query()
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $branches);
        $branch = $branches->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $branch = Branch::factory()->create();

        $response = $this->get(route('branch.show', $branch));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BranchController::class,
            'update',
            \App\Http\Requests\Api\BranchUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $branch = Branch::factory()->create();
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('branch.update', $branch), [
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $branch->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $branch->description);
        $this->assertEquals($must_be_sync, $branch->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $branch = Branch::factory()->create();

        $response = $this->delete(route('branch.destroy', $branch));

        $response->assertNoContent();

        $this->assertModelMissing($branch);
    }
}

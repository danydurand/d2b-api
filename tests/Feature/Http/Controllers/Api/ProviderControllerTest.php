<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ProviderController
 */
class ProviderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $providers = Provider::factory()->count(3)->create();

        $response = $this->get(route('provider.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ProviderController::class,
            'store',
            \App\Http\Requests\Api\ProviderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('provider.store'), [
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $providers = Provider::query()
            ->where('name', $name)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $providers);
        $provider = $providers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $provider = Provider::factory()->create();

        $response = $this->get(route('provider.show', $provider));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ProviderController::class,
            'update',
            \App\Http\Requests\Api\ProviderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $provider = Provider::factory()->create();
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('provider.update', $provider), [
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $provider->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $provider->name);
        $this->assertEquals($must_be_sync, $provider->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $provider = Provider::factory()->create();

        $response = $this->delete(route('provider.destroy', $provider));

        $response->assertNoContent();

        $this->assertModelMissing($provider);
    }
}

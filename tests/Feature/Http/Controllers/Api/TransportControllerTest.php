<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Transport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\TransportController
 */
class TransportControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $transports = Transport::factory()->count(3)->create();

        $response = $this->get(route('transport.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransportController::class,
            'store',
            \App\Http\Requests\Api\TransportStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $code = $this->faker->word;
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('transport.store'), [
            'code' => $code,
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $transports = Transport::query()
            ->where('code', $code)
            ->where('name', $name)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $transports);
        $transport = $transports->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $transport = Transport::factory()->create();

        $response = $this->get(route('transport.show', $transport));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransportController::class,
            'update',
            \App\Http\Requests\Api\TransportUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $transport = Transport::factory()->create();
        $code = $this->faker->word;
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('transport.update', $transport), [
            'code' => $code,
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $transport->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $transport->code);
        $this->assertEquals($name, $transport->name);
        $this->assertEquals($must_be_sync, $transport->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $transport = Transport::factory()->create();

        $response = $this->delete(route('transport.destroy', $transport));

        $response->assertNoContent();

        $this->assertModelMissing($transport);
    }
}

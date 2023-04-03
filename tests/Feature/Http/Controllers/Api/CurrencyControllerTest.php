<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurrencyController
 */
class CurrencyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $currencies = Currency::factory()->count(3)->create();

        $response = $this->get(route('currency.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurrencyController::class,
            'store',
            \App\Http\Requests\Api\CurrencyStoreRequest::class
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

        $response = $this->post(route('currency.store'), [
            'code' => $code,
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $currencies = Currency::query()
            ->where('code', $code)
            ->where('name', $name)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $currencies);
        $currency = $currencies->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $currency = Currency::factory()->create();

        $response = $this->get(route('currency.show', $currency));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurrencyController::class,
            'update',
            \App\Http\Requests\Api\CurrencyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $currency = Currency::factory()->create();
        $code = $this->faker->word;
        $name = $this->faker->name;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('currency.update', $currency), [
            'code' => $code,
            'name' => $name,
            'must_be_sync' => $must_be_sync,
        ]);

        $currency->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $currency->code);
        $this->assertEquals($name, $currency->name);
        $this->assertEquals($must_be_sync, $currency->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $currency = Currency::factory()->create();

        $response = $this->delete(route('currency.destroy', $currency));

        $response->assertNoContent();

        $this->assertModelMissing($currency);
    }
}

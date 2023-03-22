<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\CustomerType;
use App\Models\PriceList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\V1\CustomerTypeController
 */
class CustomerTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $customerTypes = CustomerType::factory()->count(3)->create();

        $response = $this->get(route('customer-type.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\V1\CustomerTypeController::class,
            'store',
            \App\Http\Requests\Api\V1\CustomerTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $code = $this->faker->word;
        $description = $this->faker->text;
        $price_list = PriceList::factory()->create();
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('customer-type.store'), [
            'code' => $code,
            'description' => $description,
            'price_list_id' => $price_list->id,
            'must_be_sync' => $must_be_sync,
        ]);

        $customerTypes = CustomerType::query()
            ->where('code', $code)
            ->where('description', $description)
            ->where('price_list_id', $price_list->id)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $customerTypes);
        $customerType = $customerTypes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $customerType = CustomerType::factory()->create();

        $response = $this->get(route('customer-type.show', $customerType));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\V1\CustomerTypeController::class,
            'update',
            \App\Http\Requests\Api\V1\CustomerTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $customerType = CustomerType::factory()->create();
        $code = $this->faker->word;
        $description = $this->faker->text;
        $price_list = PriceList::factory()->create();
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('customer-type.update', $customerType), [
            'code' => $code,
            'description' => $description,
            'price_list_id' => $price_list->id,
            'must_be_sync' => $must_be_sync,
        ]);

        $customerType->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $customerType->code);
        $this->assertEquals($description, $customerType->description);
        $this->assertEquals($price_list->id, $customerType->price_list_id);
        $this->assertEquals($must_be_sync, $customerType->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $customerType = CustomerType::factory()->create();

        $response = $this->delete(route('customer-type.destroy', $customerType));

        $response->assertNoContent();

        $this->assertModelMissing($customerType);
    }
}

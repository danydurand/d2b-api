<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CustomerController
 */
class CustomerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $customers = Customer::factory()->count(3)->create();

        $response = $this->get(route('customer.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CustomerController::class,
            'store',
            \App\Http\Requests\Api\CustomerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $code = $this->faker->word;
        $fiscal_number = $this->faker->word;
        $business_name = $this->faker->word;
        $customer_type = CustomerType::factory()->create();
        $seller = Seller::factory()->create();
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('customer.store'), [
            'code' => $code,
            'fiscal_number' => $fiscal_number,
            'business_name' => $business_name,
            'customer_type_id' => $customer_type->id,
            'seller_id' => $seller->id,
            'must_be_sync' => $must_be_sync,
        ]);

        $customers = Customer::query()
            ->where('code', $code)
            ->where('fiscal_number', $fiscal_number)
            ->where('business_name', $business_name)
            ->where('customer_type_id', $customer_type->id)
            ->where('seller_id', $seller->id)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $customers);
        $customer = $customers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customer.show', $customer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CustomerController::class,
            'update',
            \App\Http\Requests\Api\CustomerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $customer = Customer::factory()->create();
        $code = $this->faker->word;
        $fiscal_number = $this->faker->word;
        $business_name = $this->faker->word;
        $customer_type = CustomerType::factory()->create();
        $seller = Seller::factory()->create();
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('customer.update', $customer), [
            'code' => $code,
            'fiscal_number' => $fiscal_number,
            'business_name' => $business_name,
            'customer_type_id' => $customer_type->id,
            'seller_id' => $seller->id,
            'must_be_sync' => $must_be_sync,
        ]);

        $customer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $customer->code);
        $this->assertEquals($fiscal_number, $customer->fiscal_number);
        $this->assertEquals($business_name, $customer->business_name);
        $this->assertEquals($customer_type->id, $customer->customer_type_id);
        $this->assertEquals($seller->id, $customer->seller_id);
        $this->assertEquals($must_be_sync, $customer->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->delete(route('customer.destroy', $customer));

        $response->assertNoContent();

        $this->assertModelMissing($customer);
    }
}

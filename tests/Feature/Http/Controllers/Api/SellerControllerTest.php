<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SellerController
 */
class SellerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $sellers = Seller::factory()->count(3)->create();

        $response = $this->get(route('seller.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SellerController::class,
            'store',
            \App\Http\Requests\Api\SellerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $sales_commission = $this->faker->randomFloat(/** decimal_attributes **/);
        $collect_commission = $this->faker->randomFloat(/** decimal_attributes **/);
        $login = $this->faker->word;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('seller.store'), [
            'name' => $name,
            'sales_commission' => $sales_commission,
            'collect_commission' => $collect_commission,
            'login' => $login,
            'must_be_sync' => $must_be_sync,
        ]);

        $sellers = Seller::query()
            ->where('name', $name)
            ->where('sales_commission', $sales_commission)
            ->where('collect_commission', $collect_commission)
            ->where('login', $login)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $sellers);
        $seller = $sellers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->get(route('seller.show', $seller));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SellerController::class,
            'update',
            \App\Http\Requests\Api\SellerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $seller = Seller::factory()->create();
        $name = $this->faker->name;
        $sales_commission = $this->faker->randomFloat(/** decimal_attributes **/);
        $collect_commission = $this->faker->randomFloat(/** decimal_attributes **/);
        $login = $this->faker->word;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('seller.update', $seller), [
            'name' => $name,
            'sales_commission' => $sales_commission,
            'collect_commission' => $collect_commission,
            'login' => $login,
            'must_be_sync' => $must_be_sync,
        ]);

        $seller->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $seller->name);
        $this->assertEquals($sales_commission, $seller->sales_commission);
        $this->assertEquals($collect_commission, $seller->collect_commission);
        $this->assertEquals($login, $seller->login);
        $this->assertEquals($must_be_sync, $seller->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->delete(route('seller.destroy', $seller));

        $response->assertNoContent();

        $this->assertModelMissing($seller);
    }
}

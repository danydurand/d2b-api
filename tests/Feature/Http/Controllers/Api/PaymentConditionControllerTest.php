<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\PaymentCondition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PaymentConditionController
 */
class PaymentConditionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $paymentConditions = PaymentCondition::factory()->count(3)->create();

        $response = $this->get(route('payment-condition.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PaymentConditionController::class,
            'store',
            \App\Http\Requests\Api\PaymentConditionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $code = $this->faker->word;
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('payment-condition.store'), [
            'code' => $code,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $paymentConditions = PaymentCondition::query()
            ->where('code', $code)
            ->where('description', $description)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $paymentConditions);
        $paymentCondition = $paymentConditions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $paymentCondition = PaymentCondition::factory()->create();

        $response = $this->get(route('payment-condition.show', $paymentCondition));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PaymentConditionController::class,
            'update',
            \App\Http\Requests\Api\PaymentConditionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $paymentCondition = PaymentCondition::factory()->create();
        $code = $this->faker->word;
        $description = $this->faker->text;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('payment-condition.update', $paymentCondition), [
            'code' => $code,
            'description' => $description,
            'must_be_sync' => $must_be_sync,
        ]);

        $paymentCondition->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $paymentCondition->code);
        $this->assertEquals($description, $paymentCondition->description);
        $this->assertEquals($must_be_sync, $paymentCondition->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $paymentCondition = PaymentCondition::factory()->create();

        $response = $this->delete(route('payment-condition.destroy', $paymentCondition));

        $response->assertNoContent();

        $this->assertModelMissing($paymentCondition);
    }
}

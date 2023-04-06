<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\ConditionPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ConditionPaymentController
 */
class ConditionPaymentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $conditionPayments = ConditionPayment::factory()->count(3)->create();

        $response = $this->get(route('condition-payment.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ConditionPaymentController::class,
            'store',
            \App\Http\Requests\Api\ConditionPaymentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $description = $this->faker->text;
        $branch = Branch::factory()->create();
        $credit_days = $this->faker->numberBetween(-10000, 10000);
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('condition-payment.store'), [
            'description' => $description,
            'branch_id' => $branch->id,
            'credit_days' => $credit_days,
            'must_be_sync' => $must_be_sync,
        ]);

        $conditionPayments = ConditionPayment::query()
            ->where('description', $description)
            ->where('branch_id', $branch->id)
            ->where('credit_days', $credit_days)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $conditionPayments);
        $conditionPayment = $conditionPayments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $conditionPayment = ConditionPayment::factory()->create();

        $response = $this->get(route('condition-payment.show', $conditionPayment));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ConditionPaymentController::class,
            'update',
            \App\Http\Requests\Api\ConditionPaymentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $conditionPayment = ConditionPayment::factory()->create();
        $description = $this->faker->text;
        $branch = Branch::factory()->create();
        $credit_days = $this->faker->numberBetween(-10000, 10000);
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('condition-payment.update', $conditionPayment), [
            'description' => $description,
            'branch_id' => $branch->id,
            'credit_days' => $credit_days,
            'must_be_sync' => $must_be_sync,
        ]);

        $conditionPayment->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($description, $conditionPayment->description);
        $this->assertEquals($branch->id, $conditionPayment->branch_id);
        $this->assertEquals($credit_days, $conditionPayment->credit_days);
        $this->assertEquals($must_be_sync, $conditionPayment->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $conditionPayment = ConditionPayment::factory()->create();

        $response = $this->delete(route('condition-payment.destroy', $conditionPayment));

        $response->assertNoContent();

        $this->assertModelMissing($conditionPayment);
    }
}

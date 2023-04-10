<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\DocumentCxc;
use App\Models\DocumentType;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\DocumentCxcController
 */
class DocumentCxcControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $documentCxcs = DocumentCxc::factory()->count(3)->create();

        $response = $this->get(route('document-cxc.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DocumentCxcController::class,
            'store',
            \App\Http\Requests\Api\DocumentCxcStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $document_type = DocumentType::factory()->create();
        $document_number = $this->faker->numberBetween(-10000, 10000);
        $nullified = $this->faker->boolean;
        $control_number = $this->faker->numberBetween(-10000, 10000);
        $customer = Customer::factory()->create();
        $seller = Seller::factory()->create();
        $branch = Branch::factory()->create();
        $is_tax_payer = $this->faker->boolean;
        $document_date = $this->faker->dateTime();
        $due_date = $this->faker->dateTime();
        $tax_type = $this->faker->randomLetter;
        $exchange_rate = $this->faker->randomFloat(/** decimal_attributes **/);
        $currency = Currency::factory()->create();
        $tax_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $gross_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $discount_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $balance = $this->faker->randomFloat(/** decimal_attributes **/);
        $record_date = $this->faker->dateTime();
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('document-cxc.store'), [
            'document_type_id' => $document_type->id,
            'document_number' => $document_number,
            'nullified' => $nullified,
            'control_number' => $control_number,
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'branch_id' => $branch->id,
            'is_tax_payer' => $is_tax_payer,
            'document_date' => $document_date,
            'due_date' => $due_date,
            'tax_type' => $tax_type,
            'exchange_rate' => $exchange_rate,
            'currency_id' => $currency->id,
            'tax_amount' => $tax_amount,
            'gross_amount' => $gross_amount,
            'discount_amount' => $discount_amount,
            'balance' => $balance,
            'record_date' => $record_date,
            'must_be_sync' => $must_be_sync,
        ]);

        $documentCxcs = DocumentCxc::query()
            ->where('document_type_id', $document_type->id)
            ->where('document_number', $document_number)
            ->where('nullified', $nullified)
            ->where('control_number', $control_number)
            ->where('customer_id', $customer->id)
            ->where('seller_id', $seller->id)
            ->where('branch_id', $branch->id)
            ->where('is_tax_payer', $is_tax_payer)
            ->where('document_date', $document_date)
            ->where('due_date', $due_date)
            ->where('tax_type', $tax_type)
            ->where('exchange_rate', $exchange_rate)
            ->where('currency_id', $currency->id)
            ->where('tax_amount', $tax_amount)
            ->where('gross_amount', $gross_amount)
            ->where('discount_amount', $discount_amount)
            ->where('balance', $balance)
            ->where('record_date', $record_date)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $documentCxcs);
        $documentCxc = $documentCxcs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $documentCxc = DocumentCxc::factory()->create();

        $response = $this->get(route('document-cxc.show', $documentCxc));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DocumentCxcController::class,
            'update',
            \App\Http\Requests\Api\DocumentCxcUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $documentCxc = DocumentCxc::factory()->create();
        $document_type = DocumentType::factory()->create();
        $document_number = $this->faker->numberBetween(-10000, 10000);
        $nullified = $this->faker->boolean;
        $control_number = $this->faker->numberBetween(-10000, 10000);
        $customer = Customer::factory()->create();
        $seller = Seller::factory()->create();
        $branch = Branch::factory()->create();
        $is_tax_payer = $this->faker->boolean;
        $document_date = $this->faker->dateTime();
        $due_date = $this->faker->dateTime();
        $tax_type = $this->faker->randomLetter;
        $exchange_rate = $this->faker->randomFloat(/** decimal_attributes **/);
        $currency = Currency::factory()->create();
        $tax_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $gross_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $discount_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $balance = $this->faker->randomFloat(/** decimal_attributes **/);
        $record_date = $this->faker->dateTime();
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('document-cxc.update', $documentCxc), [
            'document_type_id' => $document_type->id,
            'document_number' => $document_number,
            'nullified' => $nullified,
            'control_number' => $control_number,
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'branch_id' => $branch->id,
            'is_tax_payer' => $is_tax_payer,
            'document_date' => $document_date,
            'due_date' => $due_date,
            'tax_type' => $tax_type,
            'exchange_rate' => $exchange_rate,
            'currency_id' => $currency->id,
            'tax_amount' => $tax_amount,
            'gross_amount' => $gross_amount,
            'discount_amount' => $discount_amount,
            'balance' => $balance,
            'record_date' => $record_date,
            'must_be_sync' => $must_be_sync,
        ]);

        $documentCxc->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($document_type->id, $documentCxc->document_type_id);
        $this->assertEquals($document_number, $documentCxc->document_number);
        $this->assertEquals($nullified, $documentCxc->nullified);
        $this->assertEquals($control_number, $documentCxc->control_number);
        $this->assertEquals($customer->id, $documentCxc->customer_id);
        $this->assertEquals($seller->id, $documentCxc->seller_id);
        $this->assertEquals($branch->id, $documentCxc->branch_id);
        $this->assertEquals($is_tax_payer, $documentCxc->is_tax_payer);
        $this->assertEquals($document_date, $documentCxc->document_date);
        $this->assertEquals($due_date, $documentCxc->due_date);
        $this->assertEquals($tax_type, $documentCxc->tax_type);
        $this->assertEquals($exchange_rate, $documentCxc->exchange_rate);
        $this->assertEquals($currency->id, $documentCxc->currency_id);
        $this->assertEquals($tax_amount, $documentCxc->tax_amount);
        $this->assertEquals($gross_amount, $documentCxc->gross_amount);
        $this->assertEquals($discount_amount, $documentCxc->discount_amount);
        $this->assertEquals($balance, $documentCxc->balance);
        $this->assertEquals($record_date, $documentCxc->record_date);
        $this->assertEquals($must_be_sync, $documentCxc->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $documentCxc = DocumentCxc::factory()->create();

        $response = $this->delete(route('document-cxc.destroy', $documentCxc));

        $response->assertNoContent();

        $this->assertModelMissing($documentCxc);
    }
}

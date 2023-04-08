<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\ConditionPayments;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Seller;
use App\Models\Transport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InvoiceController
 */
class InvoiceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $invoices = Invoice::factory()->count(3)->create();

        $response = $this->get(route('invoice.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InvoiceController::class,
            'store',
            \App\Http\Requests\Api\InvoiceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $fiscal_number = $this->faker->word;
        $fiscal_number2 = $this->faker->word;
        $customer = Customer::factory()->create();
        $seller = Seller::factory()->create();
        $transport = Transport::factory()->create();
        $currency = Currency::factory()->create();
        $branch = Branch::factory()->create();
        $condition_payments = ConditionPayments::factory()->create();
        $control_number = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomLetter;
        $exchange_rate = $this->faker->randomFloat(/** decimal_attributes **/);
        $balance = $this->faker->randomFloat(/** decimal_attributes **/);
        $bill_date = $this->faker->dateTime();
        $due_date = $this->faker->dateTime();
        $gross_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $net_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('invoice.store'), [
            'name' => $name,
            'fiscal_number' => $fiscal_number,
            'fiscal_number2' => $fiscal_number2,
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'transport_id' => $transport->id,
            'currency_id' => $currency->id,
            'branch_id' => $branch->id,
            'condition_payments_id' => $condition_payments->id,
            'control_number' => $control_number,
            'status' => $status,
            'exchange_rate' => $exchange_rate,
            'balance' => $balance,
            'bill_date' => $bill_date,
            'due_date' => $due_date,
            'gross_amount' => $gross_amount,
            'net_amount' => $net_amount,
            'must_be_sync' => $must_be_sync,
        ]);

        $invoices = Invoice::query()
            ->where('name', $name)
            ->where('fiscal_number', $fiscal_number)
            ->where('fiscal_number2', $fiscal_number2)
            ->where('customer_id', $customer->id)
            ->where('seller_id', $seller->id)
            ->where('transport_id', $transport->id)
            ->where('currency_id', $currency->id)
            ->where('branch_id', $branch->id)
            ->where('condition_payments_id', $condition_payments->id)
            ->where('control_number', $control_number)
            ->where('status', $status)
            ->where('exchange_rate', $exchange_rate)
            ->where('balance', $balance)
            ->where('bill_date', $bill_date)
            ->where('due_date', $due_date)
            ->where('gross_amount', $gross_amount)
            ->where('net_amount', $net_amount)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $invoices);
        $invoice = $invoices->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $invoice = Invoice::factory()->create();

        $response = $this->get(route('invoice.show', $invoice));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InvoiceController::class,
            'update',
            \App\Http\Requests\Api\InvoiceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $invoice = Invoice::factory()->create();
        $name = $this->faker->name;
        $fiscal_number = $this->faker->word;
        $fiscal_number2 = $this->faker->word;
        $customer = Customer::factory()->create();
        $seller = Seller::factory()->create();
        $transport = Transport::factory()->create();
        $currency = Currency::factory()->create();
        $branch = Branch::factory()->create();
        $condition_payments = ConditionPayments::factory()->create();
        $control_number = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomLetter;
        $exchange_rate = $this->faker->randomFloat(/** decimal_attributes **/);
        $balance = $this->faker->randomFloat(/** decimal_attributes **/);
        $bill_date = $this->faker->dateTime();
        $due_date = $this->faker->dateTime();
        $gross_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $net_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('invoice.update', $invoice), [
            'name' => $name,
            'fiscal_number' => $fiscal_number,
            'fiscal_number2' => $fiscal_number2,
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'transport_id' => $transport->id,
            'currency_id' => $currency->id,
            'branch_id' => $branch->id,
            'condition_payments_id' => $condition_payments->id,
            'control_number' => $control_number,
            'status' => $status,
            'exchange_rate' => $exchange_rate,
            'balance' => $balance,
            'bill_date' => $bill_date,
            'due_date' => $due_date,
            'gross_amount' => $gross_amount,
            'net_amount' => $net_amount,
            'must_be_sync' => $must_be_sync,
        ]);

        $invoice->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $invoice->name);
        $this->assertEquals($fiscal_number, $invoice->fiscal_number);
        $this->assertEquals($fiscal_number2, $invoice->fiscal_number2);
        $this->assertEquals($customer->id, $invoice->customer_id);
        $this->assertEquals($seller->id, $invoice->seller_id);
        $this->assertEquals($transport->id, $invoice->transport_id);
        $this->assertEquals($currency->id, $invoice->currency_id);
        $this->assertEquals($branch->id, $invoice->branch_id);
        $this->assertEquals($condition_payments->id, $invoice->condition_payments_id);
        $this->assertEquals($control_number, $invoice->control_number);
        $this->assertEquals($status, $invoice->status);
        $this->assertEquals($exchange_rate, $invoice->exchange_rate);
        $this->assertEquals($balance, $invoice->balance);
        $this->assertEquals($bill_date, $invoice->bill_date);
        $this->assertEquals($due_date, $invoice->due_date);
        $this->assertEquals($gross_amount, $invoice->gross_amount);
        $this->assertEquals($net_amount, $invoice->net_amount);
        $this->assertEquals($must_be_sync, $invoice->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $invoice = Invoice::factory()->create();

        $response = $this->delete(route('invoice.destroy', $invoice));

        $response->assertNoContent();

        $this->assertModelMissing($invoice);
    }
}

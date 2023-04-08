<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InvoiceLineController
 */
class InvoiceLineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $invoiceLines = InvoiceLine::factory()->count(3)->create();

        $response = $this->get(route('invoice-line.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InvoiceLineController::class,
            'store',
            \App\Http\Requests\Api\InvoiceLineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $invoice = Invoice::factory()->create();
        $line_number = $this->faker->numberBetween(-10000, 10000);
        $origin_document_type = $this->faker->randomLetter;
        $origin_line_number = $this->faker->numberBetween(-10000, 10000);
        $article = Article::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $sub_total = $this->faker->randomFloat(/** decimal_attributes **/);
        $qty = $this->faker->randomFloat(/** decimal_attributes **/);
        $qty_secondary_unit = $this->faker->randomFloat(/** decimal_attributes **/);
        $pending = $this->faker->randomFloat(/** decimal_attributes **/);
        $sale_unit = $this->faker->word;
        $sale_price = $this->faker->randomFloat(/** decimal_attributes **/);
        $discounts = $this->faker->word;
        $tax_type = $this->faker->randomLetter;
        $net_line = $this->faker->randomFloat(/** decimal_attributes **/);
        $average_unit_cost = $this->faker->randomFloat(/** decimal_attributes **/);
        $last_unit_cost = $this->faker->randomFloat(/** decimal_attributes **/);
        $average_unit_cost_oc = $this->faker->randomFloat(/** decimal_attributes **/);
        $last_unit_cost_oc = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('invoice-line.store'), [
            'invoice_id' => $invoice->id,
            'line_number' => $line_number,
            'origin_document_type' => $origin_document_type,
            'origin_line_number' => $origin_line_number,
            'article_id' => $article->id,
            'warehouse_id' => $warehouse->id,
            'sub_total' => $sub_total,
            'qty' => $qty,
            'qty_secondary_unit' => $qty_secondary_unit,
            'pending' => $pending,
            'sale_unit' => $sale_unit,
            'sale_price' => $sale_price,
            'discounts' => $discounts,
            'tax_type' => $tax_type,
            'net_line' => $net_line,
            'average_unit_cost' => $average_unit_cost,
            'last_unit_cost' => $last_unit_cost,
            'average_unit_cost_oc' => $average_unit_cost_oc,
            'last_unit_cost_oc' => $last_unit_cost_oc,
            'must_be_sync' => $must_be_sync,
        ]);

        $invoiceLines = InvoiceLine::query()
            ->where('invoice_id', $invoice->id)
            ->where('line_number', $line_number)
            ->where('origin_document_type', $origin_document_type)
            ->where('origin_line_number', $origin_line_number)
            ->where('article_id', $article->id)
            ->where('warehouse_id', $warehouse->id)
            ->where('sub_total', $sub_total)
            ->where('qty', $qty)
            ->where('qty_secondary_unit', $qty_secondary_unit)
            ->where('pending', $pending)
            ->where('sale_unit', $sale_unit)
            ->where('sale_price', $sale_price)
            ->where('discounts', $discounts)
            ->where('tax_type', $tax_type)
            ->where('net_line', $net_line)
            ->where('average_unit_cost', $average_unit_cost)
            ->where('last_unit_cost', $last_unit_cost)
            ->where('average_unit_cost_oc', $average_unit_cost_oc)
            ->where('last_unit_cost_oc', $last_unit_cost_oc)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $invoiceLines);
        $invoiceLine = $invoiceLines->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $invoiceLine = InvoiceLine::factory()->create();

        $response = $this->get(route('invoice-line.show', $invoiceLine));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InvoiceLineController::class,
            'update',
            \App\Http\Requests\Api\InvoiceLineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $invoiceLine = InvoiceLine::factory()->create();
        $invoice = Invoice::factory()->create();
        $line_number = $this->faker->numberBetween(-10000, 10000);
        $origin_document_type = $this->faker->randomLetter;
        $origin_line_number = $this->faker->numberBetween(-10000, 10000);
        $article = Article::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $sub_total = $this->faker->randomFloat(/** decimal_attributes **/);
        $qty = $this->faker->randomFloat(/** decimal_attributes **/);
        $qty_secondary_unit = $this->faker->randomFloat(/** decimal_attributes **/);
        $pending = $this->faker->randomFloat(/** decimal_attributes **/);
        $sale_unit = $this->faker->word;
        $sale_price = $this->faker->randomFloat(/** decimal_attributes **/);
        $discounts = $this->faker->word;
        $tax_type = $this->faker->randomLetter;
        $net_line = $this->faker->randomFloat(/** decimal_attributes **/);
        $average_unit_cost = $this->faker->randomFloat(/** decimal_attributes **/);
        $last_unit_cost = $this->faker->randomFloat(/** decimal_attributes **/);
        $average_unit_cost_oc = $this->faker->randomFloat(/** decimal_attributes **/);
        $last_unit_cost_oc = $this->faker->randomFloat(/** decimal_attributes **/);
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('invoice-line.update', $invoiceLine), [
            'invoice_id' => $invoice->id,
            'line_number' => $line_number,
            'origin_document_type' => $origin_document_type,
            'origin_line_number' => $origin_line_number,
            'article_id' => $article->id,
            'warehouse_id' => $warehouse->id,
            'sub_total' => $sub_total,
            'qty' => $qty,
            'qty_secondary_unit' => $qty_secondary_unit,
            'pending' => $pending,
            'sale_unit' => $sale_unit,
            'sale_price' => $sale_price,
            'discounts' => $discounts,
            'tax_type' => $tax_type,
            'net_line' => $net_line,
            'average_unit_cost' => $average_unit_cost,
            'last_unit_cost' => $last_unit_cost,
            'average_unit_cost_oc' => $average_unit_cost_oc,
            'last_unit_cost_oc' => $last_unit_cost_oc,
            'must_be_sync' => $must_be_sync,
        ]);

        $invoiceLine->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($invoice->id, $invoiceLine->invoice_id);
        $this->assertEquals($line_number, $invoiceLine->line_number);
        $this->assertEquals($origin_document_type, $invoiceLine->origin_document_type);
        $this->assertEquals($origin_line_number, $invoiceLine->origin_line_number);
        $this->assertEquals($article->id, $invoiceLine->article_id);
        $this->assertEquals($warehouse->id, $invoiceLine->warehouse_id);
        $this->assertEquals($sub_total, $invoiceLine->sub_total);
        $this->assertEquals($qty, $invoiceLine->qty);
        $this->assertEquals($qty_secondary_unit, $invoiceLine->qty_secondary_unit);
        $this->assertEquals($pending, $invoiceLine->pending);
        $this->assertEquals($sale_unit, $invoiceLine->sale_unit);
        $this->assertEquals($sale_price, $invoiceLine->sale_price);
        $this->assertEquals($discounts, $invoiceLine->discounts);
        $this->assertEquals($tax_type, $invoiceLine->tax_type);
        $this->assertEquals($net_line, $invoiceLine->net_line);
        $this->assertEquals($average_unit_cost, $invoiceLine->average_unit_cost);
        $this->assertEquals($last_unit_cost, $invoiceLine->last_unit_cost);
        $this->assertEquals($average_unit_cost_oc, $invoiceLine->average_unit_cost_oc);
        $this->assertEquals($last_unit_cost_oc, $invoiceLine->last_unit_cost_oc);
        $this->assertEquals($must_be_sync, $invoiceLine->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $invoiceLine = InvoiceLine::factory()->create();

        $response = $this->delete(route('invoice-line.destroy', $invoiceLine));

        $response->assertNoContent();

        $this->assertModelMissing($invoiceLine);
    }
}

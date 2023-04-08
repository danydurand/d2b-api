<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('fiscal_number', 18);
            $table->string('fiscal_number2', 18);
            $table->foreignId('customer_id')->constrained()->on('customers');
            $table->foreignId('seller_id')->constrained()->on('sellers');
            $table->foreignId('transport_id')->constrained()->on('transports');
            $table->foreignId('currency_id')->constrained()->on('currencies');
            $table->foreignId('branch_id')->constrained()->on('branches');
            $table->foreignId('condition_payment_id')->constrained()->on('condition_payments');
            $table->integer('control_number');
            $table->char('status', 1);
            $table->decimal('exchange_rate', 18, 5);
            $table->decimal('balance', 18, 5);
            $table->dateTime('bill_date');
            $table->dateTime('due_date');
            $table->decimal('gross_amount', 18, 5);
            $table->decimal('net_amount', 18, 5);
            $table->string('description', 60)->nullable();
            $table->text('comments')->nullable();
            $table->text('delivery_address')->nullable();
            $table->string('global_discount_percentage', 15)->nullable();
            $table->decimal('global_discount_amount', 18, 5)->nullable();
            $table->string('surcharge_percentage', 15)->nullable();
            $table->decimal('surcharge_amount', 18, 5)->nullable();
            $table->decimal('freight_amount', 18, 5)->nullable();
            $table->decimal('pay_back_amount', 18, 5)->nullable();
            $table->decimal('tax_amount', 18, 5)->nullable();
            $table->decimal('pay_back_tax_amount', 18, 5)->nullable();
            $table->decimal('liqour_tax_amount', 18, 5)->nullable();
            $table->boolean('nullified')->default(false)->nullable();
            $table->boolean('printed')->default(false)->nullable();
            $table->string('field1', 60)->nullable();
            $table->string('field2', 60)->nullable();
            $table->string('field3', 60)->nullable();
            $table->string('field4', 60)->nullable();
            $table->string('field5', 60)->nullable();
            $table->string('field6', 60)->nullable();
            $table->string('field7', 60)->nullable();
            $table->string('field8', 60)->nullable();
            $table->decimal('other1', 18, 5)->nullable();
            $table->decimal('other2', 18, 5)->nullable();
            $table->decimal('other3', 18, 5)->nullable();
            $table->decimal('aux01', 18, 5)->nullable();
            $table->string('aux02', 30)->nullable();
            $table->string('generic_customer_phone', 30)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('customer_id');
            $table->index('seller_id');
            $table->index('transport_id');
            $table->index('currency_id');
            $table->index('branch_id');
            $table->index('condition_payment_id');
            $table->index('must_be_sync');
            $table->index('created_by');
            $table->index('updated_by');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

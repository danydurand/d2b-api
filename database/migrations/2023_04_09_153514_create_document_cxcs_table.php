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

        Schema::create('document_cxcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type_id')->constrained()->on('document_types');
            $table->integer('document_number');
            $table->boolean('nullified')->default(false);
            $table->integer('control_number');
            $table->foreignId('customer_id')->constrained()->on('customers');
            $table->foreignId('seller_id')->constrained()->on('sellers');
            $table->foreignId('branch_id')->constrained()->on('branches');
            $table->boolean('is_tax_payer')->default(false);
            $table->dateTime('document_date');
            $table->dateTime('due_date');
            $table->char('tax_type', 1);
            $table->decimal('exchange_rate', 18, 5);
            $table->foreignId('currency_id')->constrained()->on('currencies');
            $table->decimal('tax_amount', 18, 5);
            $table->decimal('gross_amount', 18, 5);
            $table->string('discounts', 15)->nullable();
            $table->decimal('discount_amount', 18, 5);
            $table->string('surcharge', 15)->nullable();
            $table->decimal('surcharge_amount', 18, 5)->nullable();
            $table->decimal('other_amount', 18, 5)->nullable();
            $table->decimal('net_amount', 18, 5)->nullable();
            $table->decimal('balance', 18, 5);
            $table->decimal('liqour_tax_amount', 18, 5)->nullable();
            $table->text('comments')->nullable();
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
            $table->dateTime('record_date');

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('document_type_id');
            $table->index('customer_id');
            $table->index('seller_id');
            $table->index('branch_id');
            $table->index('currency_id');
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
        Schema::dropIfExists('document_cxcs');
    }
};

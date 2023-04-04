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

        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('number', 6)->unique();
            $table->foreignId('customer_id')->constrained()->on('customers');
            $table->foreignId('seller_id')->constrained()->on('sellers');
            $table->foreignId('transport_id')->constrained()->on('transports');
            $table->char('status', 1);
            $table->string('description', 60);
            $table->dateTime('order_date');
            $table->foreignId('payment_condition_id')->constrained()->on('payment_conditions');
            $table->foreignId('currency_id')->constrained()->on('currencies');
            $table->dateTime('due_date')->nullable();
            $table->string('comments', 250)->nullable();
            $table->decimal('rate', 18, 5)->nullable();
            $table->decimal('balance', 18, 5)->nullable();
            $table->decimal('gross_amount', 18, 5)->nullable();
            $table->decimal('net_amount', 18, 5)->nullable();
            $table->decimal('global_discount', 18, 5)->nullable();
            $table->decimal('total_surcharge', 18, 5)->nullable();
            $table->decimal('total_freight', 18, 5)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('customer_id');
            $table->index('seller_id');
            $table->index('transport_id');
            $table->index('payment_condition_id');
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
        Schema::dropIfExists('orders');
    }
};

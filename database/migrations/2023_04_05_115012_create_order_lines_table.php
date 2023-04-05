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

        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->on('orders');
            $table->integer('line_number');
            $table->foreignId('warehouse_id')->constrained()->on('warehouses');
            $table->foreignId('article_id')->constrained()->on('articles');
            $table->decimal('qty', 18, 5);
            $table->decimal('sale_price', 18, 5);
            $table->decimal('sale_price2', 18, 5);
            $table->decimal('net_amount', 18, 5);

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('order_id');
            $table->index('warehouse_id');
            $table->index('article_id');
            $table->index('must_be_sync');
            $table->index('created_by');
            $table->index('updated_by');
            $table->unique(['order_id', 'line_number']);

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
        Schema::dropIfExists('order_lines');
    }
};

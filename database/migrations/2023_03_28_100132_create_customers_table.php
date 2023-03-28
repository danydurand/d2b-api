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

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code',6)->unique();
            $table->string('fiscal_number',30);
            $table->string('business_name',100);
            $table->foreignId('customer_type_id')->constrained()->on('customer_types');
            $table->foreignId('seller_id')->nullable()->constrained()->on('sellers');
            $table->string('fiscal_address',250)->nullable();
            $table->string('dispatch_address',250)->nullable();
            $table->string('phones',60)->nullable();
            $table->string('contact_name',60)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('customer_type_id');
            $table->index('seller_id');
            $table->index('must_be_sync');

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
        Schema::dropIfExists('customers');
    }
};

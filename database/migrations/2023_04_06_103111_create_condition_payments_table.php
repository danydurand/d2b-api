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

        Schema::create('condition_payments', function (Blueprint $table) {
            $table->id();

            $table->string('description', 100)->require()->unique();
            $table->foreignId('branch_id')->constrained()->on('branches');
            $table->integer('credit_days');
            $table->string('field1', 60)->nullable();
            $table->string('field2', 60)->nullable();
            $table->string('field3', 60)->nullable();
            $table->string('field4', 60)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('branch_id');
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
        Schema::dropIfExists('condition_payments');
    }
};

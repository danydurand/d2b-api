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

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->require()->unique();
            $table->string('description', 100)->require()->unique();
            $table->foreignId('brand_id')->constrained()->on('brands');
            $table->foreignId('sub_brand_id')->constrained()->on('sub_brands');
            $table->foreignId('category_id')->constrained()->on('categories');
            $table->foreignId('line_id')->constrained()->on('lines');
            $table->foreignId('sub_line_id')->constrained()->on('sub_lines');
            $table->foreignId('colour_id')->constrained()->on('colours');
            $table->foreignId('sale_unit_id')->constrained()->on('sale_units');
            $table->foreignId('ssale_unit_id')->constrained()->on('sale_units');
            $table->foreignId('origin_id')->nullable()->constrained()->on('origins');
            $table->foreignId('article_type_id')->nullable()->constrained()->on('article_types');
            $table->foreignId('provider_id')->nullable()->constrained()->on('providers');
            $table->string('reference',20)->nullable();
            $table->string('model',20)->nullable();
            $table->foreignId('business_id')->nullable()->constrained();
            $table->text('comments')->nullable();
            $table->boolean('compose')->nullable();
            $table->string('picture',100)->nullable();
            $table->string('field1',60)->nullable();
            $table->string('field2',60)->nullable();
            $table->string('field3',60)->nullable();
            $table->string('field4',60)->nullable();
            $table->string('field5',60)->nullable();
            $table->decimal('x_11',18,5)->nullable();
            $table->decimal('x_12',18,5)->nullable();
            $table->decimal('weight',18,5)->nullable();
            $table->decimal('feet',18,5)->nullable();
            $table->decimal('sale_price1', 18, 5)->nullable();
            $table->decimal('sale_price2', 18, 5)->nullable();
            $table->decimal('sale_price3', 18, 5)->nullable();
            $table->decimal('sale_price4', 18, 5)->nullable();
            $table->decimal('sale_price5', 18, 5)->nullable();
            $table->dateTime('last_date_price1')->nullable();
            $table->dateTime('last_date_price2')->nullable();
            $table->dateTime('last_date_price3')->nullable();
            $table->dateTime('last_date_price4')->nullable();
            $table->dateTime('last_date_price5')->nullable();
            $table->decimal('real_stock', 18, 5)->nullable();
            $table->decimal('commited_stock', 18, 5)->nullable();
            $table->decimal('comming_stock', 18, 5)->nullable();
            $table->decimal('dispatch_stock', 18, 5)->nullable();
            $table->decimal('sreal_stock', 18, 5)->nullable();
            $table->decimal('scommited_stock', 18, 5)->nullable();
            $table->decimal('scomming_stock', 18, 5)->nullable();
            $table->decimal('sdispatch_stock', 18, 5)->nullable();
            $table->decimal('margin1', 18, 5)->nullable();
            $table->decimal('margin2', 18, 5)->nullable();
            $table->decimal('margin3', 18, 5)->nullable();
            $table->decimal('margin4', 18, 5)->nullable();
            $table->decimal('margin5', 18, 5)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained()->on('users');
            $table->foreignId('updated_by')->nullable()->constrained()->on('users');
            $table->timestamps();

            $table->index('business_id');
            $table->index('brand_id');
            $table->index('sub_brand_id');
            $table->index('category_id');
            $table->index('line_id');
            $table->index('sub_line_id');
            $table->index('colour_id');
            $table->index('origin_id');
            $table->index('article_type_id');
            $table->index('provider_id');
            $table->index('sale_unit_id');
            $table->index('ssale_unit_id');

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
        Schema::dropIfExists('articles');
    }
};

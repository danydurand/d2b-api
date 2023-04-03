<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Article;
use App\Models\ArticleType;
use App\Models\Brand;
use App\Models\Business;
use App\Models\Category;
use App\Models\Colour;
use App\Models\Line;
use App\Models\Origin;
use App\Models\Provider;
use App\Models\SaleUnit;
use App\Models\SsaleUnit;
use App\Models\SubBrand;
use App\Models\SubLine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ArticleController
 */
class ArticleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $articles = Article::factory()->count(3)->create();

        $response = $this->get(route('article.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ArticleController::class,
            'store',
            \App\Http\Requests\Api\ArticleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $code = $this->faker->word;
        $description = $this->faker->text;
        $business = Business::factory()->create();
        $brand = Brand::factory()->create();
        $sub_brand = SubBrand::factory()->create();
        $category = Category::factory()->create();
        $line = Line::factory()->create();
        $sub_line = SubLine::factory()->create();
        $colour = Colour::factory()->create();
        $origin = Origin::factory()->create();
        $article_type = ArticleType::factory()->create();
        $provider = Provider::factory()->create();
        $sale_unit = SaleUnit::factory()->create();
        $ssale_unit = SsaleUnit::factory()->create();
        $reference = $this->faker->word;
        $model = $this->faker->word;
        $must_be_sync = $this->faker->boolean;

        $response = $this->post(route('article.store'), [
            'code' => $code,
            'description' => $description,
            'business_id' => $business->id,
            'brand_id' => $brand->id,
            'sub_brand_id' => $sub_brand->id,
            'category_id' => $category->id,
            'line_id' => $line->id,
            'sub_line_id' => $sub_line->id,
            'colour_id' => $colour->id,
            'origin_id' => $origin->id,
            'article_type_id' => $article_type->id,
            'provider_id' => $provider->id,
            'sale_unit_id' => $sale_unit->id,
            'ssale_unit_id' => $ssale_unit->id,
            'reference' => $reference,
            'model' => $model,
            'must_be_sync' => $must_be_sync,
        ]);

        $articles = Article::query()
            ->where('code', $code)
            ->where('description', $description)
            ->where('business_id', $business->id)
            ->where('brand_id', $brand->id)
            ->where('sub_brand_id', $sub_brand->id)
            ->where('category_id', $category->id)
            ->where('line_id', $line->id)
            ->where('sub_line_id', $sub_line->id)
            ->where('colour_id', $colour->id)
            ->where('origin_id', $origin->id)
            ->where('article_type_id', $article_type->id)
            ->where('provider_id', $provider->id)
            ->where('sale_unit_id', $sale_unit->id)
            ->where('ssale_unit_id', $ssale_unit->id)
            ->where('reference', $reference)
            ->where('model', $model)
            ->where('must_be_sync', $must_be_sync)
            ->get();
        $this->assertCount(1, $articles);
        $article = $articles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $article = Article::factory()->create();

        $response = $this->get(route('article.show', $article));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ArticleController::class,
            'update',
            \App\Http\Requests\Api\ArticleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $article = Article::factory()->create();
        $code = $this->faker->word;
        $description = $this->faker->text;
        $business = Business::factory()->create();
        $brand = Brand::factory()->create();
        $sub_brand = SubBrand::factory()->create();
        $category = Category::factory()->create();
        $line = Line::factory()->create();
        $sub_line = SubLine::factory()->create();
        $colour = Colour::factory()->create();
        $origin = Origin::factory()->create();
        $article_type = ArticleType::factory()->create();
        $provider = Provider::factory()->create();
        $sale_unit = SaleUnit::factory()->create();
        $ssale_unit = SsaleUnit::factory()->create();
        $reference = $this->faker->word;
        $model = $this->faker->word;
        $must_be_sync = $this->faker->boolean;

        $response = $this->put(route('article.update', $article), [
            'code' => $code,
            'description' => $description,
            'business_id' => $business->id,
            'brand_id' => $brand->id,
            'sub_brand_id' => $sub_brand->id,
            'category_id' => $category->id,
            'line_id' => $line->id,
            'sub_line_id' => $sub_line->id,
            'colour_id' => $colour->id,
            'origin_id' => $origin->id,
            'article_type_id' => $article_type->id,
            'provider_id' => $provider->id,
            'sale_unit_id' => $sale_unit->id,
            'ssale_unit_id' => $ssale_unit->id,
            'reference' => $reference,
            'model' => $model,
            'must_be_sync' => $must_be_sync,
        ]);

        $article->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $article->code);
        $this->assertEquals($description, $article->description);
        $this->assertEquals($business->id, $article->business_id);
        $this->assertEquals($brand->id, $article->brand_id);
        $this->assertEquals($sub_brand->id, $article->sub_brand_id);
        $this->assertEquals($category->id, $article->category_id);
        $this->assertEquals($line->id, $article->line_id);
        $this->assertEquals($sub_line->id, $article->sub_line_id);
        $this->assertEquals($colour->id, $article->colour_id);
        $this->assertEquals($origin->id, $article->origin_id);
        $this->assertEquals($article_type->id, $article->article_type_id);
        $this->assertEquals($provider->id, $article->provider_id);
        $this->assertEquals($sale_unit->id, $article->sale_unit_id);
        $this->assertEquals($ssale_unit->id, $article->ssale_unit_id);
        $this->assertEquals($reference, $article->reference);
        $this->assertEquals($model, $article->model);
        $this->assertEquals($must_be_sync, $article->must_be_sync);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $article = Article::factory()->create();

        $response = $this->delete(route('article.destroy', $article));

        $response->assertNoContent();

        $this->assertModelMissing($article);
    }
}

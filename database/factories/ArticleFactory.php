<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
use App\Models\SubBrand;
use App\Models\SubLine;
use App\Models\User;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user_id         = User::inRandomOrder()->first()->id;
        $business_id     = Business::inRandomOrder()->first()->id;
        $brand_id        = Brand::inRandomOrder()->first()->id;
        $sub_brand_id    = SubBrand::inRandomOrder()->first()->id;
        $category_id     = Category::inRandomOrder()->first()->id;
        $line_id         = Line::inRandomOrder()->first()->id;
        $sub_line_id     = SubLine::inRandomOrder()->first()->id;
        $colour_id       = Colour::inRandomOrder()->first()->id;
        $origin_id       = Origin::inRandomOrder()->first()->id;
        $article_type_id = ArticleType::inRandomOrder()->first()->id;
        $provider_id     = Provider::inRandomOrder()->first()->id;
        $sale_unit_id    = SaleUnit::inRandomOrder()->first()->id;
        $ssale_unit_id   = SaleUnit::inRandomOrder()->first()->id;
        $must_be_sync    = $this->faker->boolean;

        return [
            'code'             => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'description'      => Str::upper(Str::substr($this->faker->text,0,30)),
            'business_id'      => $business_id,
            'brand_id'         => $brand_id,
            'sub_brand_id'     => $sub_brand_id,
            'category_id'      => $category_id,
            'line_id'          => $line_id,
            'sub_line_id'      => $sub_line_id,
            'colour_id'        => $colour_id,
            'origin_id'        => $origin_id,
            'article_type_id'  => $article_type_id,
            'provider_id'      => $provider_id,
            'sale_unit_id'     => $sale_unit_id,
            'ssale_unit_id'    => $ssale_unit_id,
            'reference'        => $this->faker->regexify('[A-Z0-9]{20}'),
            'model'            => $this->faker->regexify('[A-Z0-9]{20}'),
            'comments'         => $this->faker->text,
            'compose'          => $this->faker->boolean,
            'picture'          => $this->faker->regexify('[A-Z0-9]{100}'),
            'field1'           => $this->faker->regexify('[A-Z0-9]{60}'),
            'field2'           => $this->faker->regexify('[A-Z0-9]{60}'),
            'field3'           => $this->faker->regexify('[A-Z0-9]{60}'),
            'field4'           => $this->faker->regexify('[A-Z0-9]{60}'),
            'field5'           => $this->faker->regexify('[A-Z0-9]{60}'),
            'x_11'             => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'x_12'             => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'weight'           => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'feet'             => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sale_price1'      => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sale_price2'      => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sale_price3'      => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sale_price4'      => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sale_price5'      => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'last_date_price1' => $this->faker->dateTime(),
            'last_date_price2' => $this->faker->dateTime(),
            'last_date_price3' => $this->faker->dateTime(),
            'last_date_price4' => $this->faker->dateTime(),
            'last_date_price5' => $this->faker->dateTime(),
            'real_stock'       => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'commited_stock'   => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'comming_stock'    => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'dispatch_stock'   => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sreal_stock'      => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'scommited_stock'  => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'scomming_stock'   => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'sdispatch_stock'  => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'margin1'          => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'margin2'          => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'margin3'          => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'margin4'          => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'margin5'          => $this->faker->randomFloat(5, 0, 9999999999999.99999),
            'must_be_sync'     => $must_be_sync,
            'sync_at'          => $must_be_sync ? null : $this->faker->dateTime(),
            'created_by'       => $user_id,
            'updated_by'       => $user_id,
        ];
    }
}

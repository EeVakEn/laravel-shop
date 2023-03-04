<?php
namespace Database\Factories\Webkul\Category\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webkul\Category\Models\CategoryTranslation;

class CategoryTranslationFactory extends Factory
{

    protected $model = CategoryTranslation::class;

    public function definition()
    {
        return [
            'locale'                       => 'en',
            'name'                        => $this->faker->word,
        ];
    }
}
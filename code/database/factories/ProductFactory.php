<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'name' => ucfirst($name),
            //'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(2),
            //'price' => $this->faker->randomFloat(2, 10, 500), // Price between 10.00 and 500.00
            //'sku' => strtoupper($this->faker->unique()->bothify('PROD-####-??')), // e.g., PROD-1234-AB
            //'stock' => $this->faker->numberBetween(0, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generates 50 fake products using the blueprint defined in your factory
        // Product::factory()->count(50)->create();

        $baseProducts = [
            ['name' => 'Wireless Mouse', 'desc' => 'Ergonomic wireless mouse with USB receiver.'],
            ['name' => 'Mechanical Keyboard', 'desc' => 'RGB backlit mechanical keyboard with blue switches.'],
            ['name' => 'HD Monitor', 'desc' => '24-inch Full HD IPS monitor with thin bezels.'],
            ['name' => 'USB-C Hub', 'desc' => 'Multiport adapter with HDMI, USB 3.0, and SD card reader.'],
            ['name' => 'Bluetooth Speaker', 'desc' => 'Portable waterproof speaker with deep bass.'],
            ['name' => 'Noise-Canceling Headphones', 'desc' => 'Over-ear wireless headphones with active noise cancellation.'],
            ['name' => 'External SSD', 'desc' => '1TB portable solid-state drive for fast data transfer.'],
            ['name' => 'Smartwatch', 'desc' => 'Fitness tracker with heart rate monitor and GPS.'],
            ['name' => 'Webcam', 'desc' => '1080p HD webcam with built-in microphone for streaming.'],
            ['name' => 'Desk Lamp', 'desc' => 'LED desk lamp with adjustable brightness and color temperature.'],
        ];

        $products = [];
        $totalProducts = 50;
        $baseCount = count($baseProducts);

        for ($i = 1; $i <= $totalProducts; $i++) {
            $baseIndex = ($i - 1) % $baseCount;
            $product = $baseProducts[$baseIndex];

            $products[] = [
                'name' => $product['name'].' - '.$i,
                'description' => $product['desc'].' - (Edition '.$i.')',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Product::insert($products);

    }
}

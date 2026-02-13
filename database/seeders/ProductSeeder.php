<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cpu     = Category::where('slug', 'processeurs')->first();
        $gpu     = Category::where('slug', 'cartes-graphiques')->first();
        $ram     = Category::where('slug', 'memoire-ram')->first();
        $storage = Category::where('slug', 'stockage')->first();

        if ($cpu) {
            Product::updateOrCreate(
                ['slug' => 'intel-core-i5-12400f'],
                [
                    'category_id' => $cpu->id,
                    'name'        => 'Intel Core i5‑12400F',
                    'description' => 'Processeur 6 cœurs / 12 threads pour socket LGA1700.',
                    'price'       => 189.99,
                    'stock'       => 15,
                    'image_path'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCFcT2Vde1tV8uXQflILQFQStJI4t6RIef2w&s',
                ]
            );

            Product::updateOrCreate(
                ['slug' => 'amd-ryzen-5-5600'],
                [
                    'category_id' => $cpu->id,
                    'name'        => 'AMD Ryzen 5 5600',
                    'description' => 'Processeur 6 cœurs pour plateforme AM4.',
                    'price'       => 169.90,
                    'stock'       => 12,
                    'image_path'  => null,
                ]
            );
        }

        if ($gpu) {
            Product::updateOrCreate(
                ['slug' => 'nvidia-rtx-4070'],
                [
                    'category_id' => $gpu->id,
                    'name'        => 'NVIDIA GeForce RTX 4070',
                    'description' => 'Carte graphique 12 Go GDDR6X pour jeu en 1440p.',
                    'price'       => 649.00,
                    'stock'       => 5,
                    'image_path'  => null,
                ]
            );
        }

        if ($ram) {
            Product::updateOrCreate(
                ['slug' => 'corsair-vengeance-16gb-ddr4'],
                [
                    'category_id' => $ram->id,
                    'name'        => 'Corsair Vengeance 16 Go (2x8 Go) DDR4',
                    'description' => 'Kit mémoire DDR4 3200 MHz.',
                    'price'       => 69.90,
                    'stock'       => 30,
                    'image_path'  => null,
                ]
            );
        }

        if ($storage) {
            Product::updateOrCreate(
                ['slug' => 'samsung-970-evo-1tb'],
                [
                    'category_id' => $storage->id,
                    'name'        => 'Samsung 970 EVO Plus 1 To',
                    'description' => 'SSD NVMe M.2 PCIe 3.0 x4.',
                    'price'       => 99.99,
                    'stock'       => 20,
                    'image_path'  => null,
                ]
            );
        }
    }
}
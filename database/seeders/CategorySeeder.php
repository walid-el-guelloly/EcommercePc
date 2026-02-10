<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Processeurs',
                'slug' => 'processeurs',
                'description' => 'CPU pour PC de bureau et portables',
            ],
            [
                'name' => 'Cartes graphiques',
                'slug' => 'cartes-graphiques',
                'description' => 'Cartes graphiques NVIDIA, AMD, etc.',
            ],
            [
                'name' => 'Mémoire RAM',
                'slug' => 'memoire-ram',
                'description' => 'Barrettes mémoire DDR4, DDR5',
            ],
            [
                'name' => 'Stockage',
                'slug' => 'stockage',
                'description' => 'SSD, HDD, NVMe',
            ],
            [
                'name' => 'Cartes mères',
                'slug' => 'cartes-meres',
                'description' => 'Cartes mères pour différentes plateformes',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
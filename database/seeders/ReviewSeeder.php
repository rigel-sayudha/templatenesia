<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = \App\Models\Product::all();
        $names = ['Rizky Ramadhan', 'Siti Aminah', 'Budi Santoso', 'Dewi Lestari', 'Ahmad Fauzi'];
        $comments = [
            'Template-nya sangat profesional dan mudah digunakan. Sangat direkomendasikan!',
            'Hemat waktu banget pakai ini. Desainnya modern dan bersih.',
            'Support-nya ramah, dibantu sampai bisa instalasi.',
            'Awalnya bingung, tapi ternyata panduannya sangat lengkap.',
            'Produk digital terbaik yang pernah saya beli di Templatenesia.'
        ];

        foreach ($products as $product) {
            // Tambahkan 2-3 ulasan per produk
            for ($i = 0; $i < rand(2, 4); $i++) {
                \App\Models\Review::create([
                    'product_id' => $product->id,
                    'customer_name' => $names[array_rand($names)],
                    'rating' => rand(4, 5),
                    'comment' => $comments[array_rand($comments)],
                    'is_visible' => true,
                ]);
            }
        }
    }
}

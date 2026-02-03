<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a few sample products if none exist
        if (Product::count() > 0) {
            return;
        }

        // Get or create category
        $category = Category::firstOrCreate(
            ['name' => 'Kursus Online'],
            ['slug' => 'kursus-online']
        );

        Product::create([
            'name' => 'Fundamental Pemrograman Python',
            'category_id' => $category->id,
            'description' => '🚀 Mulai karir tech Anda! Python adalah bahasa terpopuler untuk pemula. Master logic programming, automation, dan data science dari nol.',
            'price' => 299000,
            'discount_price' => 250000,
            'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&q=80&w=800&h=800',
            'is_active' => true,
            'is_popular' => true,
        ]);

        Product::create([
            'name' => 'Kursus Video Editing dengan Adobe Premiere',
            'category_id' => $category->id,
            'description' => '🎬 Ciptakan konten viral yang memukau! Teknik editing profesional + color grading yang bikin viewers terpesona. Cocok untuk content creator.',
            'price' => 320000,
            'discount_price' => 280000,
            'image' => 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?auto=format&fit=crop&q=80&w=800&h=800',
            'is_active' => true,
            'is_popular' => true,
        ]);

        Product::create([
            'name' => 'Masterclass: Google Ads & Facebook Ads',
            'category_id' => $category->id,
            'description' => '💰 Raih ROI maksimal dengan strategi iklan digital! Formula terbukti untuk scaling bisnis & meningkatkan conversion hingga 300%.',
            'price' => 450000,
            'discount_price' => null,
            'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800&h=800',
            'is_active' => true,
            'is_popular' => false,
        ]);

        Product::create([
            'name' => 'Kelas Online: UI/UX Design dengan Figma',
            'category_id' => $category->id,
            'description' => '✨ Design yang memikat & user-friendly! Dari wireframe hingga prototype interaktif. Portfolio-ready projects included.',
            'price' => 375000,
            'discount_price' => null,
            'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&q=80&w=800&h=800',
            'is_active' => true,
            'is_popular' => false,
        ]);

        Product::create([
            'name' => 'Video Tutorial: Copywriting untuk Pemula',
            'category_id' => $category->id,
            'description' => '✍️ Tulis yang menjual tanpa terasa seperti sales! Rahasia persuasi + emotional triggers yang membuat audience mau beli.',
            'price' => 250000,
            'discount_price' => null,
            'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800&h=800',
            'is_active' => true,
            'is_popular' => false,
        ]);

        Product::create([
            'name' => 'Video Kursus: Menjadi Full-Stack Web Developer',
            'category_id' => $category->id,
            'description' => '💻 Jadilah developer yang dicari industri! Frontend, Backend, Database, Deployment. Proyek nyata + job-ready portfolio.',
            'price' => 499000,
            'discount_price' => 399000,
            'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&q=80&w=800&h=800',
            'is_active' => true,
            'is_popular' => true,
        ]);
    }
}

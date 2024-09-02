<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCommentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Rastgele yorumlar oluşturmak için bir döngü
        for ($i = 0; $i < 10; $i++) { // 10 tane yorum ekle
            DB::table('product_comments')->insert([
                'product_id' => 1, // Belirli bir ürün için yorum ekleme
                'user_id' => 1, // 1 ile 10 arasında rastgele bir kullanıcı ID'si
                'comment' => Str::random(50), // 50 karakter uzunluğunda rastgele bir yorum
                'commentRate' => rand(1, 5), // 1 ile 5 arasında rastgele bir yorum puanı
                'created_at' => now(), // Şu anki tarih
                'updated_at' => now(), // Şu anki tarih
            ]);
        }
    }
}
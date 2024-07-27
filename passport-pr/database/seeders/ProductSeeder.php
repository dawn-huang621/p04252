<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 如果已經有的話就做更新
        Product::upsert([
                'id'=> 4,
                'title'=>'固定資料',
                'content'=>'固定內容',
                'price'=>rand(0,100),
                'quantity'=>rand(0,10)
            ], 
            ['id'],
            ['price', 'quantity']
        );

        $this->command->info('Product seeded!');
    }
}

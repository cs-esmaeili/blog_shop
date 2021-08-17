<?php

namespace Database\Seeders;

use App\Http\helpers\G;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 37; $i++) {
            Product::create([
                "file_id" => 1,
                "name" => "test " . $i,
                "price" => 1000,
                "sale_price" => 1000,
                "status" => "available",
                "stock" => 1,
                "order_number" => 1,
                "description" => "",
                "category_id" => 1,
            ]);
        }
    }
}

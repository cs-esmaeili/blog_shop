<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 2; $i++) {
            $id =  Category::create([
                'name' => $i,
                'file_id' => 1,
                'parent_id' => 0,
            ]);
            for ($b = 0; $b < 2; $b++) {
                $id1 = Category::create([
                    'name' => "sub " . $b,
                    'file_id' => 1,
                    'parent_id' => $id->category_id,
                ]);
                for ($c = 0; $c < 2; $c++) {
                    Category::create([
                        'name' => "2 sub " . $c,
                        'file_id' => 1,
                        'parent_id' => $id1->category_id,
                    ]);
                }
            }
        }
    }
}

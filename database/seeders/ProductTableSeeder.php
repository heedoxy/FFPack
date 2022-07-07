<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            "name" => "سید هادی",
            "barcode" => "2020",
            "prise" => "15000",
            "comment" => "test",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}

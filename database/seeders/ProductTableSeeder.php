<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
            "price" => "15000",
            "comment" => "test",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}

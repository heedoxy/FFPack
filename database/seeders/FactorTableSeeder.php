<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FactorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('factors')->insert([
            "code" => "FFP-005",
            "staff" => 1,
            "user" => 1,
            "price" => "15000",
            "comment" => "test",
            "status" => 0,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        DB::table('factor_detail')->insert([
            "user" => 1,
            "factor" => 0,
            "product" => "15000",
            "number" => 3,
            "price" => "15000",
            "comment" => "test",
            "status" => 0,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

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
            "prise" => "15000",
            "comment" => "test",
            "status" => 0,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        DB::table('factor_detail')->insert([
            "user" => 1,
            "factor" => 0,
            "product" => "15000",
            "number" => "test",
            "prise" => "15000",
            "comment" => "test",
            "status" => 0,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}

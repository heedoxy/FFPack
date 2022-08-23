<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            ["title" => "کیلوگرم"],
            ["title" => "گرم"],
            ["title" => "عدد"],
            ["title" => "سانتی متر"],
            ["title" => "سانتی متر مکعب"],
            ["title" => "پاکت"],
            ["title" => "کارتن"]
        ]);
    }
}

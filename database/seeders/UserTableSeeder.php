<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone = "09218248954";
        DB::table('users')->insert([
            "name" => "سید هادی",
            "family" => "رنجبر",
            "phone" => $phone,
            "password" => Hash::make($phone),
            "access" => 0,
            "created_at" => now(),
            "updated_at" => now(),
            "phone_verified_at" => now(),
        ]);
    }
}

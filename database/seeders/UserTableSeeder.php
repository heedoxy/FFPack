<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            "token" => Str::random(100),
            "created_at" => now(),
            "updated_at" => now(),
            "verified_at" => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('call_to_actions')->insert([
            [
                "name" => "Facebook",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Instagram",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Whatsapp",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "TikTok",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}

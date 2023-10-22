<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallToActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('call_to_actions')->insert([
            [
                "name" => "Whatsapp",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Appeler",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Écrire par mail",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Consulter sur un site internet",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}

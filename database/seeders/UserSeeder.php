<?php

namespace Database\Seeders;

use App\Core\Users\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "firstname" => "PayPub",
            "lastname" => "Admin",
            "email" => "paypubadmin@gmail.com",
            "password" => "paypub@admin2023",
            "is_admin" => true,
            "email_verified_at" => now(),
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}

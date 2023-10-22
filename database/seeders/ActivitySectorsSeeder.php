<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ActivitySectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activity_sectors')->insert([
            [
                "name" => "Agriculture",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Art et divertissement",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Automobile",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Banque et finance",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Construction",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Éducation",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Énergie",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Hôtellerie et restauration",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Immobilier",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Informatique et technologie",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Média et communication",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Santé et services sociaux",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Services professionnels",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Transport et logistique",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Vente au détail",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Industrie manufacturière",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Services gouvernementaux",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Services personnels",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Organisations à but non lucratif",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Autres services",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}

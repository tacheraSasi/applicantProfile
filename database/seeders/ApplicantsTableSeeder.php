<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use Illuminate\Support\Facades\DB;

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table first to prevent duplicate entries
        DB::table('applicants')->truncate();

        $applicants = [
            [
                'full_name' => 'John Mwita',
                'email' => 'john.mwita@example.com',
                'phone' => '+255714567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Amina Juma',
                'email' => 'amina.juma@example.com',
                'phone' => '+255768123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Josephat Mwakipesile',
                'email' => 'josephat.mwakipesile@example.com',
                'phone' => '+255623789456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Neema Waziri',
                'email' => 'neema.waziri@example.com',
                'phone' => '+255713987654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Hamisi Abdallah',
                'email' => 'hamisi.abdallah@example.com',
                'phone' => '+255752341678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert into the database
        Applicant::insert($applicants);
    }
}

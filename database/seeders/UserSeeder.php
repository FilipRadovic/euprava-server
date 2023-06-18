<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                "firstname" => "Filip",
                "lastname" => "Radovic",
                "jmbg" => "1234567890123",
                "email" => "fradovic@gmail.com",
                "username" => "fradovic",
                "password" => Hash::make('fradovic'),
                "role" => "ADMIN"
            ],
            [
                "firstname" => "Lola",
                "lastname" => "Medenica",
                "jmbg" => "1234567890125",
                "email" => "medenica@gmail.com",
                "username" => "medenica",
                "password" => Hash::make('medenica'),
                "role" => "ADMIN"
            ],
            [
                "firstname" => "Kosta",
                "lastname" => "Kostic",
                "jmbg" => "1234567890124",
                "email" => "kosta@gmail.com",
                "username" => "kosta",
                "password" => Hash::make('kosta'),
                "role" => "ADMIN"
            ]
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}

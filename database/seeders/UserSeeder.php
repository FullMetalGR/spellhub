<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $wizards = [
            [
                'name' => 'Gandalf the Grey',
                'email' => 'gandalf@middle-earth.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Bellatrix Lestrange',
                'email' => 'bellatrix@malfoy.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Yennefer of Vengerberg',
                'email' => 'yennefer@vengerberg.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Morgoth Bauglir',
                'email' => 'morgoth@angband.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Rincewind',
                'email' => 'rincewind@unseen.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Kvothe',
                'email' => 'kvothe@tarbean.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Salan',
                'email' => 'salan@tower.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Vin',
                'email' => 'vin@luthadel.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Karsus',
                'email' => 'karsus@netheril.com',
                'password' => bcrypt('1234567890'),
            ],
            [
                'name' => 'Merlin',
                'email' => 'merlin@avalon.com',
                'password' => bcrypt('1234567890'),
            ],
        ];

        foreach ($wizards as $wizard) {
            User::firstOrCreate(
                ['email' => $wizard['email']],
                $wizard
            );
        }
    }
}

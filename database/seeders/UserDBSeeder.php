<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class UserDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Faker::create();
            //  'name' => $faker->name,

        $user = new User([
            'name' => "Abdallah",
            'email' => 'abdallah@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->save();
    }
}

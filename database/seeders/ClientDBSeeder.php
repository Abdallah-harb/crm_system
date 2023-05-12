<?php

namespace Database\Seeders;
use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Client::class,8)->create();
        Client::factory()->count(8)->create();

    }

}

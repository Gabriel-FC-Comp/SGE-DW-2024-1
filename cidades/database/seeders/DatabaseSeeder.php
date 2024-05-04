<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PDO;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        $this->call([
            EstadoCidadeTableSeeder::class,
        ]);

        
    }
}
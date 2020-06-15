<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//$this->call(ProdukTableSeeder::class);
		//$this->call(ProdukTableSeederFactory::class);
		$this->call(KodeProduk::class);
    }
}

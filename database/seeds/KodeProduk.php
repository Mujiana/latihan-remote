<?php

use Illuminate\Database\Seeder;

class KodeProduk extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $produk = App\produk::limit(20)->get();
      foreach ($produk as $data){
         $update = App\Produk::find($data->id_produk);
         $update->kode_produk = rand(10000000, 99999999);
         $update->update();
      }
   }
}

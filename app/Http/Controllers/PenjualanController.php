<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use PDF;

class PenjualanController extends Controller
{
   public function cetakNota(){
      $produk = Produk::limit(5)->inRandomOrder()->get();
      
      $handle = printer_open(); 
      printer_start_doc($handle, "Nota");
      printer_start_page($handle);

      $font = printer_create_font("Consolas", 72, 48, 400, false, false, false, 0);
      printer_select_font($handle, $font);
      
      printer_draw_text($handle, "STRUK BELANJA", 400, 100);
      printer_draw_text($handle, "=========================", 100, 200);
      
      $y = 300;
      $total = 0;
      
      foreach($produk as $list){
         $jumlah = rand(1,10);
         $subtotal = $jumlah * $list->harga_jual;
         $total += $subtotal;
         
         printer_draw_text($handle, $list->kode_produk." ".$list->nama_produk, 100, $y);
       $y+=100;
         printer_draw_text($handle, $jumlah."x ".$list->harga_jual, 100, $y);
         printer_draw_text($handle, substr("                ".$subtotal, -10), 600, $y);
       $y+=100;
      }
      
      $y+=100;
      printer_draw_text($handle, "=========================", 100, $y);
      $y+=100;
      printer_draw_text($handle, "Total: ".$total, 100, $y);
        
      printer_delete_font($font);
      
      printer_end_page($handle);
      printer_end_doc($handle);
      printer_close($handle); 
   }
   
   public function notaPDF(){
     $produk = Produk::limit(5)->inRandomOrder()->get();
     $no = 0;
     $total = 0;
     
     $pdf = PDF::loadView('penjualan.notapdf', compact('produk', 'no', 'total'));
      $pdf->setPaper(array(0,0,609,340), 'potrait');
      
      return $pdf->stream();
   }
}

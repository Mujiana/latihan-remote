<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;
use App\Kategori;

use Redirect;
use Datatables;
use PDF;
use Excel;

class ProdukController extends Controller
{
   protected $pesan = array(
      'nama.required' => 'Isi Nama Produk',
      'kategori.required' => 'Pilih kategori',
      'harga.required' => 'Isi Harga Jual',
   );
   
   protected $aturan = array(
      'nama' => 'required',
      'kategori' => 'required',
      'harga' => 'required',
   );
   
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $batas = 5;
      $produk = Produk::join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
              ->orderBy('produk.id_produk', 'desc')
              ->paginate($batas);
              
      $no = $batas * ($produk->currentPage() - 1);
      
      return view('produk.index', compact('produk', 'no'));
   }
      
   public function listData()
   {
   
     $produk = Produk::join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
      ->orderBy('produk.id_produk', 'desc')
      ->get();
     $no = 0;
     $data = array();
     foreach($produk as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->nama_produk;
       $row[] = $list->nama_kategori;
       $row[] = $list->harga_jual;
       $row[] = "<a onclick='editForm(".$list->id_produk.")' class='btn btn-primary'>Edit</a>
               <a onclick='deleteData(".$list->id_produk.")' class='btn btn-danger'>Hapus</a>";
       $data[] = $row;
     }
     
     return Datatables::of($data)->escapeColumns([])->make(true);
   }
   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $kategori = Kategori::all();
      return view('produk.create', compact('kategori'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $this->validate($request, $this->aturan, $this->pesan);
      
      $produk = new Produk;
      $produk->nama_produk = $request['nama'];
      $produk->id_kategori = $request['kategori'];
      $produk->harga_jual = $request['harga'];
      $produk->save();
      
      return Redirect::route('produk.index');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $kategori = Kategori::all();
      $produk = Produk::find($id);
      return view('produk.edit', compact('kategori', 'produk'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      $this->validate($request, $this->aturan, $this->pesan);
      
      $produk = Produk::find($id);
      $produk->nama_produk = $request['nama'];
      $produk->id_kategori = $request['kategori'];
      $produk->harga_jual = $request['harga'];
      $produk->update();
      return Redirect::route('produk.index');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $produk = Produk::find($id);
      $produk->delete();
      return Redirect::route('produk.index');
   }
   
   public function printBarcode(){
      $produk = Produk::limit(12)->get();
      $no = 1;
      $pdf = PDF::loadView('produk.barcode', compact('produk', 'no'));
      $pdf->setPaper('a4', 'potrait');      
      return $pdf->stream();
   }
   
   public function makePDF(){
      $produk = Produk::join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
              ->orderBy('produk.id_produk', 'desc')->get();
              
      $no = 0;      
      $pdf = PDF::loadView('produk.pdf', compact('produk', 'no'));
      $pdf->setPaper('a4', 'potrait');
      
      return $pdf->stream();
   }
   
   public function importExport(){
      return view('produk.excel');
   }
   
   public function exportExcel(){
      $produk = Produk::select('id_produk', 'id_kategori', 'nama_produk', 'harga_jual')->get();
      return Excel::create('dataproduk', function($excel) use($produk){
         $excel->sheet('mysheet', function($sheet) use($produk){
            $sheet->fromArray($produk);
         });
      })->download('xls');
      
   }
   public function importExcel(Request $request){
      if($request->hasFile('file')){
         $path = $request->file('file')->getRealPath();
         $data = Excel::load($path, function($reader){})->get();
         if(!empty($data) && $data->count()){
            foreach($data as $key=>$val){
               $produk = new Produk;
               $produk->kode_produk = $val->kode_produk;
               $produk->nama_produk = $val->nama_produk;
               $produk->id_kategori = $val->id_kategori;
               $produk->harga_jual = $val->harga_jual;
               $produk->save();               
            }
            
         }
      }
      
      return back();
   }
}

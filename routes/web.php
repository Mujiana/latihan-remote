<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('welcome');
});

Route::get('foo', function () {
   echo 'Hello World';
});



//Resources Route
Route::resource('produk', 'ProdukController');

Route::get('adminn', function(){
	echo "Selamat datang admin!";
})->middleware('auth');



Route::group(['middleware' => 'auth'], function(){
	Route::resource('produk', 'ProdukController');
	Route::get('dataproduk', 'ProdukController@listData')->name('dataproduk');
	Route::get('pdfproduk', 'ProdukController@makePDF');
	Route::get('importexport', 'ProdukController@importExport');
	Route::post('importproduk', 'ProdukController@importExcel');
	Route::get('exportproduk', 'ProdukController@exportExcel');
	Route::get('barcode', 'ProdukController@printBarcode');
	
	Route::get('admin', function(){
		echo "Selamat datang admin!";
	})->middleware('cekLevel');
	
	Route::resource('kategori', 'KategoriController');	
	Route::get('datakategori', 'KategoriController@listData')->name('datakategori');
	
});

//Menggunakan Eloquent ORM dan Query Builder

//Menampilkan data
Route::get('produk/semua', function(){
	$produk = App\Produk::all();
	//$produk = DB::table('produk')->get();
	foreach($produk as $data){
		echo $data->id_produk.". ".
		    $data->nama_produk."-".
		    $data->harga_jual."<br>";
	}
});

Route::get('produk/jumlah', function(){
	//$produk = App\Produk::count();
	$produk = DB::table('produk')->count();
	echo $produk;
});

Route::get('produk/max', function(){
	//$produk = App\Produk::max('harga_jual');
	$produk = DB::table('produk')->max('harga_jual');
	echo $produk;
});

Route::get('produk/select', function(){
	$produk = App\Produk::select('nama_produk','harga_jual as harga')->get();
	//$produk = DB::table('produk')->select('nama_produk', 'harga_jual as harga')->get();
	foreach($produk as $data){
		echo $data->nama_produk."-".
		    $data->harga."<br>";
	}
});

Route::get('produk/raw', function(){
	//$produk = App\Produk::select(DB::raw('count(*) as total'))->get();
	$produk = DB::table('produk')->select(DB::raw('count(*) as total'))->get();
	echo $produk;
});

Route::get('produk/where', function(){
	$produk = App\Produk::where('harga_jual', '=', 54000)->get();
	//$produk = DB::table('produk')->where('id_produk', '=', 4)->get();
	foreach($produk as $data){
		echo $data->nama_produk."-".
		    $data->harga_jual."<br>";
	}
});

Route::get('produk/where2', function(){
	$produk = App\Produk::where([
		['harga_jual', '<=', 54000],
		['id_produk', '>=', 3]
	])->get();
	/*$produk = DB::table('produk')->where([
		['harga_jual', '<=', 54000],
		['id_produk', '>=', 3]
	])->get();*/
	foreach($produk as $data){
		echo $data->nama_produk."-".
		    $data->harga_jual."<br>";
	}
});

Route::get('produk/whereor', function(){
	$produk = App\Produk::where('harga_jual', '<=', 54000)
		->orWhere('id_produk', '>=', 3)
		->get();
	/*$produk = DB::table('produk')->where('harga_jual', '<=', 54000)
		->orWhere('id_produk', '>=', 3)
		->get();*/
	foreach($produk as $data){
		echo $data->nama_produk."-".
		    $data->harga_jual."<br>";
	}
});

Route::get('produk/between', function(){
	//$produk = App\Produk::whereBetween('id_produk',[2, 10])->get();
	$produk = DB::table('produk')->whereBetween('id_produk',[2, 10])->get();
	foreach($produk as $data){
		echo $data->nama_produk."-".
		    $data->harga_jual."<br>";
	}
});

Route::get('produk/notbetween', function(){
	//$produk = App\Produk::whereNotBetween('id_produk',[2, 10])->get();
	$produk = DB::table('produk')->whereNotBetween('id_produk',[2, 10])->get();
	foreach($produk as $data){
		echo $data->nama_produk."-".
		    $data->harga_jual."<br>";
	}
});

Route::get('produk/wherein', function(){
	//$produk = App\Produk::whereIn('id_produk',[2, 5, 10])->get();
	$produk = DB::table('produk')->whereIn('id_produk',[2, 5, 10])->get();
	foreach($produk as $data){
		echo $data->id_produk."-".
		    $data->nama_produk."<br>";
	}
});

Route::get('produk/wherenull', function(){
	//$produk = App\Produk::whereNull('harga_produk')->get();
	$produk = DB::table('produk')->whereNull('harga_produk')->get();
	foreach($produk as $data){
		echo $data->id_produk."-".
		    $data->nama_produk."<br>";
	}
});

Route::get('produk/wheredate', function(){
	$produk = App\Produk::whereDate('created_at', '2017-03-26')->get();
	//$produk = DB::table('produk')->whereDate('created_at', '2017-03-26')->get();
	foreach($produk as $data){
		echo $data->id_produk."-".
		    $data->nama_produk."<br>";
	}
});

Route::get('produk/wherecolumn', function(){
	$produk = App\Produk::whereColumn('created_at', '<', 'updated_at')->get();
	//$produk = DB::table('produk')->whereColumn('created_at', '<', 'updated_at')->get();
	foreach($produk as $data){
		echo $data->id_produk."-".
		    $data->nama_produk."<br>";
	}
});

Route::get('produk/add1', function(){
	$produk = new App\Produk;
	$produk->nama_produk = "Sikat Gigi";
	$produk->harga_jual = 500000;
	$produk->save();
});

Route::get('produk/add2', function(){
	DB::table('produk')->insert(
	   ['nama_produk'=>'Kaos Oblong', 'harga_jual'=>1000000]
	);
});

Route::get('produk/update1', function(){
	$produk = App\Produk::find(51);
	$produk->harga_jual = 160000;
	$produk->save();
});

Route::get('produk/update2', function(){
	DB::table('produk')->where('id_produk', 52)->update(
	   ['harga_jual'=>30000]
	);
});

Route::get('produk/delete1', function(){
	$produk = App\Produk::find(2);
	$produk->delete();
});

Route::get('produk/delete2', function(){
	DB::table('produk')->where('id_produk', 3)->delete();
});

//Menggunakan relationship
/*
Route::get('kategori', function(){
	$kategori = App\Kategori::where('id_kategori', '=', 2)->first();
	echo "Produk untuk kategori ".$kategori->nama_kategori.":";
	foreach($kategori->produk as $data){
		echo "<li>".$data->nama_produk."</li>";
	}
});
*/

//Menggunakan View
Route::get('selamat', function(){
	$produk = App\Produk::where('id_produk', '>', 50)->get();
	return view('selamat', ['nama'=>'Daffa\' Shidqi', 'produk'=>$produk]);
});

//Menggunakan layout blade
Route::get('halaman1', function(){
	$title  = 'Ini halaman pertama';
	$content = 'Anda sedang berada di halaman pertama website kami';
	return view('konten.halaman1', compact('title', 'content'));
});

//Latihan Route
Route::get('coba', function(){
	echo 'GET';
});

Route::post('coba', function(){
	echo 'POST';
});

Route::put('coba', function(){
	echo 'PUT';
});

Route::delete('coba', function(){
	echo 'DELETE';
});

Route::match(['get', 'post'], 'coba', function(){
	echo 'MATCH';
});

Route::any('coba', function(){
	echo 'ANY';
});


//Berbagai cara penulisan routes

//Route dengan parameter
Route::get('produk/{id}', function($id){ 
   echo $id;
});
Route::get('produk/{id?}', function($id=1){ 
   echo $id;
});

//Route dengan regular expression
Route::get('produk/{nama}', function($nama){ 
   echo $nama;
})->where('nama', '[A-Za-z]+');
Route::get('produk/{id}/{nama}', function($id, $nama){ 
   echo $id."-".$nama;
})->where(array('id'=>'[0-9]+', 'nama'=>'[A-Za-z]+'));

//Route dengan nama
Route::get('produk/tambah', function(){ 
   echo "produk berhasil ditambah";
})->name('tambah_produk');

//Route dengan aksi controller
Route::get('produk/tambah', 'ProdukController@tambah');



Route::get('tanggal', function(){
	echo tanggal_indonesia(date('Y-m-d'));
});

Route::get('uang', function(){
	echo "Rp. ". format_uang(12500000);
});

Route::get('terbilang', function(){
	echo ucwords(terbilang(12578600));
});

Route:: get('cetaknota', 'PenjualanController@cetakNota');
Route:: get('notapdf', 'PenjualanController@notaPDF');

Auth::routes();

Route::get('/home', 'HomeController@index');

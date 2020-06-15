<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
	protected $primaryKey = 'id_produk';
	protected $fillable = ['nama_produk', 'harga_jual'];
	
	public function kategori(){
		return $this->belongsTo('App\Kategori');
	}
}

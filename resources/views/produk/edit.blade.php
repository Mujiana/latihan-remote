@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h4>Edit Produk</a><br>
               </h4>
            </div>
            <div class="panel-body">
            
<form class="form-horizontal" role="form" method="POST" action="{{ route('produk.update', $produk->id_produk) }}">
  {{ csrf_field() }} {{ method_field('PATCH') }}
  
  @if($errors->any())
   <div class="alert alert-danger"><ul>
   @foreach($errors->all() as $error)
   <li>{{ $error }}</li>
   @endforeach
   </ul></div>
  @endif
  
   <div class="form-group">
      <label for="nama" class="col-md-3 control-label">Nama Produk</label>
      <div class="col-md-6">
         <input id="nama" type="text" class="form-control" name="nama" value="{{ $produk->nama_produk }}" autofocus>
      </div>
   </div>

   <div class="form-group">
      <label for="kategori" class="col-md-3 control-label">Kategori</label>
      <div class="col-md-6">
         <select id="kategori" class="form-control" name="kategori">
            <option value=""> -- Pilih Kategori-- </option>
            @foreach($kategori as $list)
            <option value="{{ $list->id_kategori }}" {{ $produk->id_kategori==$list->id_kategori ? 'selected' : ''}}>{{ $list->nama_kategori }}</option>
            @endforeach
         </select>
      </div>
   </div> 
   
   <div class="form-group">
      <label for="harga" class="col-md-3 control-label">Harga Jual</label>
      <div class="col-md-3">
         <input id="harga" type="number" class="form-control" name="harga" value="{{ $produk->harga_jual }}">
      </div>
   </div>
   
   <div class="form-group">
      <div class="col-md-3 col-md-offset-3">
         <button type="submit" class="btn btn-primary">Simpan</button>
         <a href="{{ url('produk') }}" class="btn btn-warning">Batal</a>
      </div>
   </div>
   
</form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h4>Daftar Produk 
               <a href="{{ route('produk.create') }}" class="btn btn-success pull-right" style="margin-top: -8px">Tambah</a><br>
               </h4>
            </div>
            <div class="panel-body">
               
<table class="table table-striped">
<thead>
   <tr>
      <th>No</th>
      <th>Nama Produk</th>
      <th>Kategori</th>
      <th>Harga Jual</th>
      <th>Aksi</th>
   </tr>
   <tbody></tbody>
</thead>
</table>
<!--
<tbody>
   @foreach($produk as $data)
   
   <tr>
      <td>{{ ++$no }}</td>
      <td>{{ $data->nama_produk }}</td>
      <td>{{ $data->nama_kategori }}</td>
      <td>{{ $data->harga_jual}}</td>
      <td>
      <form method="POST" action="{{ route('produk.destroy', $data->id_produk) }}">
      {{ csrf_field()}} {{ method_field('DELETE') }}
         <a href="{{ route('produk.edit', $data->id_produk) }}" class="btn btn-primary">Edit</a>
         <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </td>
   </tr>
   @endforeach
</tbody>
</table>
{{ $produk->links() }}
-->
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var table, save_method;
$(function(){
	table = $('.table').DataTable({
     "processing" : true,
	 "serverside" : true,
     "ajax" : "{!! route('dataproduk') !!}"
   }); 
});
</script>
@endsection
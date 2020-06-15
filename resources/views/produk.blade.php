<h2>Daftar Produk</h2>
<table border="1" cellspacing="0" width="100%">
<tr>
	<th>ID</th><th>Nama Produk</th><th>Harga</th>
</tr>

@foreach($produk as $data)
<tr> 
	<td>{{ $data->id_produk }}</td>
	<td>{{ $data->nama_produk }}</td>
	<td>{{ $data->harga_jual }}</td>
</tr>
@endforeach

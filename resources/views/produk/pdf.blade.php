<!DOCTYPE html>
<html>
<head>
   <title>Produk PDF</title>
   <link href="{{ asset('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
 
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 align="center">Daftar Produk </h3>
    </div>
    <div class="panel-body">
         
<table class="table table-striped">
<thead>
   <tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Kategori</th>
    <th>Harga Jual</th>
   </tr>

   <tbody>
    @foreach($produk as $data)
    
    <tr>
     <td>{{ ++$no }}</td>
     <td>{{ $data->nama_produk }}</td>
     <td>{{ $data->nama_kategori }}</td>
     <td>{{ $data->harga_jual}}</td>
    </tr>
    @endforeach
   </tbody>
</table>

    </div>
</div>

</body>
</html>
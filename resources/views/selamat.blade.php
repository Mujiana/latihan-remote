<!DOCTYPE html>
<html>
    <head>
        <title>Selamat Datang</title>
    </head>
    <body>
       <h1>Selamat datang {{ $nama }}!</h1>
	   <p>Berikut nama produk yang kamu beli:</p>
	   <ul>
	   @foreach($produk as $data)
	      <li> {{ $data->nama_produk }} </li>
	   @endforeach
	   </ul>
    </body>
</html>

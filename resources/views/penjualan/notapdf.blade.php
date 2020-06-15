<!DOCTYPE html>
<html>
<head>
   <title>Nota PDF</title>
   <style type="text/css">
      td, th{
         border: 1px solid #ccc;
         padding: 5px;
      }
      th{
         text-align: center;
      }
      table{ border-collapse: collapse }
   </style>
</head>
<body>
 
<h3 align="center">STRUK PENJUALAN </h3>
         
<table width="100%">
<thead>
   <tr>
    <th>No</th>
    <th>Kode Produk</th>
    <th>Nama Produk</th>
    <th>Jumlah</th>
    <th>Harga Satuan</th>
    <th>Subtotal</th>
   </tr>

   <tbody>
    @foreach($produk as $data)
      <?php 
         $jumlah = rand(1,10);
         $subtotal = $jumlah * $data->harga_jual;
         $total += $subtotal;
      ?>
      
    <tr>
       <td>{{ ++$no }}</td>
       <td>{{ $data->kode_produk }}</td>
       <td>{{ $data->nama_produk }}</td>
       <td>{{ $jumlah }}</td>
       <td align="right">{{ format_uang($data->harga_jual) }}</td>
       <td align="right">{{ format_uang($subtotal) }}</td>
    </tr>
    @endforeach
   
   </tbody>
   <tfoot>
    <tr><td colspan="5"><b>Total</b></td><td align="right"><b>{{ format_uang($total) }}</b></td></tr>
   </tfoot>
</table>

</body>
</html>
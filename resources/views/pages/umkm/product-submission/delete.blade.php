<center>
<table class='font-weight-bold'>

	<tr>
		<td > Nama Produk</td> 
		<td>:</td> 
		<td>{{ $data->name }}</td>
	</tr>
	<tr>
		<td > Harga</td> 
		<td>:</td> 
		<td>{{ number_format($data->umkm_price) }}</td>
	</tr>
</table>
</center>
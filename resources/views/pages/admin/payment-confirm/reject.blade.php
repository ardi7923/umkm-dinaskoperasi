<center>
<table class='font-weight-bold'>
	<tr>
		<td > Nama Pemesan</td> 
		<td>:</td> 
		<td>{{ $data->user->name }}</td>
	</tr>
	<tr>
		<td > Harga</td> 
		<td>:</td> 
		<td>{{ $data->lists->sum('total_price') }}</td>
	</tr>
	
</table>
</center>
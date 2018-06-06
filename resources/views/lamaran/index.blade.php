@extends('layouts.admin')
@section('content')

	<div class="row">
	<div class="container">
	<div class="col-md-16">
			<div class="panel panel-success">
			  <div class="panel-heading"><font color ="blue">Data lamaran </font>
			  	<div class="panel-title pull-right"><a href="{{ route('lamaran.create') }}">Tambah</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<div class="table-responsive">
				  <table class="table">
				  	<thead>
			  		<tr>
			  		  <th>No</th>
					  <th>File CV</th>
					  <th>Status</th>
					  <th>Username</th>
					  <th colspan="3">Action</th>
			  		</tr>
				  	</thead>
				  	<tbody>
				  		<?php $nomor = 1; ?>
				  		@php $no = 1; @endphp
				  		@foreach($lar as $data)
				  	  <tr>
				    	<td>{{ $no++ }}</td>
				    	<td>{{ $data->file_cv }}</td>
				    	<td>{{ $data->status }}</td>
				    	<td><p>{{ $data->nama_low }}</p></td>
				    	<td><p>{{ $data->User->email }}</p></td>
				    
           
<td>
	<a class="btn btn-warning" href="{{ route('lamaran.edit',$data->id) }}">Edit</a>
</td>
<td>
	<a href="{{ route('lamaran.show',$data->id) }}" class="btn btn-success">Show</a>
</td>
<td>
	<form method="post" action="{{ route('lamaran.destroy',$data->id) }}">
		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="DELETE">

		<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Delete</button>
	</form>
</td>
				      </tr>
				      @endforeach	
				  	</tbody>
				  </table>
				</div>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection
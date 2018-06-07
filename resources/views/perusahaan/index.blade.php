@extends('layouts.admin')
@section('content')

	<div class="row">
	<div class="container">
		<div class="col-md-16">
			<div class="panel panel-primary">
			  <div class="panel-heading"><font color ="blue"><h2>Data perusahaan </h2></font>
			  	<button class="au-btn au-btn-icon au-btn--green au-btn--small"><i class="zmdi zmdi-plus"><a href="{{ route('perusahaan.create') }}">Tambah</i></a></button>
			  	<div class="panel-title pull-right">
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<div class="table-responsive table-style5">
                    <table class="table table-data2">
				  	<thead>
			  		<tr>
			  		  <th>No</th>
					  <th>Logo</th>
					  <th>Deskripsi</th>
					  <th>Kategori</th>
					  <th>Subkategori</th>
					  <th>Judul</th>
					  <th>Gaji</th>
					  <th>Tanggal Mulai</th>
					  <th>Email</th>
					  <th>Telepon</th>
					  <th>Name</th>
					  <th colspan="3">Action</th>
			  		</tr>
				  	</thead>
				  	<tbody>
				  		<?php $nomor = 1; ?>
				  		@php $no = 1; @endphp
				  		@foreach($per as $data)
				  	  <tr>
				    	<td>{{ $no++ }}</td>
				    	<td><img src="{{ asset('assets/img/logopers/'.$data->logo) }}" style="max-height:150px;max-width:150px;margin-top:7px;" /></td>
				    	<td>{{ $data->deskripsi }}</td>
				    	<td>{{ $data->kategori }}</td>
				    	<td>{{ $data->subkategori }}</td>
				    	<td>{{ $data->judul }}</td>
				    	<td>Rp.{{ $data->gaji }}</td>
				    	<td>{{ $data->tgl_mulai }}</td>
				    	<td>{{ $data->email }}</td>
				    	<td>{{ $data->telepon }}</td>
				    	<td><p>{{ $data->User->name }}</p></td>
<td>
	<a class="btn btn-warning" href="{{ route('perusahaan.edit',$data->id) }}">Edit</a>
</td>
<td>
	<a href="{{ route('perusahaan.show',$data->id) }}" class="btn btn-success">Show</a>
</td>
<td>
	<form method="post" action="{{ route('perusahaan.destroy',$data->id) }}">
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
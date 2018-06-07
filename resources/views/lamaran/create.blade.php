@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Tambah Data Lamaran 
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<form action="{{ route('lamaran.store') }}" method="post" >
			  		{{ csrf_field() }}
			  		<div class="form-group {{ $errors->has('file_cv') ? ' has-error' : '' }}">
			  			<label class="control-label">File CV</label>	
			  			<input type="text" name="file_cv" class="form-control"  required>
			  			@if ($errors->has('file_cv'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file_cv') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
			  			<label class="control-label">Status</label>	
			  			<input type="text" name="status" class="form-control"  required>
			  			@if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('low_id') ? ' has-error' : '' }}">
			  			<label class="control-label">Lowongan</label>	
			  			<select name="low_id" class="form-control">
			  				@foreach($low as $data)
			  				<option value="{{ $data->id }}">{{ $data->nama_low }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('low_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('low_id') }}</strong>
                            </span>
                        @endif
			  		</div>
			  	
			  		<div class="form-group">
			  			<button type="submit" class="btn btn-primary">Tambah</button>
			  		</div>
			  	</form>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection
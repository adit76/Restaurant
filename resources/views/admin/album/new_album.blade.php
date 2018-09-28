@extends('admin.layout.layout')

@section('title','New Album | Restro')

@section('main')

<h2>Create New Album</h2>
<hr/>
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('new_album_create') }}">
	{{ csrf_field() }}
	
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name" class="col-md-4 control-label">Album Name</label>

		<div class="col-md-6">
			<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

			@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
		</div>
	</div>
	
	<div class="form-group">
	<label for="images" class="col-md-4 control-label">Photos To Upload (Mutltiple)</label>
	<div class="col-md-6">
		<input id="images" type="file" class="form-control" name="images[]" placeholder="Photos To Upload" multiple>
	</div>
	</div>
	<br/>
	<input class="btn btn-primary" type="submit">
</form>
 

@endsection
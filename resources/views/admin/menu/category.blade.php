@extends('admin.layout.layout')

@section('title','Menu Category | Restro')

@section('main')

<h2>Menu Category</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Description</th>
	   <th></th>
	 </tr>
   </thead>
	<tbody>
		  @if(count($category) == 0)
			<tr><td><h3 style="position: absolute; text-align:center; width: 100%; padding-top: 30px">No Category !!</h3></td></tr>
		  @endif
		  
		  @foreach($category as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->name}}</td>
			  <td>{{$data->description}}</td>                                       
			  <td><a href="{{ route('food',['id'=>$data->id]) }}"><button class="btn btn-primary">Info</button></a></td>                                       
			</tr>
		@endforeach
		</tbody>
 </table>   

<h2>Create New Category</h2>
<hr/>
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('category_create') }}">
	{{ csrf_field() }}
	
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name" class="col-md-4 control-label">Name</label>

		<div class="col-md-6">
			<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

			@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
		</div>
	</div>
	
	<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
		<label for="description" class="col-md-4 control-label">Description</label>

		<div class="col-md-6">
			<input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

			@if ($errors->has('description'))
				<span class="help-block">
					<strong>{{ $errors->first('description') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<br/>
	<input class="btn btn-primary" type="submit">
</form>
 

@endsection
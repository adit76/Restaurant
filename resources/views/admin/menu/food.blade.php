@extends('admin.layout.layout')

@section('title','Menu Items Food | Restro')

@section('main')

<h2>Menu Items : @if(count($food) == 0) @else {{ $food[0]->cname }} @endif</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Description</th>
	   <th>Price</th>
	   <th>Special</th>
	   <th>Remove</th>
	 </tr>
   </thead>
	<tbody>
		  @if(count($food) == 0)
			<tr><td><h3 style="position: absolute; text-align:center; width: 100%; padding-top: 30px">No Food For This Category !!</h3></td></tr>
		  @endif
		  
		  @foreach($food as $key => $data)
			<tr>    
			  <td>{{$data->iid}}</td>
			  <td>{{$data->iname}}</td>
			  <td>{{$data->idescription}}</td>                                       
			  <td>{{$data->price}}</td>                                       
			  <td>
				@if($data->special == 1)
					Yes
				@else
					No
				@endif
			  </td>     
			  <td><a href="{{ route('food_remove',['id'=>$data->iid]) }}" onclick="return confirm('Are You Sure?');"><button class="btn btn-danger">Delete</button></a></td>
			</tr>
			@endforeach
		</tbody>
 </table>   
<br/><br/>
<h2>Add New Food to this Category: </h2>
<hr/>
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('food_create',['id'=>$id]) }}">
	{{ csrf_field() }}
	
	<input type="hidden" value="{{ $id }}" name="category_id" required>
	
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
	
	<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
		<label for="price" class="col-md-4 control-label">Price</label>

		<div class="col-md-6">
			<input id="price" type="number" min="1" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

			@if ($errors->has('price'))
				<span class="help-block">
					<strong>{{ $errors->first('price') }}</strong>
				</span>
			@endif
		</div>
	</div>
	
	<div class="form-group{{ $errors->has('special') ? ' has-error' : '' }}">
		<label for="special" class="col-md-4 control-label">Is Special ?</label>

		<div class="col-md-6">
			<select id="special" name="special" style="padding: 5px;">
				<option value="0" selected>No</option>
				<option value="1">Yes</option>
			</select>
			@if ($errors->has('special'))
				<span class="help-block">
					<strong>{{ $errors->first('special') }}</strong>
				</span>
			@endif
		</div>
	</div>
	
	<br/>
	<input class="btn btn-primary" type="submit">
</form>
 

@endsection
@extends('admin.layout.layout')

@section('title','Album | Restro')

@section('main')
<h2>Album</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>Album ID</th>
	   <th>Name</th>
	   <th>Date</th>
	   <th></th>
	   <th></th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($album as $key => $data)
			<tr>    
			  <td><a href="{{ route('album_custom',['id'=>$data->id]) }}">{{$data->id}}</a></td>
			  <td>{{$data->name}}</td>
			  <td>{{$data->date}}</td>			  
			  <td><a href="{{ route('album_custom',['id'=>$data->id]) }}">Customize</a></td>			  
			  <td><a onclick="return confirm('Are You Sure');" href="{{ route('album_delete',['id'=>$data->id]) }}"><button class="btn btn-danger">Delete Album</button></a></td>			  
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
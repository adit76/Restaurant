@extends('admin.layout.layout')

@section('title','User Orders | Restro')

@section('main')
<h2>Users</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Contact</th>
	   <th>Address</th>
	   <th>City</th>
	   <th>Order Id</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_users as $key => $data)
			<tr>    
			  <td>{{$data->uid}}</td>
			  <td>{{$data->first_name}} {{$data->last_name}}</td>
			  <td>{{$data->contact}}</td>
			  <td>{{$data->address}}</td>                 
			  <td>{{$data->city}}</td>                 
			  <td>{{ $data->oid }}</td>                                
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
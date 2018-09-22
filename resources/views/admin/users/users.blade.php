@extends('admin.layout.layout')

@section('title','Users | Restro')

@section('main')
<h2>Users</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Contact</th>
	   <th>E-mail</th>
	   <th>Address</th>
	   <th>City</th>
	   <th>Street</th>
	   <th>Verified</th>
	   <th>Created At</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_users as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->first_name}} {{$data->last_name}}</td>
			  <td>{{$data->contact}}</td>
			  <td>{{$data->email}}</td>
			  <td>{{$data->address}}</td>                 
			  <td>{{$data->city}}</td>                 
			  <td>{{$data->street}}</td>                 
			  <td>{{ $data->verified }}</td>                                
			  <td>{{ $data->created_at }}</td>                                
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
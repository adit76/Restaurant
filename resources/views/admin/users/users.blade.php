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
			  <th>{{$data->id}}</th>
			  <th>{{$data->first_name}} {{$data->last_name}}</th>
			  <th>{{$data->contact}}</th>
			  <th>{{$data->email}}</th>
			  <th>{{$data->address}}</th>                 
			  <th>{{$data->city}}</th>                 
			  <th>{{$data->street}}</th>                 
			  <th>{{ $data->verified }}</th>                                
			  <th>{{ $data->created_at }}</th>                                
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
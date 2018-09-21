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
			  <th>{{$data->uid}}</th>
			  <th>{{$data->first_name}} {{$data->last_name}}</th>
			  <th>{{$data->contact}}</th>
			  <th>{{$data->address}}</th>                 
			  <th>{{$data->city}}</th>                 
			  <th>{{ $data->oid }}</th>                                
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
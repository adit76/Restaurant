@extends('admin.layout.layout')

@section('title','Delivery Boy | Restro')

@section('main')
<h2>Messages</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Address</th>
	   <th>Phone</th>
	   <th>E-mail</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_delivery_boy as $key => $data)
			<tr>    
			  <th>{{$data->id}}</th>
			  <th>{{$data->name}}</th>
			  <th>{{$data->address}}</th>
			  <th>{{$data->phone}}</th>                 
			  <th>{{$data->email}}</th>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
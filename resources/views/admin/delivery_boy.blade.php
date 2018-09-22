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
	   <th>All Delivery</th>
	 </tr>
   </thead>
	<tbody>
		  @if(count($all_delivery_boy) == 0)
			<tr><td><h3 style="position: absolute; text-align:center; width: 100%; padding-top: 30px">No Delivery Boys Yet !!</h3></td></tr>
		  @endif
		  
		  @foreach($all_delivery_boy as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->name}}</td>
			  <td>{{$data->address}}</td>
			  <td>{{$data->phone}}</td>                 
			  <td>{{$data->email}}</td>                                               
			  <td><a href="delivery_boy/{{$data->id}}">All Delivery</a></td>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
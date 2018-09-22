@extends('admin.layout.layout')

@section('title','Delivery Boy | Restro')

@section('main')
<h2>Delivery By: {{$all_delivery_boy_detail[0]->name}}</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>Order ID</th>
	   <th>User ID</th>
	   <th>Status</th>
	   <th>Name</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_delivery_boy_detail as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->user_id}}</td>
			  <td>
				@if ($data->status == "1")
					Ordered
				@elseif ($data->status == "2")
					Reviewed
				@elseif ($data->status == "3")
					On The Way
				@elseif ($data->status == "4")
					Delivered
				@else
				   Error
				@endif
			  </td>
			  <td>{{$data->name}}</td>                                                          
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
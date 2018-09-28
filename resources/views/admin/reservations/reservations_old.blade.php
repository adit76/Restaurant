@extends('admin.layout.layout')

@section('title','Reservations Old | Restro')

@section('main')
<h2>Reservations Old</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>User ID</th>
	   <th>Date</th>
	   <th>Time</th>
	   <th>Name</th>
	   <th>Seats</th>
	   <th>Seat ID</th>
	   <th>Status</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_reservations_old as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->user_id}}</td>
			  <td>{{$data->date}}</td>
			  <td>{{$data->time}}</td>
			  <td>{{$data->name}}</td>
			  <td>{{$data->seats}}</td>                 
			  <td>{{$data->seat_id}}</td>                 
			  <td>{{$data->status}}</td>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
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
			  <th>{{$data->id}}</th>
			  <th>{{$data->user_id}}</th>
			  <th>{{$data->date}}</th>
			  <th>{{$data->time}}</th>
			  <th>{{$data->name}}</th>
			  <th>{{$data->seats}}</th>                 
			  <th>{{$data->seat_id}}</th>                 
			  <th>{{$data->status}}</th>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection
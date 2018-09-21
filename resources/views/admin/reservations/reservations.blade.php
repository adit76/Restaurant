@extends('admin.layout.layout')

@section('title','Reservations | Restro')

@section('main')
<h2>Reservations</h2>
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
		  @foreach($all_reservations as $key => $data)
			<tr>    
			  <th>{{$data->id}}</th>
			  <th>{{$data->user_id}}</th>
			  <th>{{$data->date}}</th>
			  <th>{{$data->time}}</th>
			  <th>{{$data->name}}</th>
			  <th>{{$data->seats}}</th>                 
			  <th>{{$data->seat_id}}</th>                 
			  <th>
			  <select onchange="updateStatus({{$data->id}}, this)">
				<option id="{$data->id}}_status" value="" disabled selected style="display:none;">
					@if ($data->status == "1")
						Active
					@elseif ($data->status == "0")
						Expired
					@else
					   Error
					@endif
				</option>
				<option value="1">Active</option>
				<option value="0">Expired</option>
			  </th>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	function updateStatus(id,item){
		$.ajax({
			url: '{{ route("update_reservation_status") }}?id='+id+'&value='+item.value,
			type: "GET",
			dataType: "text",
			success: function (data) {
				if(data == "OK"){
					alert('Reservations Status Updated');
				}
				console.log('Reservations Status Updated');
			},
			error: function () {
				console.log('Could Not Update Reservations Status.');
			}
		});
	}
</script>
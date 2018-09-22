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
		  @if(count($all_reservations) == 0)
			<tr><td><h3 style="position: absolute; text-align:center; width: 100%; padding-top: 30px">No Reservations To Show !!</h3></td></tr>
		  @endif
		  
		  @foreach($all_reservations as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->user_id}}</td>
			  <td>{{$data->date}}</td>
			  <td>{{$data->time}}</td>
			  <td>{{$data->name}}</td>
			  <td>{{$data->seats}}</td>                 
			  <td>{{$data->seat_id}}</td>                 
			  <td>
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
			  </td>                                               
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
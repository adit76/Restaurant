@extends('layout.master')

@section('title','Choose Seat | Restro')

@section('main')


<div class="order_msg">

@if(Session::has('reservation_msg'))
  <div class="initial_hidden">
    <h1>Reservation Complete</h1>
    <p>Reserved For: {{ Session::get('reservation_name') }}</p>
    <hr/>
    <p>Contact <a href="tel:+977-98000000">+977-98000000</a> For More Details</p>
    <p>Contact Us For Any Special Demands</p>
    <p>Connect With Us:</p>
    <b>Facebook</b>
    -
    <b>Instagram</b>
  </div>

@else
  
	<style>
		table{
			display: none;
		}
	
		table tr td{
			width: 50px;
			height: 50px;
			background: salmon;
			color: white;
			text-align: center;
		}
		
		table tr td.floor{
			background: #ababab;
		}
		
		table tr td.five{
			transform: scaleX(1.3);
			background: maroon;
			transform-origin: left;
		}
		
		table tr td.six{
			transform: scaleX(1.4);
			background: teal;
			transform-origin: left;
			/* width: 100px; */
		}
		
		table tr td.more{
			transform: scaleX(1.5);
			background: brown;
			transform-origin: left;
			/* width: 120px; */
		}
	</style>

	<table>
		<tr>
			<td>4</td>
			<td>4</td>
			<td class="floor">F</td>
			<td class="floor">F</td>
			<td class="floor">F</td>
			<td>4</td>
			<td>4</td>
		</tr>
		
		<tr>
			<td>4</td>
			<td class="five">5</td>
			<td class="floor">F</td>
			<td class="floor">F</td>
			<td class="floor">F</td>
			<td>4</td>
			<td>4</td>
		</tr>
		
		<tr>
			<td>4</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
			<td class="six">6</td>
			<td class="more">7+</td>
		</tr>
		
		<tr>
			<td>4</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
			<td class="six">6</td>
			<td class="more">7+</td>
		</tr>
		
		<tr>
			<td class="floor">F</td>
			<td class="floor">F</td>
			<td class="more">7+</td>
			<td class="more">7+</td>
			<td class="more">7+</td>
			<td class="floor">F</td>
			<td class="floor">F</td>
		</tr>
	</table>

	<h1>Choose Seat</h1>
	
	<div class="flex">
		<div class="upper">
		  <div class="table" title="1" onclick="room(this)">4</div>
		  <div class="table" title="2" onclick="room(this)">4</div>
		  <div class="floor">F</div>
		  <div class="floor">F</div>
		  <div class="floor">F</div>
		  <div class="table" title="6" onclick="room(this)">4</div>
		  <div class="table" title="7" onclick="room(this)">4</div>
		  
		  <div class="table" title="8" onclick="room(this)">4</div>
		  <div class="table" title="9" onclick="room(this)">4</div>
		  <div class="floor">F</div>
		  <div class="floor">F</div>
		  <div class="floor">F</div>
		  <div class="table" title="13" style="grid-column-start: 6;grid-column-end: 8;" onclick="room(this)">6</div>
		  <div class="table" title="14" onclick="room(this)">4</div>
		  
		  <div class="table" title="15" onclick="room(this)">4</div>
		  <div class="floor">F</div>
		  <div class="table" title="17" onclick="room(this)">4</div>
		  <div class="floor">F</div>
		  <div class="table" title="19" onclick="room(this)">4</div>
		  <div class="table" title="20" style="grid-column-start: 7;grid-row-start: 3;grid-row-end: 5;" onclick="room(this)">5</div>
		  <div class="table" title="21" style="grid-column-start: 1;grid-column-end: 3;grid-row-start: 4;grid-row-end: 6;" onclick="room(this)">10</div>
		  
		  <div class="table" title="22" onclick="room(this)">4</div>
		  <div class="table" title="23" onclick="room(this)">4</div>
		  <div class="table" title="24" onclick="room(this)">4</div>
		  <div class="table" title="25" onclick="room(this)">4</div>
		  <div class="table" title="26" onclick="room(this)">4</div>
		  <div class="table" title="27" onclick="room(this)">4</div>
		  <div class="table" title="28" onclick="room(this)">4</div>
		</div>
		
		<div class="next">
			<b>Seat Id: <span id="seat_id">Choose Seat</span></b>
			<br/>
			<b>Date: <span id="date">{{ $date }}</span></b>
			<br/>
			<b>Time: <span id="time">{{ $time }}</span></b>
			<br/>
			<b>Name: <span id="date">{{ $name }}</span></b>
			<br/>
			<b>Seats: <span id="seats">{{ $seats }}</span></b>
			
			<form action="reservation" method="POST">
				{{ csrf_field() }}
				<input type="hidden" value={{ $date }} name="date">
				<input type="hidden" value={{ $time }} name="time">
				<input type="hidden" value={{ $name }} name="name">
				<input type="hidden" value={{ $seats }} name="seats">
				<input type="hidden" value="" id="seat_id_form" name="seat_id">
				<button type="submit" id="submit" class="big_button" style="display:none;">Confirm Reservation</button>
			</form>
			
			@if(Session::has('reservation_msg_not'))
				<i>{{ Session::get('reservation_msg_not') }}</i>
			@endif
		</div>
	</div>
	
	<script>
		var chosenSeats = {{ $seats }};
		var lastChosen;
		function room(chosen){
			if(chosenSeats > chosen.innerHTML){
				alert("Your Group Won't Fit.\nMake Separate Bookings For Separate Tables.");
				return;
			}
			
			if(lastChosen != null){
				lastChosen.style.border = "none";
				lastChosen.style.boxShadow = "none";
			}
			lastChosen = chosen;
			document.getElementById('seat_id').innerHTML = chosen.title;
			document.getElementById('seat_id_form').value = chosen.title;
			document.getElementById('submit').style.display = "block";
			chosen.style.border = "3px solid blue";
			chosen.style.boxShadow = "0 0 3px 2px teal";
		}
	</script>

@endif

</div>

<style>
  .initial_hidden{
    /*display: none;*/
  }

  .order_msg{
    margin: 0 10%;
    background: #EDEDED;
    padding: 50px 30px 80px 30px;
  }

  .order_msg p{
    padding: 10px 0;
  }

</style>

<style>
  .hidden{
    display: none;
  }

  .upper{
    margin-top: 50px;
    margin-left: 50px;
    display: grid;
    grid-template-columns: 50px 50px 50px 50px 50px 50px 50px;
    grid-template-rows: 50px 50px 50px 50px 50px 50px;
	padding: 0 20px 0 0;
    grid-gap: 5px;
  }
  
  .flex{
	  display: flex;
	  justify-content: center;
	  align-items: center;
  }

  .floor{
    background: #ababab;
  }

  .upper .table{
	background: brown;
  }
  
  .upper .table, .upper .floor{
	display: flex;
	justify-content: center;
	align-items: center;
	font-weight: 700;
	cursor: pointer;
  }
  
  .upper .table:hover{
	box-shadow: 0 0 5px 1px black;
  }
  
  .next{
	  width: 30%;
  }
  
  .next b{
	  display: block;
	  padding: 3px;
  }
</style>

@endsection

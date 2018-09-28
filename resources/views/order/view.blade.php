@extends('layout.master')

@section('title','View Info | Restro')

@section('main')


<style>
	.toggler_hidden{
		display: none;
		font-weight: 400;
	}
	
	h2{
		padding: 10px;
	}
	
	.toggler::before{
		content: "View All >";
	}
	
	body{
		color: #323232;
	}
	
	table{
		width: 90%;
		margin: 0 auto;
		padding: 10px;
		border-spacing: 0;
		border-collapse: separate;
	}
	
	table tr td, table tr th{
		padding: 10px 5px;
		border: 2px solid black;
	    background: #DEDEDE;
	}
</style>

<h2>All Your Orders Info : {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th style='width: 450px;'>Items</th>
	   <th>Delivery Boy</th>
	   <th>Status</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_orders as $key => $data)
			<tr>    
			  <td><a href="{{ route('orders_id',['id'=>$data->id])}}">{{$data->id}}</a></td>
			  <td class="toggler" onclick='toggler(this)' id="tab_{{$key + 1}}">
				<script>genTable("{{json_encode($data->items)}}","tab_{{$key + 1}}");</script>
			  </td>                
			  <td>{{ $data->name }}</td>               
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
			</tr>
		@endforeach
		</tbody>
 </table>   
 
 <hr/>
 
 <h2>All Your Reservations</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Date</th>
	   <th>Time</th>
	   <th>Name</th>
	   <th>Seats</th>
	   <th>Seat ID</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_reservations as $key => $data)
			<tr>    
			  <td><a href="{{ route('orders_id',['id'=>$data->id])}}">{{$data->id}}</a></td>               
			  <td>{{ $data->date }}</td>               
			  <td>{{ $data->time }}</td>               
			  <td>{{ $data->name }}</td>               
			  <td>{{ $data->seats }}</td>               
			  <td>{{ $data->seat_id }}</td>                          
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	
	function genTable(strArray, th){
		var total_quantity = 0;
		var total = 0;
		var tax = 0;
		var delivery_charge = 0;
		var subtotal = 0;
		
		var allOrdersString = strArray;
		allOrdersString = allOrdersString.replace(/&quot;/g,'"');
		allOrdersString = allOrdersString.replace(/""/g,'');
		allOrdersString = allOrdersString.replace(/\\/g,'');
		var parsed = JSON.parse(allOrdersString);
		console.log(parsed);
		
		var content = "<div class='toggler_hidden'><table><tr><th>Items</th><th>Quantity</th><th>Price</th></tr>";
		for(let i = 0 ; i < parsed.length; i++){
			total_quantity = total_quantity + parseInt(parsed[i]['quantity']);
			total = total + parseInt(parsed[i]['quantity']) * parseInt(parsed[i]['price']);
			content = content + "<tr><td>" + parsed[i]['name'] + "</td><td>" + parsed[i]['quantity'] + "</td><td>" + parsed[i]['price'] + "</td></tr>";
		}
		
		content = content + "</table>";
		content = content + "<br/> Total Quantity: " + total_quantity;
		content = content + "<br/> Total: " + total;
		
		tax = tax + parseInt(13/100*total);
		delivery_charge = 0;
		subtotal = total + tax + delivery_charge;
		
		content = content + "<br/> Tax: " + tax;
		content = content + "<br/> Delivery Charge: " + delivery_charge;
		content = content + "<br/> Sub-Total: " + subtotal;
		content = content + "<hr/></div>";

		//alert(subtotal);
		document.getElementById(th).innerHTML = content;
	}

	function toggler(item){
		if(item.children[0].style.display == "block"){
			item.children[0].style.display = "none";
		}else{
			item.children[0].style.display = "block";
		}
	}
	
 </script>
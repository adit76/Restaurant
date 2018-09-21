@extends('admin.layout.layout')

@section('title','Old Orders | Restro')

@section('main')
<style>
	.toggler_hidden{
		display: none;
		font-weight: 200;
	}
	
	.toggler::before{
		content: "View All >";
	}
</style>

<h2>Old Orders</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th style='width: 450px;'>Items</th>
	   <th>Name</th>
	   <th>Contact</th>
	   <th>Address</th>
	   <th>City</th>
	   <th>Street</th>
	   <th>Delivery Boy</th>
	   <th>Status</th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($all_orders_old as $key => $data)
			<tr>    
			  <th>{{$data->id}}</th>
			  <th class="toggler" onclick='toggler(this)' id="tab_{{$key + 1}}">
				<script>genTable("{{json_encode($data->items)}}","tab_{{$key + 1}}");</script>
			  </th>
			  <th>{{$data->first_name}} {{$data->last_name}}</th>
			  <th>{{$data->contact}}</th>
			  <th>{{$data->address}}</th>                 
			  <th>{{$data->city}}</th>                 
			  <th>{{$data->street}}</th>                 
			  <th>{{ $data->name }}</th>                 
			  <th>
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
			  </th>                 
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
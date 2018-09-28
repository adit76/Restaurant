@extends('admin.layout.layout')

@section('title','Old Orders | Restro')

@section('main')
<style>
	.toggler_hidden{
		display: none;
		font-weight: 400;
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
	   <th>Print</th>
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
			  <td><a href="{{ route('orders_id',['id'=>$data->id])}}">{{$data->id}}</a></td>
			  <td class="toggler" onclick='toggler(this)' id="tab_{{$key + 1}}">
				<script>genTable("{{json_encode($data->items)}}","tab_{{$key + 1}}","{{$data->first_name}} {{$data->last_name}}","{{$data->address}}, {{$data->city}}","{{$data->contact}}");</script>
			  </td>
			  <td onclick="printThis('tab_{{$key + 1}}')" style="cursor: pointer;">Print</td>
			  <td>{{$data->first_name}} {{$data->last_name}}</td>
			  <td>{{$data->contact}}</td>
			  <td>{{$data->address}}</td>                 
			  <td>{{$data->city}}</td>                 
			  <td>{{$data->street}}</td>                 
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

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	
	function genTable(strArray, th, name, address, contact){
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
		
		var content = "<div class='toggler_hidden'><p class='print_hide'>Name: " + name + "</p><p class='print_hide'>Address: " + address + "</p><p class='print_hide'>Contact: " + contact + "</p><table><tr><th>Items</th><th>Quantity</th><th>Price</th></tr>";
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
		content = content + "<br/><b> Sub-Total: " + subtotal + "</b>";
		content = content + "<hr/></div>";

		//alert(subtotal);
		document.getElementById(th).innerHTML = content;
		
		var sheet = document.createElement('style')
		sheet.innerHTML = ".toggler_hidden table td, .toggler_hidden table th{border: 1px solid black; !important} .toggler_hidden th td {border: 1px solid black; padding: 0 5px;} p{display: none;} @media print { p{display: block; margin-top: -5px;} .toggler_hidden table td, .toggler_hidden table th{ padding: 10px; } .toggler_hidden{margin-top: 20px;} }";
		document.getElementById(th).appendChild(sheet);
	}

	function toggler(item){
		if(item.children[0].style.display == "block"){
			item.children[0].style.display = "none";
		}else{
			item.children[0].style.display = "block";
		}
	}
	
 </script>
 
  <script>
	function printThis(content)
	{
	   //var divToPrint=document.getElementById("print_content");
	   var divToPrint=document.getElementById(content);
	   newWin= window.open("Order.pdf");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.print();
	   newWin.close();
	}

	/* $('.print').on('click',function(){
		printData(this);
	}) */
</script>
<script>
  if(localStorage.getItem('cart') == null){
    //document.getElementsByTagName("body")[0].style.opacity = "0";
    window.location.replace("menu");
  }
</script>

@extends('layout.master')

@section('title','Confirm Order | Restro')

@section('main')

<link rel="stylesheet" src="css/menu.css"/>
<style>
  .order_msg{
    margin: 0 10%;
    background: #EDEDED;
    padding: 50px 30px 80px 30px;
  }
  
  .menu {
    display: block;
  }
  
  .menu .orders {
    margin-left: 0;
    width: 95%;
  }
  
  .hide_pc{
	  display: none;
  }
</style>

<script>
//refreshOrderPage();
/* function refreshOrderPage(){
  setTimeout(function(){
    document.getElementById('copy').innerHTML = document.getElementById('cart_small').innerHTML;
  }, 1500);

  document.getElementsByClassName('dropdown_btn_only')[0].style.display = "none";

  var inCartLocalString = JSON.stringify(localStorage.getItem('cart'));
  document.getElementById('items').value = inCartLocalString;
} */
</script>

<div class="order_msg">

@if(Session::has('message'))
  <div class="initial_hidden">
    <h1>Order Successfully Placed</h1>
    <p>Total Items: <span id="total_items"></span></p>
    <hr/>
    <p>Contact <a href="tel:+977-98000000">+977-98000000</a> For More Details</p>
    <p>Connect With Us:</p>
    <b>Facebook</b>
    -
    <b>Instagram</b>
  </div>

  <script>
	var inCart = JSON.parse(localStorage.getItem('cart'));
    var total_quantity = 0;
	for(var i = 0 ; i < inCart.length ; i++){
		total_quantity = total_quantity + (inCart[i]['quantity']);
	}
	
	document.getElementById('total_items').innerHTML = total_quantity;
	
    localStorage.removeItem('cart');
    localStorage.removeItem('cart_date');
  </script>

@else
  <form method="POST" action="{{route('order_confirm')}}" class="initial_shown">
    <h1>Confirm Your Order</h1>
    {{csrf_field()}}
    <input type="hidden" name="items" id="items" value="">
	
	<div class="menu" id="print_content">
	<div class="hide_pc">
			<div class="info" style="display: flex; justify-content: space-between;align-items:center;">
				<div style="margin-left: 20px;"><h1>Restro</h1> <p>Name: {{ Auth::user()->first_name }} {{ Auth::user()->first_name }} </p> </div>
				<div style="margin-right: 20px;">
					<p>Contact: 929292</p><br/>
					<p>Address: Kathmandu, Nepal</p></br>
					<p>www.restro.com.np</p></br>
				</div>
			</div>
		</div>
	<style type="text/css">
		@media print and (color) {
		   * {
			  -webkit-print-color-adjust: exact;
			  print-color-adjust: exact;
		   }
		}
		
		@media print {
			*{
				font-family: "Roboto", Sans-serif;
			}
			
			b{
				display: none;
			}
			
			p{
				padding: 2px !important;
				margin: 0 !important;
			}
			
			.hide_pc{
				display: block !important;
			}
			
			.menu table{
				width: 100%;
				border-collapse:separate;
				border-spacing:0;
				-moz-user-select: none;
				-webkit-user-select: none;
				-ms-user-select:none;
				user-select:none;
				-o-user-select:none;
			}

			.menu table tr td, .menu table tr th{
				padding: 5px;
				max-width: 50px;
			}

			.menu table tr th{
				background: #67aa77;
				color: white;
				text-align: left;
			}

			.menu table tr:nth-child(odd) {
				background-color: #f2f2f2;
				margin: 0;
				padding: 0;
			}

			.menu .orders{
				width: 100%;
			}

			.menu .orders .fixed_container_parent{
				width: 100%;
				min-height: 400px;
				max-height: auto;
				position: relative;
				overflow: auto;
			}

			.menu .orders .fixed_container, .menu .orders .fixed_container_alternative {
				border: 1px solid black;
				position: relative;
				overflow-y: auto;
				background: #EFEFEF !important;
				max-width: 100%;
				max-height: 96%; /* For scrolling */
			}

			.menu .orders .fixed_container_fixed{
				position: fixed;
				top: 85px;
				width: inherit;
				max-width: 45%;
			}

			.menu .list table{
				animation: show 0.5s ease forwards;
			}

			.menu .orders .items .current_change{
				animation: change 0.5s ease forwards;
				opacity: 1;
			}

			@media screen and (max-width: 800px){
				.menu{
					flex-flow: column;
					align-items: center;
					min-height: 200px;
				}

				.menu .orders{
					margin-left: 0;
					margin-top: 10px;
					width: 400px;
				}

				.menu .orders, .menu .list{
					width: 90%;
				}

				.menu .orders .fixed_container{
					position: relative !important;
					width: auto !important;
					top: 0 !important;
					max-width: 100% !important;
				}
			}

			.menu .orders .calculations{
				font-weight: 500;
				margin-left: 10px;
			}

			.menu .orders .calculations p{
				margin: 2px;
			}

			.menu .orders .calculations #bill_sub_total{
				font-weight: 700;
				font-size: 1.05em;
				letter-spacing: 3px;
				position: relative;
			}
			
			button{
				display: none;
			}
		}
	</style>
	<div class="orders">
    <div class="fixed_container_parent">
      <div class="fixed_container_alternative">
        <div class="items" id="orders">
          <b>Make Some Orders...</b>
          <!-- <table>

          </table>-->
        </div>

        <hr/>

		
        <div class="calculations">
          <p id="bill_total_quantity">Total Quantity: 0</p>
          <p id="bill_total">Total: Rs. 0.00</p>
          <p id="bill_tax">Tax: Rs. 0.00</p>
          <p id="bill_delivery_charge">Delivery Charge: Rs. 0.00</p>
          <p id="bill_sub_total">Sub Total: Rs. 0.00</p>
        </div>
		
		<button type="submit" class="big_button">Confirm Order</button>
      </div>
		<button class="print big_button" id="print">Confirm and Print Bill</button>
    </div>
  </div>
  </div>
	
	<!--<div id="copy">
    </div>-->
	
  </form>

  <script>
	//document.getElementsByClassName('dropdown_btn_only')[0].style.display = "none";
	var inCartLocalString = JSON.stringify(localStorage.getItem('cart'));
	document.getElementById('items').value = inCartLocalString;
  </script>	
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/menu.js"></script>

	<script>
		function printData()
		{
		   var divToPrint=document.getElementById("print_content");
		   newWin= window.open("");
		   newWin.document.write(divToPrint.outerHTML);
		   newWin.print();
		   newWin.close();
		}

		$('#print').on('click',function(){
			printData();
		})
	</script>
@endif

</div>

@endsection

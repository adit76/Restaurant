@extends('layout.master')

@section('title','Menu | Restro')

@section('main')
<link rel="stylesheet" href="{{asset('css/menu.css')}}"/>

<div class="message_container" id="message_container">
  <!--All Messages-->
</div>

<h1 style="text-align: center; padding: 5px 0; color: white;">Menu</h1>

<div class="cart_icon" id="cart_icon" style="display: none;">In Cart: 0</div>

<div class="menu">
  <div class="list" id="special_offer">
    <h2 class="loading" style="text-align: center; margin-top: 35%;">Loading....</h2>
    <!-- <table>

    </table> -->
  </div>

  <div class="orders">
    <div class="fixed_container_parent">
      <div class="fixed_container">
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
        <a href="order"><button type="submit" class="big_button order_btn" id="order_btn">Order Now</button></a>
        <br/><br/><br/><br/>
      </div>
    </div>
  </div>
</div>

<br/><br/><br/><br/><br/><br/>

<noscript>
	<style>
		.menu{
			display: none;
		}

		h1{
			text-align: center;
			font-family: courier;
		}
	</style>
	<h1>Dude, Turn On the Java Script, Or else Nothing gonna work.</h1>
</noscript>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/menu.js')}}"></script>-->
<!--Imported Already in Master End-->

@endsection

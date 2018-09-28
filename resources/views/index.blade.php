@extends('layout.master')

@section('title','My Restro | Home')

@section('main')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

	/*CSS OVERRIDE FOR FIXES*/
	.navigation{
		background: none !important;
		background: transparent !important;
	}
	
	#mobile_cart_small {
		left: -1200% !important;
		width: 1900% !important;
	}

	main{
		display: none;
	}

	body{
		opacity: 0;
		overflow: hidden;
		transition: opacity 3s 0.5s linear;
	}

	@media screen and (max-width: 900px){
		.carousel .img img{
			margin: 0;
			border: none;
		}

		.slider1 .main .img .card{
			width: 100px;
			margin-top: -10px;
		}

		.slider1 .main .img .card h3{
			font-size: 15px;
		}

		.slider1 .main .img .card button{
			padding: 2px 4px;
		}

		.slider2 .main .img .card{
			width: 100px;
			margin-top: -10px;
		}

		.slider2 .main .img .card h3{
			font-size: 15px;
		}	

		.slider2 .main .img .card button{
			padding: 2px 4px;
		}	
	}

		@media screen and (max-width: 500px){
			.gallery{
				
				padding: 10px;
			}
			.gallery_inner{
				overflow: hidden;
				overflow-x: scroll;
				flex-wrap: nowrap !important;
				flex-flow: row;
			}

			.gallery_inner .image_container{
				min-width: 200px;
				margin-left: 50px;

			}
		}
</style>

<div class="container">
      <div class="inner">

          <div class="background-text">
        	<h1>FIND YOUR TABLE FOR ANY OCCASION</h1> 
          	<form method="GET" action="reservation" class="form" id="form" >
					{{csrf_field()}}
                <label class="label"><i class="far fa-calendar"></i>
				<input type="text" id="datepicker" name="date" readonly="true" placeholder="Date" required>
				</label>

                <label class="label"><i class="far fa-clock"></i>
				<select name="time">
                  <option value="10.00">10:00 AM</option>
                  <option value="10.30">10:30 AM</option>
                  <option value="11.00">11:00 AM</option>
                  <option value="11.30">11:30 AM</option>
                  <option value="12.00">12:00 PM</option>
                  <option value="12.30">12:30 PM</option>
                  <option value="13.00">01:00 PM</option>
                  <option value="13.30">01:30 PM</option>
                  <option value="14.00">02:00 PM</option>
                  <option value="14.30">02:30 PM</option>
                  <option value="15.00">03:00 PM</option>
                  <option value="15.30">03:30 PM</option>
                  <option value="16.00">04:00 PM</option>
                  <option value="16.30">04:30 PM</option>
                  <option value="17.00">05:00 PM</option>
                  <option value="17.30">05:30 PM</option>
                  <option value="18.00">06:00 PM</option>
                  <option value="18.30">06:30 PM</option>
                  <option value="19.00">07:00 PM</option>
                  <option value="19.30">07:30 PM</option>
                  <option value="20.00">08:00 PM</option>
                  <option value="20.30">08:30 PM</option>
                  <option value="21.00">09:00 PM</option>
                  <option value="21.30">09:30 PM</option>
                  <option value="22.00">10:00 PM</option>
                </select>
				</label>

                <label class="label"><i class="far fa-user"></i>
				<input type="text" name="name" placeholder="Name" required>
				</label>

                <label class="label"><img src="images/seat.svg" width="30px">
				<input type="number" name="seats" min="1" max="10" placeholder="Seats" style="width: 60px;" required>
				</label>

                <br>
                
            <button type="submit" id="defbut">Book Table</button>
          </form>
      

          <button class="mobile_btn" type="submit" id="target">Book Table</button>

        </div>

         <div class="mobile-background-text">
        	 
          	<form method="GET" action="reservation" class="mobile-form" >
                {{csrf_field()}}

                <i class="fa fa-close" id="close" style="color: white; font-size: 25px;"></i>
				<input type="text" id="mobile-datepicker" name="date" readonly="true" placeholder="Date" required>
				
				<br>
                
				<select name="time">
                  <option value="10.00">10:00 AM</option>
                  <option value="10.30">10:30 AM</option>
                  <option value="11.00">11:00 AM</option>
                  <option value="11.30">11:30 AM</option>
                  <option value="12.00">12:00 PM</option>
                  <option value="12.30">12:30 PM</option>
                  <option value="13.00">01:00 PM</option>
                  <option value="13.30">01:30 PM</option>
                  <option value="14.00">02:00 PM</option>
                  <option value="14.30">02:30 PM</option>
                  <option value="15.00">03:00 PM</option>
                  <option value="15.30">03:30 PM</option>
                  <option value="16.00">04:00 PM</option>
                  <option value="16.30">04:30 PM</option>
                  <option value="17.00">05:00 PM</option>
                  <option value="17.30">05:30 PM</option>
                  <option value="18.00">06:00 PM</option>
                  <option value="18.30">06:30 PM</option>
                  <option value="19.00">07:00 PM</option>
                  <option value="19.30">07:30 PM</option>
                  <option value="20.00">08:00 PM</option>
                  <option value="20.30">08:30 PM</option>
                  <option value="21.00">09:00 PM</option>
                  <option value="21.30">09:30 PM</option>
                  <option value="22.00">10:00 PM</option>
                </select>
				
				<br>
                
				<input type="text" name="name" placeholder="Name" required>
				
				<br>
                
				<input type="number" name="seats" min="1" max="10" placeholder="Seats" style="width: 60px;" required>
				

                <br>
                
            <button type="submit">Book Table</button>
          </form>
      

        </div>

        <div class="background-arrow">
        <button type="button"><i id="scroll-button" class="fas fa-arrow-circle-down"></i></button>
        </div>
    </div>

</div>

<div class="outer">
	<div class="trending">
		<h1>TRENDING</h1>

		<div class="slider1" style="position: relative; ">
			<div class="main" style="padding: 10px;">
				<div class="carousel">
					<div class="img">
						<img src="images/menu/img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="images/menu/img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="images/menu/img1.jpg">
					 <div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
				</div>

				<div class="carousel">
					<div class="img">
						<img src="img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img3.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
				</div>

				<div class="carousel">
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
				</div>
			</div>

		<div class="butt">
			<i onclick="scrollRight(0)" class="fas fa-arrow-circle-right"></i>
			<i onclick="moveLeft(0)" class="fas fa-arrow-circle-left"></i>
		</div>
	</div>
	<br><br><br><br>
</div>

<div class="combo">
	<h1>COMBO-PACK</h1>

		<div class="slider2" style="position: relative;">
			<div class="main main2" style="padding: 10px;">
				<div class="carousel">
					<div class="img">
						<img src="images/menu/img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="images/menu/img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="images/menu/img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
				</div>

				<div class="carousel">
					<div class="img">
						<img src="img1.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img3.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
				</div>

				<div class="carousel">
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
					<div class="img">
						<img src="img2.jpg">
						<div class="card" style="background: linear-gradient(to right, #000000 0%, #323232 100%); color: #DEDEDE;  padding: 10px;">
								<h3 style="color: #DEDEDE;">Soupy Momo</h3>
								<h3 style="color: #EFEFEF;">Price: 150</h3>
								<button class="order_button">Order Now</button>
						</div>
					</div>
				</div>
			</div>

		<div class="butt">
			<i onclick="scrollRight(1)" class="fas fa-arrow-circle-right"></i>
			<i onclick="moveLeft(1)" class="fas fa-arrow-circle-left"></i>
		</div>
		</div>
		<br><br>
	</div>


</div>

<div class="gallery">
	<h1>PHOTO GALLERY</h1>

		<div class="gallery_inner" style="display: flex; flex-wrap: wrap; justify-content: space-around; justify-content: space-evenly;">

			@if(count($gallery) == 0)
				<h3>Gallery Is Empty.</h3>
			@endif
			
			<?php $i = 0; ?>
			@foreach($gallery as $g)			
				<div class="image_container">
					<a href="gallery/{{$g[$i]->id}}">
					<img src="{{asset('images/gallery/'.$g[$i]->url)}}">
					<div class="inner_animated" style="text-align: center;"><p>{{$g[$i]->name}}<br/>{{$g[$i]->date}}</p></div>
					</a>
				</div>
				
				<?php $i = $i + 1; ?>
			@endforeach

		</div>
</div>

<div class="dummy">
  <img src="images/background2.jpg">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$("#scroll-button").click(function() {
$('html,body').animate({
    scrollTop: $(".trending").offset().top},
    'slow');
});
</script>

<script>
  var x = document.getElementsByClassName("main");
  var screenWidth = screen.width;
  var scrolledBy = 1;

  function scrollRight(i){
    var smooth = setInterval(function(){
        x[i].scrollBy(10, 0);
        scrolledBy = scrolledBy + 10;
        if(scrolledBy >= screenWidth){
          clearInterval(smooth);
          scrolledBy = 1;
        }
    }, 0);
  }

  //Author: Niush Sitaula
  //Copyright for open uses: 2018

  function moveLeft(i){
    var smooth2 = setInterval(function(){
        x[i].scrollBy(-10, 0);
        scrolledBy = scrolledBy - 10;
        if(scrolledBy <= (-screenWidth)){
          clearInterval(smooth2);
          scrolledBy = 1;
        }
    }, 0);
  }

$(document).ready(function() {
    var dateToday = new Date();
    $( function() {
	    var dates = $("#datepicker").datepicker({
	    defaultDate: "+1w",
	    changeMonth: true,
	    numberOfMonths: 1,
	    minDate: dateToday,
	    onSelect: function(selectedDate) {
	        var option = this.id == "from" ? "minDate" : "maxDate",
	            instance = $(this).data("datepicker"),
	            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
	        dates.not(this).datepicker("option", option, date);
	    }
	  	});
  	});

  	$( function() {
	    var dates = $("#mobile-datepicker").datepicker({
	    defaultDate: "+1w",
	    changeMonth: true,
	    numberOfMonths: 1,
	    minDate: dateToday,
	    onSelect: function(selectedDate) {
	        var option = this.id == "from" ? "minDate" : "maxDate",
	            instance = $(this).data("datepicker"),
	            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
	        dates.not(this).datepicker("option", option, date);
	    }
	  	});
  	});
	});

// RESPONSIVE
	var form = document.getElementsByClassName("mobile-form")[0];
	var windowSize = $(window).width();
	var defbutt = document.getElementsByClassName("mobile_btn")[0];

	$(window).resize(function(){
      windowSize = $(window).width();
	});
	$("#target").click(function(){
		if(windowSize  < 900){
			form.style.visibility = 'visible';
			defbutt.style.visibility = 'hidden';
		}
	}); 

	$("#close").click(function(){
		if(windowSize  < 900){
			form.style.visibility = 'hidden';
			defbutt.style.visibility = 'visible';
		}
	}); 

</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

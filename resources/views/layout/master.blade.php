<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<body>

<div class="navigation">

    <div class="left">
      <a href="index"><img src="{{ asset('images/logo.png') }}"></a>
    </div>

    <div class="right nav-right">
      <ul>
        <li><a href="index">HOME</a></li>
        <li><a href="menu">MENU</a></li>
        <li><a href="contact">CONTACT</a></li>
        <li><a href="about">ABOUT</a></li>
        @guest
        <li><a href="login">LOGIN</a></li>
        <li><a href="register">REGISTER</a></li>
        @else
        <li><a href="logout">LOGOUT</a></li>
        <li><a href="view" alt="Orders And Reservations">VIEW</a></li>
        @endauth
        <li onclick="dropdown(this.className)" class="dropdown_btn_only" style="position: relative;"><a href="#!">CART <i class="fas fa-shopping-cart"></i><span id="total_cart"></span></a>
			<div class="dropdown" id="cart_small">
				<table id="dropdown_table">
					<!--<tr>
						<td>Apple</td>
						<td>5</td>
						<td>5</td>
					</tr>-->
				</table>
				<br/>
				<b><p id="dropdown_quantity"></p>
				<p id="dropdown_total"></p></b>
        <a href="order"><button type="submit" class="big_button dropdown_btn">Order Now</button></a>
        </form>
			</div>
		</li>
      </ul>
    </div>

    <div class="mobile-nav-right">
        <a href="#!" onclick="dropdown(this.className)" class="dropdown_btn_only" style="position: relative;"><i class="fas fa-shopping-cart"></i><span id="total_cart_mobile"></span>
			<div class="dropdown" id="mobile_cart_small">
				<div id="mobile_dropdown_table">
					<!--<tr>
						<td>Apple</td>
						<td>5</td>
						<td>5</td>
					</tr>-->
				</div>
				<br/>
				<b><p id="mobile_dropdown_quantity"></p>
				<p id="mobile_dropdown_total"></p></b>
        <a href="order"><button type="submit" class="big_button dropdown_btn">Order Now</button></a>
			</div>
		</a>
        <div class="togglebutton">
          <button class="butt" id="burger"><i class="fas fa-bars"></i></button>
              <ul class="nav" id="menu">
        				<li><a href="index">HOME</a></li>
        				<li><a href="menu">MENU</a></li>
        				<li><a href="contact">CONTACT</a></li>
        				<li><a href="about">ABOUT</a></li>
                @guest
                <li><a href="login">LOGIN</a></li>
                <li><a href="register">REGISTER</a></li>
                @else
                <li><a href="view">VIEW</a></li>
                <li><a href="logout">LOGOUT</a></li>
                @endauth
              </ul>
          </div>
    </div>
</div>

<!--<div class="popup" style="position: fixed; width: 70%; height: 500px; z-index: 99; top: 0; left: 0; opacity:0.8;">
	<iframe src="menu" width="100%" height="100%"></iframe>
</div>-->

<main>
@section('main')
@show
</main>

<div class="footer">
<div class="foot">
  <div class="address">
    <h3>ADDRESS</h3>
    <p>Kothshwor-35, Kathmandu</p>
  </div>
  <div class="phone">
    <h3>PHONE</h3>
    <p>01-4612345</p>
  </div>
  <div class="email">
    <h3>E-MAIL</h3>
    <p>contactme@gmail.com</p>
  </div>
  <div class="social">
    <i class="fab fa-facebook-square" style="color: #3B5998; border-radius: 5px;"></i>
    <i class="fab fa-google-plus" style="color: #d34836;"></i>
  </div>
</div>
<hr style="background-color: #595959; height: 2px; border: none; margin: 0px 20px;">
  <div class="lintend">
    <p style="text-align: center;">Designed by Lintend</p>
  </div>
</div>

<script>

  var menu = document.getElementById("menu");
  var burger = document.getElementById("burger");
  menu.style.right = "-200px";
  menu.style.transition = "right 0.5s ease";

  burger.onclick = function(){menuHideShow()};
  document.onclick = function(){menuOverlay()};

  function menuHideShow(){
    if(menu.style.right == "-200px"){
      // menu.style.display = "block";
      menu.style.right = 0;
    }
    else{
      // menu.style.display = "none";
      menu.style.right = '-200px';
    }
  }

  function menuOverlay(){
    ////alert(event.target.className);
    if(event.target.className != 'nav' && event.target.className != 'butt' && event.target.className != 'fas fa-bars'){
      menu.style.right = '-200px';
    }
  }

  var dropdown_shown = false;

  function dropdown(className){
	 if(className == "dropdown_btn_only"){
		if(dropdown_shown == false){
			document.getElementById("cart_small").style.opacity = "1";
			document.getElementById("mobile_cart_small").style.opacity = "1";
			document.getElementById("cart_small").style.maxHeight = "2000px";
			document.getElementById("mobile_cart_small").style.maxHeight = "2000px";
			document.getElementById("cart_small").style.transform = "scale(1)";
			document.getElementById("mobile_cart_small").style.transform = "scale(1)";
			dropdown_shown = true;
		}else{
			document.getElementById("cart_small").style.opacity = "0";
			document.getElementById("mobile_cart_small").style.opacity = "0";
			document.getElementById("cart_small").style.maxHeight = "0";
			document.getElementById("mobile_cart_small").style.maxHeight = "0";
			document.getElementById("cart_small").style.transform = "scale(0)";
			document.getElementById("mobile_cart_small").style.transform = "scale(0)";
			dropdown_shown = false;
		}
	 }
  }

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<script src="{{asset('js/menu.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>

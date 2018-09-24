<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Restro Website Description Goes Here...">
	<meta name="keywords" content="Restro, Nepal, Online Order, Reservations, Great, Service">
	<meta name="author" content="Lintend, Niush, Adit">
	<meta name="theme-color" content="#323232">
	<meta name="msapplication-navbutton-color" content="#323232">
	<meta name="apple-mobile-web-app-status-bar-style" content="#323232">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Custom fonts-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark sidenav-toggled" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="fa fa-fw fa-dashboard"></i>Admin Dashboard</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav collapsed" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Orders">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#orders_toggle" data-parent="#exampleAccordion">
			<i class="fa fa-list-ol" aria-hidden="true"></i>
            <span class="nav-link-text">Orders</span>
          </a>
          <ul class="sidenav-second-level collapse" id="orders_toggle">
            <li>
              <a href="{{ route('dashboard') }}">Current Orders</a>
              <!--<a href="dashboard/orders">Current Orders</a>-->
            </li>
            <li>
              <a href="{{ route('orders_old') }}">Old Orders</a>
            </li>
             <li>
              <a href="{{ route('orders_raw') }}">Raw File</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Reservations">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#reserve_toggle" data-parent="#exampleAccordion">
			<i class="fa fa-check-square-o" aria-hidden="true"></i>
            <span class="nav-link-text">Reservations</span>
          </a>
          <ul class="sidenav-second-level collapse" id="reserve_toggle">
            <li>
              <a href="{{ route('reservations') }}">All Reservations</a>
            </li>
            <li>
              <a href="{{ route('reservations_old') }}">Old Reserve</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#users_toggle" data-parent="#exampleAccordion">
			<i class="fa fa-user-o" aria-hidden="true"></i>
            <span class="nav-link-text">Users</span>
          </a>
          <ul class="sidenav-second-level collapse" id="users_toggle">
            <li>
              <a href="{{ route('users') }}">User Details</a>
            </li>
            <li>
              <a href="{{ route('users_orders') }}">User Orders</a>
            </li>
            
          </ul>
        </li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#menu_toggle" data-parent="#exampleAccordion">
			<i class="fa fa-cutlery" aria-hidden="true"></i>
            <span class="nav-link-text">Menu</span>
          </a>
          <ul class="sidenav-second-level collapse" id="menu_toggle">
			<li>
              <a href="{{ route('category') }}">Category</a>
            </li>
			<li>
              <a href="{{ route('category') }}">Category</a>
            </li>
            <li>
              <a href="{{ route('today') }}">Today</a>
            </li>
          </ul>
        </li>
		
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
          <a class="nav-link directlink" href="{{ route('messages') }}">
			<i class="fa fa-comments" aria-hidden="true"></i>
            <span class="nav-link-text">Messages</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Album">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#album_toggle" data-parent="#exampleAccordion">
			<i class="fa fa-picture-o" aria-hidden="true"></i>
            <span class="nav-link-text">Album</span>
          </a>
          <ul class="sidenav-second-level collapse" id="album_toggle">
            <li>
              <a href="{{ route('album') }}">Album</a>
            </li>
            <li>
              <a href="{{ route('new_album') }}">New Album</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Delivery Boy">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#delivery_boy_toggle" data-parent="#exampleAccordion">
			<i class="fa fa-motorcycle" aria-hidden="true"></i>
            <span class="nav-link-text">Delivery Boy</span>
          </a>
          <ul class="sidenav-second-level collapse" id="delivery_boy_toggle">
            <li>
              <a href="{{ route('delivery_boy') }}">Delivery Boy</a>
            </li>
            <li>
              <a href="{{ route('delivery_boy_new') }}">New Boy</a>
            </li>
          </ul>
        </li>
       
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

      <!-- end of side nav -->

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link mr-lg-2" href="{{ route('messages') }}">
            <i class="fa fa-fw fa-envelope"></i><span>Messages</span>
          </a>
        </li>
        <li class="nav-item">
			<a class="nav-link" href="{{ route('admin_logout') }}">
				<i class="fa fa-fw fa-sign-out"></i> Logout
			</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- end of notifications -->

  <div class="content-wrapper">
    <div class="container-fluid">
		@section('main')
		@show
		<br/>
		<br/>
    </div>
  </div>
  
  <style>
	body:after{
		content:"Developed By: Lintend Pvt. Ltd.";
		position: absolute;
		right: 20px;
		bottom: 15px;
		color: white;
	}
	
	body:before{
		content:"2018";
		position: absolute;
		right: 20px;
		bottom: 0px;
		color: white;
		opacity: 0;
		transition: all 0.5s 0.5s ease;
	}
	
	body:hover:before{
		opacity: 1;
	}
  </style>
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <!--scripts for all pages-->
    <script>
		$("#sidenavToggler").click();
		//$("body").toggleClass("sidenav-toggled"); //Done in CSS Initially
		//$(".navbar-sidenav .nav-link-collapse").addClass("collapsed"); //Done in CSS Initially
	
		!function(e){"use strict";e('.navbar-sidenav [data-toggle="tooltip"]').tooltip({template:'<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}),e("#sidenavToggler").click(function(o){o.preventDefault(),e("body").toggleClass("sidenav-toggled"),e(".navbar-sidenav .nav-link-collapse").addClass("collapsed"),e(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show")}),e(".navbar-sidenav .nav-link-collapse").click(function(o){o.preventDefault(),e("body").removeClass("sidenav-toggled")}),e("body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll",function(e){var o=e.originalEvent,t=o.wheelDelta||-o.detail;this.scrollTop+=30*(t<0?1:-1),e.preventDefault()}),e(document).scroll(function(){e(this).scrollTop()>100?e(".scroll-to-top").fadeIn():e(".scroll-to-top").fadeOut()}),e('[data-toggle="tooltip"]').tooltip(),e(document).on("click","a.scroll-to-top",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);		
	</script>
    <script>
    $('#toggleNavPosition').click(function() {
      $('body').toggleClass('fixed-nav');
      $('nav').toggleClass('fixed-top static-top');
    });
    </script>
    <!-- Toggle between dark and light navbar-->
    <script>
    $('#toggleNavColor').click(function() {
      $('nav').toggleClass('navbar-dark navbar-light');
      $('nav').toggleClass('bg-dark bg-light');
      $('body').toggleClass('bg-dark bg-light');
    });

    </script>
  </div>
  <!--WEB DEVELOPER: NIUSH SITAULA-->
  <!--WEB DESIGNER: ADITYA SAPKOTA-->
  <!--RESTRO NAME: GOES HERE-->
  <!--COMPANY: LINTEND PVT. LTD.-->
</body>

</html>
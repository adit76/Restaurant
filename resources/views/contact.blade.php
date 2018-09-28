@extends('layout.master')

@section('title','Contact | Restro')

@section('main')
<link rel="stylesheet" href="{{asset('css/contact.css')}}"/>
<style>
	/*CSS OVERRIDE FOR FIXES*/
	#mobile_cart_small {
		left: -1200% !important;
		width: 1900% !important;
	}
</style>

<div class="contact_container">
    <div class="contact_inner">

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.3480159372925!2d85.31084631441394!3d27.675636733493064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb183357b70b79%3A0x355df1a51e0933ba!2sBooze+Belly!5e0!3m2!1sen!2snp!4v1537167337862" width="400" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <div class="content">
          <h1>CONTACT US</h1>
          <div class="info" style="padding: 20px;">
                <div class="address" style="float: left;">
                    <h4>Address</h4>
                    <h5>Jhamsikhel, Patan 44700</h5>
                    <h5>Kathmandu, Nepal</h5>
                </div>
                <div class="tel&mail" style="float: right;">
                    <h4>Telephone</h4>
                    <h5>01-4477665, 9852015542</h5>
                    <br>
                    <h4>E-Mail</h4>
                    <h5>musample@gmail.com</h5>
                </div>
          </div>

          <form action="message" method="POST" style="width: 100%; clear: both; padding: 40px 20px;">
            {{ csrf_field() }}
            <input type="text" name="name"  placeholder="Name">
            <input type="email" name="email" placeholder="E-Mail">
            <textarea rows="4" name="message" placeholder="Message"></textarea>
            <button type="submit">Send <i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
    </div>
  </div>

@endsection

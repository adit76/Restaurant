@extends('layout.master')

@section('title','About | Restro')

@section('main')
<link rel="stylesheet" href="{{asset('css/about.css')}}"/>
<style>
	/*CSS OVERRIDE FOR FIXES*/
	#mobile_cart_small {
		left: -1200% !important;
		width: 1900% !important;
	}
</style>

<div class="about_container">
    <div class="image" style="height: 400px; background-image: url('{{asset("images/about.jpg")}}'); background-repeat: no-repeat;
    background-size: cover;">
    </div>

    <div class="desc">
        <div class="div1" style="display: flex; text-align: center;">

          <div class="text" style="margin: 25px;">
            <h1 style="letter-spacing: 10px;">The Restaurant</h1>
            <div class="brace"></div>
              <p style="text-align: justify; padding-top: 45px; line-height: 24px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              when an unknown printer took a galley of type and scrambled it to make a type
              specimen book. It has survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was popularised in
              the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
              and more recently with desktop publishing software like Aldus PageMaker
              including versions of Lorem Ipsum.</p>
          </div>
          <img src="images/res.jpg" style="border: 5px solid black; padding: 5px; height: auto; margin: 20px;">

      </div>
      <br><br>
      <div class="div2" style="display: flex;  color: white;">
        <div class="inner1" style="margin: 80px 200px">

            <!-- Lunch -->
            <h2 style="margin: 0; padding: 0;">LUNCH</h2>
            <div class="brace" style="margin: 0; width: 250px;"></div>

            <h3 style="color: #7398b5;">Sun, Mon, Tue, Thu, Fri</h3>
            <h3>12:00 pm - 3:00 pm</h3>
            <br>
            <br>
            <h3 style="color: #7398b5;">Wed & Sat</h3>
            <h3>11:00 am - 3:00 pm</h3>

        </div>
          <hr>
					<div class="inner2" style="margin: 80px 100px">
              <h2 style="margin: 0; padding: 0;">DINNER</h2>
              <div class="brace" style="margin: 0; width: 250px;"></div>

              <h3 style="color: #7398b5;">Sun, Mon, Tue, Wed, Thu</h3>
              <h3>6:00 pm - 10:00 pm</h3>
              <br>
              <br>
            <div class="live">
              <h3 style="position: relative; color: #7398b5;">Fri & Sat <span style="color: #c02e1d; border: 2px solid #c02e1d; padding: 5px; border-radius: 25px; cursor: pointer; "> Live Music</span></h3>
              <h3 style="position: relative;">7:00 pm - 12:00 am </h3>

            </div>
          </div>

      </div>

      <hr style="color: white; margin: 20px;">

      <div class="inner3" style="color: white; text-align: center; word-spacing: 5px; line-height: 30px;">
        <h3>Seating Capacity: 90 Guests</h3>
        <h3>Private Rooms and Bar Available</h3>
        <h3>Live Music on WeekEnd</h3>
        <h3>Home Delivery Services Available</h3>
        <h3>You can get a reservation</h3>
      </div>

</div>


@endsection

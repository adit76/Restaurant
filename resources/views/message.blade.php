@extends('layout.master')

@section('title','Message Sent | Restro')

@section('main')

<div class="order_msg">

@if(Session::has('send_msg'))
  <div class="initial_hidden">
    <h1>Message Successfully Sent.</h1>
    <h3>We will get to it as soon as we can.</h3>
    <hr/>
    <p>Also, You Can Contact At <a href="tel:+977-98000000">+977-98000000</a> For More Details</p>
    <p>Connect With Us:</p>
    <b>Facebook</b>
    -
    <b>Instagram</b>
  </div>
@else
  <div class="initial_hidden">
    <h1>Message Could Not be Sent.</h1>
    <hr/>
    <p>Try Contacting <a href="tel:+977-98000000">+977-98000000</a> For More Details</p>
    <p>Connect With Us:</p>
    <b>Facebook</b>
    -
    <b>Instagram</b>
  </div>
@endif

</div>

<style>
  .order_msg{
    margin: 0 10%;
    background: #EDEDED;
    padding: 50px 30px 80px 30px;
  }

  .order_msg p{
    padding: 10px 0;
  }
</style>

@endsection

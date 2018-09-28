<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class ReservationController extends Controller
{
	
  public function index(Request $request){
	$this -> validate(
      $request,
      [
        'date'=>'required',
        'name'=>'required',
        'seats'=>'required'
      ]
    );
	
	$data = [];
	
	$data['date'] = $request->input('date');
    $data['time'] = $request->get('time');
    $data['name'] = $request->input('name');
    $data['seats'] = $request->input('seats');
	
	return view('reservation.reservation', $data);
  }
	
  public function reservationConfirm(Request $request){
    $this -> validate(
      $request,
      [
        'date'=>'required',
        'name'=>'required',
        'seats'=>'required',
        'seat_id'=>'required',
      ]
    );

    $data = [];
    //echo $request->input('items');
    if(Auth::user()){
      $data['user_id'] = Auth::user()->id;
    }

    $data['date'] = date('Y-m-d', strtotime($request->input('date')));
    $data['time'] = $request->get('time');
    $data['name'] = $request->input('name');
    $data['seats'] = $request->input('seats');
    $data['seat_id'] = $request->input('seat_id');
    //json_decode($request->input('items'))

	$checkReserved = DB::select('SELECT * FROM reservations WHERE status = "1" AND seat_id = "' . $data['seat_id'] . '" AND date = "' . $data['date'] . '" AND time = "' . $data['time'] . '"');
	if($checkReserved == [] ){
		DB::table('reservations')->insert($data);
		Session::flash('reservation_msg', "success");
		Session::flash('reservation_name', $data['name']);
		return view('reservation.reservation');
	}else{
		Session::flash('reservation_msg_not', "Similar Reservation Has Been Already Taken, Try Another Seat.");
		return redirect()->back();
		return;
	}
  }
}

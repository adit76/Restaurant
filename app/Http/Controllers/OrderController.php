<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class OrderController extends Controller
{
  public function index(){
    if(Auth::check()){
      return view('order.order');
    }else{
      return redirect()->route('register');
    }
  }

  public function orderConfirm(Request $request){
    if($request->isMethod('post')){
      $this -> validate(
        $request,
        [
          'items'=>'required'
        ]
      );

      $data = [];
      //echo $request->input('items');
      $data['user_id'] = Auth::user()->id;
      $data['items'] = $request->input('items');
      //json_decode($request->input('items'))

      DB::table('orders')->insert($data);
      Session::flash('message', "success");
      return view('order.order');
    }else{
      return redirect()->route('menu');
    }

    //return $request->all();
  }

  public function view(){
	if(Auth::user()){
		$all_orders = DB::table('orders')->join('users', 'users.id', '=', 'orders.user_id')->join('delivery_boy', 'orders.delivery_boy', '=', 'delivery_boy.id')->select('orders.id', 'items', 'first_name','last_name','contact','users.address','city','street','delivery_boy','name','status')->where('users.id',Auth::user()->id)->orderBy('status','asc')->get();
		
		$all_reservations = DB::table('reservations')->where('status','1')->where('user_id',Auth::user()->id)->get();
		
		return view('order.view', ['all_orders' => $all_orders, 'all_reservations' => $all_reservations]);		
	}else{
		return redirect()->route('menu');
	}
  }
}




















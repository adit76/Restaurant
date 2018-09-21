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
	/* $available_rooms = DB::table('orders as o')
                            ->select('o.items', 'o.status')
                            ->whereRaw("user_id = " . Auth::user()->id)
                            ->get();
	return $available_rooms; */
	if(Auth::user()){
		$allOrders = DB::select('SELECT items, status FROM orders WHERE user_id = ' . Auth::user()->id);
		//return array($allOrders);
		#//Session::flash('allOrders', $allOrders);
		//return view('order.view')->with('allOrders',$allOrders);
		return view('order.view', compact('allOrders'));
	}else{
		return redirect()->route('menu');
	}
  }
}




















<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;

class AdminController extends Controller
{
	
	public static function check(){
		//Check if logged in
		if(session('admin') == 'true') {
			return true;
			//return redirect()->route('dashboard');
		}
	}
	
    public function index(){
		if(AdminController::check()){
			return redirect()->route('dashboard');
		} //Check if logged in
		
		if(session('admin') == 'true') {
			return redirect()->route('dashboard');
		}
		if(Auth::user()){
			return redirect('index');
		}
		return view('admin.admin');
	}
	
	public function logout(){
		session()->flush();
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		else{
			return redirect()->route('admin_index');
		}
	}
	
	public function login(Request $request){
		if(AdminController::check()){
			return redirect()->route('dashboard');
		} //Check if logged in
		
		if($request->isMethod('post')){
		  $this -> validate(
			$request,
			[
			  'username'=>'required',
			  'password'=>'required'
			]
		  );

		  $data = [];
		  $data['username'] = $request->input('username');
		  $data['password'] = $request->input('password');
		  
		  $admin_data = DB::table('admin')->where('username', $data['username'])->first();
		  
		  //return Hash::check($data['password'], $admin_data->password) ? 't':'f';
		
		  if(DB::table('admin')->where('username', $data['username'])->first() && Hash::check($data['password'], $admin_data->password)){
			session(['admin' => 'true']);
			return redirect()->route('dashboard');
		  }else{
			echo "ERROR, No Username";
		  }
		}else{
		  return redirect('index');
		}
	}
	
	public function dashboard(){
		//session()->flush();
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		$all_orders = DB::table('orders')->join('users', 'users.id', '=', 'orders.user_id')->select('orders.id', 'items', 'first_name','last_name','contact','address','city','street','delivery_boy','status')->where('status','1')->orWhere('status','2')->orWhere('status','3')->get();
		
		$delivery_boy = DB::table('delivery_boy')->get();
		//return $all_orders;
		return view('admin.dashboard', ['all_orders' => $all_orders, 'delivery_boy' => $delivery_boy]);
	}
	
	public function update_status(){
		//$id = $request->id;
		//$value = $request->value;
		$id = $_GET['id'];
		$value = $_GET['value'];
		DB::table('orders')
            ->where('id', $id)
            ->update(['status' => $value]);
		/* $orderdata = DB::table('orders')->find($id);
		$orderdata->status = $value;
		$orderdata->save();
		 */
		return 'OK';
	}
	
	public function update_delivery_boy(){
		$id = $_GET['id'];
		$value = $_GET['value'];
		DB::table('orders')
            ->where('id', $id)
            ->update(['delivery_boy' => $value]);
		return 'OK';
	}
}

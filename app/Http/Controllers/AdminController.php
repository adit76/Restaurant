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
	
	public function orders_old(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		$all_orders_old = DB::table('orders')->join('users', 'users.id', '=', 'orders.user_id')->join('delivery_boy', 'orders.delivery_boy', '=', 'delivery_boy.id')->select('orders.id', 'items', 'first_name','last_name','contact','users.address','city','street','delivery_boy','name','status')->where('status','4')->get();
		return view('admin.orders_old', ['all_orders_old' => $all_orders_old]);
	}
	
	public function orders_raw(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		$all_orders_old = DB::table('orders')->join('users', 'users.id', '=', 'orders.user_id')->join('delivery_boy', 'orders.delivery_boy', '=', 'delivery_boy.id')->select('orders.id', 'items', 'first_name','last_name','contact','users.address','city','street','delivery_boy','name','status')->get();
		$all_orders_old = str_replace("&quot;",'"',$all_orders_old);
		$all_orders_old = str_replace('"','',$all_orders_old);
		$all_orders_old = str_replace('\\','',$all_orders_old);
		header('Content-type: application/json');
		echo "<a href='../../dashboard'><- Back</a><br/>";
		echo json_encode($all_orders_old);
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
	
	public function update_reservation_status(){
		$id = $_GET['id'];
		$value = $_GET['value'];
		DB::table('reservations')
            ->where('id', $id)
            ->update(['status' => $value]);
		return 'OK';
	}
	
	/*Users*/
	public function users(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		$all_users = DB::table('users')->get();
		return view('admin.users.users', ['all_users' => $all_users]);
	}
	
	public function users_orders(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_users_orders = DB::table('users')->join('orders', 'users.id', '=', 'orders.user_id')->select(
		'users.id as uid','orders.id as oid', 'first_name','last_name','contact','users.address','city','status')->get();
		return view('admin.users.orders', ['all_users' => $all_users_orders]);
	}
	
	/*Reservations*/
	public function reservations(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_reservations = DB::table('reservations')->where('status','1')->where('date','>=',now())->orderBy('date')->orderBy('time')->get();
		
		//Automatically Status 0 for Old Reservations from past time....if manually not changed....
		DB::table('reservations')
            ->where('status', '1')
			->where('date','<',now())
            ->update(['status' => 0]);
			
		return view('admin.reservations.reservations', ['all_reservations' => $all_reservations]);
	}
	
	public function reservations_old(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_reservations_old = DB::table('reservations')->where('status','0')->orderBy('date')->orderBy('time')->get();
		return view('admin.reservations.reservations_old', ['all_reservations_old' => $all_reservations_old]);
	}
	
	public function messages(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_messages = DB::table('messages')->orderBy('date')->get();
		return view('admin.messages', ['all_messages' => $all_messages]);
	}
	
	public function delivery_boy(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_delivery_boy = DB::table('delivery_boy')->get();
		return view('admin.delivery_boy', ['all_delivery_boy' => $all_delivery_boy]);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use Session;

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
	
	public function orders_id($id){
		//session()->flush();
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		$orders_one = DB::table('orders')->join('users', 'users.id', '=', 'orders.user_id')->select('orders.id', 'items', 'first_name','last_name','contact','address','city','street','delivery_boy','status')->where('orders.id',$id)->get();
		if($orders_one->isEmpty()){
			return redirect()->route('dashboard');
		}
		$delivery_boy = DB::table('delivery_boy')->get();
		//return $all_orders;
		return view('admin.orders_one', ['orders_one' => $orders_one, 'delivery_boy' => $delivery_boy]);
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
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
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
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$id = $_GET['id'];
		$value = $_GET['value'];
		DB::table('orders')
            ->where('id', $id)
            ->update(['delivery_boy' => $value]);
		return 'OK';
	}
	
	public function update_reservation_status(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
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
		if($all_users->isEmpty()){
			return redirect()->back();
		}
		return view('admin.users.users', ['all_users' => $all_users]);
	}
	
	public function users_orders(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_users_orders = DB::table('users')->join('orders', 'users.id', '=', 'orders.user_id')->select(
		'users.id as uid','orders.id as oid', 'first_name','last_name','contact','users.address','city','status')->get();
		if($all_users_orders->isEmpty()){
			return redirect()->back();
		}
		return view('admin.users.orders', ['all_users' => $all_users_orders]);
	}
	
	/*Reservations*/
	public function reservations(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		//Automatically Status 0 for Old Reservations from past time....if manually not changed....
		DB::table('reservations')
            ->where('status', '1')
			->where('date','<',DB::raw('curdate()'))
            ->update(['status' => 0]);
		
		$all_reservations = DB::table('reservations')->where('status','1')->where('date','>=',DB::raw('curdate()'))->orderBy('date')->orderBy('time')->get();
		return view('admin.reservations.reservations', ['all_reservations' => $all_reservations]);
	}
	
	public function reservations_old(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_reservations_old = DB::table('reservations')->where('status','0')->orderBy('date')->orderBy('time')->get();
		if($all_reservations_old->isEmpty()){
			return redirect()->back();
		}
		return view('admin.reservations.reservations_old', ['all_reservations_old' => $all_reservations_old]);
	}
	
	public function messages(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_messages = DB::table('messages')->orderBy('date')->get();
		if($all_messages->isEmpty()){
			return redirect()->back();
		}
		return view('admin.messages', ['all_messages' => $all_messages]);
	}
	
	public function delivery_boy(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_delivery_boy = DB::table('delivery_boy')->get();
		if($all_delivery_boy->isEmpty()){
			return redirect()->back();
		}
		return view('admin.delivery_boy', ['all_delivery_boy' => $all_delivery_boy]);
	}
	
	public function delivery_boy_detail($id){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$all_delivery_boy_detail = DB::table('delivery_boy')->join('orders', 'delivery_boy.id', '=', 'orders.delivery_boy')->where('delivery_boy.id',$id)->orderBy('orders.status')->orderBy('orders.id','desc')->get();
		if($all_delivery_boy_detail->isEmpty()){
			return redirect()->back();
		}
		return view('admin.delivery_boy_detail', ['all_delivery_boy_detail' => $all_delivery_boy_detail]);
	}
	
	public function delivery_boy_new(Request $request){
		if($request->isMethod('post')){
		  $this -> validate(
			$request,
			[
			  'name'=>'required',
			  'address'=>'required',
			  'phone'=>'required'
			]
		  );

		  $data = [];
		  $data['name'] = $request->input('name');
		  $data['address'] = $request->input('address');
		  $data['phone'] = $request->input('phone');
		  $data['email'] = $request->input('email');

		  DB::table('delivery_boy')->insert($data);
		  Session::flash('message', "success");
		  return redirect()->route('delivery_boy');
		}else{
		  return view('admin.delivery_boy_new');
		}
	}
	
	/* ALBUM */
	public function album(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$album = DB::table('album')->where('deleted','0')->get();
		if($album->isEmpty()){
			return redirect()->back();
		}
		return view('admin.album.album', ['album' => $album]);
	}
	
	public function album_custom($id){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$album = DB::table('album')->where('id',$id)->get();
		
		if($album[0]->deleted == '1'){
			return redirect()->route('album');
		}
		
		$photos = DB::table('album')
			->join('photos', 'album.id', '=', 'photos.album_id')
			->select('album.id as aid','photos.id as pid', 'album.name as aname', 'photos.name as pname','date','url')
			->where('album.id',$id)
			->get();
		if($album->isEmpty()){
			return redirect()->route('dashboard');
		}
		return view('admin.album.customize', ['photos' => $photos, 'album' => $album]);
	}
	
	public function remove_photo(){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		$aid = $_GET['aid'];
		$pid = $_GET['pid'];
		DB::table('photos')
            ->where('id', $pid)
            ->update(['album_id' => 0]);
		return 'OK';
	}
	
	public function upload_photo(Request $request){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		$input=$request->all();
		$images=array();
		if($files=$request->file('images')){
			foreach($files as $file){
				$name = time()."_".$file->getClientOriginalName();
				$file->move('images/gallery',$name);
				$images[]=$name;
				DB::table('photos')->insert([
					'name'=>  $name,
					'url' => $name,
					'album_id' => $input['album_id'],
				]);
			}
		}
		
		return redirect()->back();
	}
	
	public function album_delete($id){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		DB::table('album')
            ->where('id', $id)
            ->update(['deleted' => 1]);
		return redirect()->back();
	}
	
	public function new_album(Request $request){
		if(!AdminController::check()){
			return redirect()->route('admin_index');
		} //Check if logged in
		
		if($request->isMethod('post')){
		  $this -> validate(
			$request,
			[
			  'name'=>'required',
			]
		  );
		  
			$data = [];
			$data['name'] = $request->input('name');

			$album_id = DB::table('album')->insertGetId($data);
			
			$input=$request->all();
			$images=array();
			if($files=$request->file('images')){
				foreach($files as $file){
					$name = time()."_".$file->getClientOriginalName();
					$file->move('images/gallery',$name);
					$images[]=$name;
					DB::table('photos')->insert([
						'name'=>  $name,
						'url' => $name,
						'album_id' => $album_id,
					]);
				}
			}
			
			Session::flash('message', "success");
			return redirect()->route('album');
		}else{
		  return view('admin.album.new_album');
		}
	}
}

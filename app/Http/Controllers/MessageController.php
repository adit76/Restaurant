<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class MessageController extends Controller
{
    public function index(Request $request){
      if($request->isMethod('post')){
        $this -> validate(
          $request,
          [
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required',
          ]
        );

        $data = [];
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['message'] = $request->input('message');
        $data['date'] = Now();

        DB::table('messages')->insert($data);
        Session::flash('send_msg', "success");
        return view('message');
      }else{
        return redirect()->route('index');
      }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index(){
		if(Auth::user()){
			return redirect('index');
		}
		return view('admin.admin');
	}
	
	public function login(){
		return "Needed TO Check and Verifiy and Login to ADmin Dashboard - At AdminController.....N�eded to do JSON parse in View ...............";
	}
}

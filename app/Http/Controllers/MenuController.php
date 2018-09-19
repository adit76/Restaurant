<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
    public function menu(){
      return view('menu');
    }

    public function getmenu(){
      $items = DB::select('SELECT i.id, i.name, c.name as category, i.description, i.price, i.special FROM items i JOIN category c ON i.category_id = c.id ORDER BY c.name, i.name');
      return $items;
    }
}

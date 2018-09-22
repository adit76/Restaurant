<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$gallery = DB::table('album')->join('photos', 'album.id', '=', 'photos.album_id')->select('album.id', 'album.name', 'album.date','photos.url')->where('album.deleted','0')->orderBy('album.date','desc')->get()->groupBy('id');

		$i = 0;
		foreach($gallery as $g){
			$g[$i]->date = \Carbon\Carbon::createFromTimeStamp(strtotime($g[$i]->date))->diffForHumans();
			$i = $i + 1;
		}
        return view('index', ['gallery' => $gallery]);
    }
	
	public function gallery($id){
		$photos = DB::table('photos')->where('album_id',$id)->get();
		if($photos->isEmpty()){
			return redirect()->route('index');
		}
		return view('photo_gallery', ['photos' => $photos]);
	}
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Index//
Route::get('/', 'HomeController@index')->name('index');
Route::get('/index', 'HomeController@index')->name('index');

//Gallery
Route::get('/gallery/{id}', 'HomeController@gallery')->name('gallery');


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function(){
  return view('contact');
});

Route::post('/message', 'MessageController@index');
Route::get('/message', function(){
  return redirect('index');
});
//Menu//
Route::get('/menu', 'MenuController@menu')->name('menu');
Route::get('/getmenu', 'MenuController@getmenu')->name('getmenu');

//Order//
Route::get('/order', 'OrderController@index')->name('order');
Route::post('/order', 'OrderController@orderConfirm')->name('order_confirm');
Route::get('/view', 'OrderController@view')->name('view_order');

//Reservation//
Route::get('/reservation', function(){
  return redirect('index');
});

Route::post('/reservation', 'ReservationController@reservationConfirm')->name('reservation_confirm');
Route::get('/reservation', 'ReservationController@index')->name('reservation_index');
// Route::get('/reservation', function(){
//   return view('reservation.reservation');
// });

//logout//
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('back');



//ADMIN ROUTE AND CONTROLLER//
Route::get('/admin', 'AdminController@index')->name('admin_index');
Route::post('/admin', 'AdminController@login')->name('admin_login');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard'); //Has Orders Current
Route::get('/dashboard/logout', 'AdminController@logout')->name('admin_logout');
//|||| Orders ||||//
Route::get('/dashboard/orders/id/{id}', 'AdminController@orders_id')->name('orders_id');
Route::get('/dashboard/orders/old', 'AdminController@orders_old')->name('orders_old');
Route::get('/dashboard/orders/raw', 'AdminController@orders_raw')->name('orders_raw');
//|||| Users ||||//
Route::get('/dashboard/users', 'AdminController@users')->name('users');
Route::get('/dashboard/users/orders', 'AdminController@users_orders')->name('users_orders');
//|||| Reservation ||||//
Route::get('/dashboard/reservations', 'AdminController@reservations')->name('reservations');
Route::get('/dashboard/reservations/old', 'AdminController@reservations_old')->name('reservations_old');
//|||| Messages ||||//
Route::get('/dashboard/messages', 'AdminController@messages')->name('messages');
//|||| Delivery Boy||||//
Route::get('/dashboard/delivery_boy', 'AdminController@delivery_boy')->name('delivery_boy');
Route::get('/dashboard/delivery_boy/{id}', 'AdminController@delivery_boy_detail')->name('delivery_boy_detail');
Route::get('/dashboard/delivery_boy/create/new', 'AdminController@delivery_boy_new')->name('delivery_boy_new');
Route::post('/dashboard/delivery_boy/create/new', 'AdminController@delivery_boy_new')->name('delivery_boy_new_create');
//|||| ALBUM ||||//
Route::get('/dashboard/album', 'AdminController@album')->name('album');
Route::get('/dashboard/album/{id}', 'AdminController@album_custom')->name('album_custom');
Route::get('/dashboard/album/delete/{id}', 'AdminController@album_delete')->name('album_delete');
Route::get('/dashboard/album/new/album', 'AdminController@new_album')->name('new_album');
Route::post('/dashboard/album/new/album', 'AdminController@new_album')->name('new_album_create');
Route::get('remove_photo', 'AdminController@remove_photo')->name('remove_photo');
Route::post('upload_photo', 'AdminController@upload_photo')->name('upload_photo');


//Record Update//
Route::get('update_status', 'AdminController@update_status')->name('update_status');
Route::get('update_delivery_boy', 'AdminController@update_delivery_boy')->name('update_delivery_boy');
Route::get('update_reservation_status', 'AdminController@update_reservation_status')->name('update_reservation_status');








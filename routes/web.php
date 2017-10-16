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


$this->get('/', 'IndexController@index');
Auth::routes();
$this->get('logout', 'Auth\LoginController@logout')->name('logout');


//Application routes - Authenticated
Route::middleware(['auth'])->group(function () {
  //
  //
  $this->get('/user/','UserController@getUser');
  $this->post('/user/update/','UserController@updateUserDetails');
  $this->post('/user/updatepassword/','UserController@updateUserPassword');

});

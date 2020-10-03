<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Create network details for the thing
Route::post('/computers/assign_network_details/{id}', 'ComputerController@assignNetworkDetails' );
Route::patch('/computers/edit_network_details/{id}', 'ComputerController@editNetworkDetails' );
Route::get('/computers/create_system_details/{id}','ComputerController@createSystemDetails' );
Route::post('/computers/assign_system/{id}','ComputerController@assignSystem' );
Route::get('/computers/system_details/{id}', 'ComputerController@showSystem' );
Route::patch('/computers/system_details/{id}', 'ComputerController@updateSystem' );

Route::get('/employees/create/{id}', 'EmployeeController@create');
Route::patch('/employees/{id}', 'EmployeeController@update');

Route::get('/warranties/create/{id}', 'WarrantyController@create');
Route::patch('/warranties/{id}', 'WarrantyController@update');

Route::post('/assignments/{assignment}/peripherals', 'AssignmentController@editPeripherals');

//API Routes
Route::get( '/api/employees/all', 'EmployeeController@apiAll');
Route::get( '/api/employees/available', 'EmployeeController@apiAvailable');
Route::get( '/api/computers/all', 'ComputerController@apiAll');
Route::get( '/api/computers/available', 'ComputerController@apiAvailable');
Route::get( '/api/peripherals/available', 'PeripheralController@apiAvailable');
Route::get( '/api/assignments/{assignment}/peripherals', 'AssignmentController@showPeripherals');

//Create CRUD routes. Refer to Laravel 7 docs for more info. Keyword: Resource Controller
Route::resources(
	[
		'components' => 'ComponentController',
		'warranties' => 'WarrantyController',
		'employees' => 'EmployeeController',
		'computers' => 'ComputerController',
		'peripherals' => 'PeripheralController',
		'assignments' => 'AssignmentController',
	]
);

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@profile');
Route::put('/profile/{id}/updateProfile', 'ProfileController@updateProfile');
Route::put('/profile/{id}/changePassword', 'ProfileController@changePassword');


Route::resource('/user', 'UserController'); 

Route::get('/user/{id}/confirmDelete', 'UserController@confirmDelete');
Route::get('/user/{id}/restablecerpass', 'UserController@restablecerpass');


Route::resource('/horario', 'HorarioController');
Route::get('/horario/{id}/confirmDelete', 'HorarioController@confirmDelete');
Route::get('/horario/{id}/registrarHorario', 'HorarioController@registrarHorario');


Route::resource('/teachers', 'TeacherController');
Route::get('/teachers/{id}/confirmDelete', 'TeacherController@confirmDelete');
Route::get('/teachers/{id}/marcarSalida', 'TeacherController@marcarSalida');

Route::resource('/administrative', 'AdministrativeController');
Route::get('/administrative/{id}/confirmDelete', 'AdministrativeController@confirmDelete');
Route::get('/administrative/{id}/marcarSalida', 'AdministrativeController@marcarSalida');

Route::resource('/visitors', 'VisitorController');
Route::get('/visitors/{id}/confirmDelete', 'VisitorController@confirmDelete');
Route::get('/visitors/{id}/marcarSalida', 'VisitorController@marcarSalida');
Route::get('/visitors/{id}/historialVisitantes', 'VisitorController@historialVisitantes');

Route::resource('/vehicles', 'VehicleController');
Route::get('/vehicles/{id}/confirmDelete', 'VehicleController@confirmDelete');
Route::get('/vehicles/{id}/marcarSalida', 'VehicleController@marcarSalida');

Route::resource('/incidents', 'IncidentController');
Route::get('/incidents/{id}/confirmDelete', 'IncidentController@confirmDelete');

Route::resource('/borrowings', 'BorrowingController');
Route::get('/borrowings/{id}/confirmDelete', 'BorrowingController@confirmDelete');
Route::get('/borrowings/{id}/devolucion', 'BorrowingController@devolucion');

Route::resource('/supports', 'SupportController');
Route::get('/supports/{id}/confirmDelete', 'SupportController@confirmDelete');
Route::get('/supports/{id}/retorno', 'SupportController@retorno');

Route::resource('/attendance', 'AttendanceController');

Route::resource('/offices', 'OfficeController');
Route::get('/offices/{id}/confirmDelete', 'OfficeController@confirmDelete');
Route::get('/offices/{id}/historialOficinas', 'OfficeController@historialOficinas');

Route::get('/creditos', function () {
    return view('creditos.index');
});

Route::post('/home/visitors', 'HomeController@visitors');
Route::get('/home/visitorsLastYear', 'HomeController@visitorsLastYear'); //En prueba

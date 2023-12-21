<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('index/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('index/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for CambioFechas Controller */
	Route::get('cambiofechas', 'CambioFechasController@index')->name('cambiofechas.index');
	Route::get('cambiofechas/index/{filter?}/{filtervalue?}', 'CambioFechasController@index')->name('cambiofechas.index');	
	Route::get('cambiofechas/add', 'CambioFechasController@add')->name('cambiofechas.add');
	Route::post('cambiofechas/add', 'CambioFechasController@store')->name('cambiofechas.store');
		
	Route::any('cambiofechas/edit/{rec_id}', 'CambioFechasController@edit')->name('cambiofechas.edit');

/* routes for Clientes Controller */
	Route::get('clientes', 'ClientesController@index')->name('clientes.index');
	Route::get('clientes/index/{filter?}/{filtervalue?}', 'ClientesController@index')->name('clientes.index');	
	Route::get('clientes/view/{rec_id}', 'ClientesController@view')->name('clientes.view');	
	Route::get('clientes/add', 'ClientesController@add')->name('clientes.add');
	Route::post('clientes/add', 'ClientesController@store')->name('clientes.store');
		
	Route::any('clientes/edit/{rec_id}', 'ClientesController@edit')->name('clientes.edit');

/* routes for Ejercicios Controller */
	Route::get('ejercicios', 'EjerciciosController@index')->name('ejercicios.index');
	Route::get('ejercicios/index/{filter?}/{filtervalue?}', 'EjerciciosController@index')->name('ejercicios.index');	
	Route::get('ejercicios/view/{rec_id}', 'EjerciciosController@view')->name('ejercicios.view');	
	Route::get('ejercicios/add', 'EjerciciosController@add')->name('ejercicios.add');
	Route::post('ejercicios/add', 'EjerciciosController@store')->name('ejercicios.store');
		
	Route::any('ejercicios/edit/{rec_id}', 'EjerciciosController@edit')->name('ejercicios.edit');

/* routes for EjerciciosRutinas Controller */
	Route::get('ejerciciosrutinas', 'EjerciciosRutinasController@index')->name('ejerciciosrutinas.index');
	Route::get('ejerciciosrutinas/index/{filter?}/{filtervalue?}', 'EjerciciosRutinasController@index')->name('ejerciciosrutinas.index');	
	Route::get('ejerciciosrutinas/view/{rec_id}', 'EjerciciosRutinasController@view')->name('ejerciciosrutinas.view');	
	Route::get('ejerciciosrutinas/add', 'EjerciciosRutinasController@add')->name('ejerciciosrutinas.add');
	Route::post('ejerciciosrutinas/add', 'EjerciciosRutinasController@store')->name('ejerciciosrutinas.store');
		
	Route::any('ejerciciosrutinas/edit/{rec_id}', 'EjerciciosRutinasController@edit')->name('ejerciciosrutinas.edit');

/* routes for Estados Controller */
	Route::get('estados', 'EstadosController@index')->name('estados.index');
	Route::get('estados/index/{filter?}/{filtervalue?}', 'EstadosController@index')->name('estados.index');	
	Route::get('estados/view/{rec_id}', 'EstadosController@view')->name('estados.view');	
	Route::get('estados/add', 'EstadosController@add')->name('estados.add');
	Route::post('estados/add', 'EstadosController@store')->name('estados.store');
		
	Route::any('estados/edit/{rec_id}', 'EstadosController@edit')->name('estados.edit');

/* routes for HorarioClientes Controller */
	Route::get('horarioclientes', 'HorarioClientesController@index')->name('horarioclientes.index');
	Route::get('horarioclientes/index/{filter?}/{filtervalue?}', 'HorarioClientesController@index')->name('horarioclientes.index');	
	Route::get('horarioclientes/view/{rec_id}', 'HorarioClientesController@view')->name('horarioclientes.view');	
	Route::get('horarioclientes/add', 'HorarioClientesController@add')->name('horarioclientes.add');
	Route::post('horarioclientes/add', 'HorarioClientesController@store')->name('horarioclientes.store');
		
	Route::any('horarioclientes/edit/{rec_id}', 'HorarioClientesController@edit')->name('horarioclientes.edit');

/* routes for Horarios Controller */
	Route::get('horarios', 'HorariosController@index')->name('horarios.index');
	Route::get('horarios/index/{filter?}/{filtervalue?}', 'HorariosController@index')->name('horarios.index');	
	Route::get('horarios/view/{rec_id}', 'HorariosController@view')->name('horarios.view');	
	Route::get('horarios/add', 'HorariosController@add')->name('horarios.add');
	Route::post('horarios/add', 'HorariosController@store')->name('horarios.store');
		
	Route::any('horarios/edit/{rec_id}', 'HorariosController@edit')->name('horarios.edit');

/* routes for Planes Controller */
	Route::get('planes', 'PlanesController@index')->name('planes.index');
	Route::get('planes/index/{filter?}/{filtervalue?}', 'PlanesController@index')->name('planes.index');	
	Route::get('planes/view/{rec_id}', 'PlanesController@view')->name('planes.view');	
	Route::get('planes/add', 'PlanesController@add')->name('planes.add');
	Route::post('planes/add', 'PlanesController@store')->name('planes.store');
		
	Route::any('planes/edit/{rec_id}', 'PlanesController@edit')->name('planes.edit');

/* routes for Programas Controller */
	Route::get('programas', 'ProgramasController@index')->name('programas.index');
	Route::get('programas/index/{filter?}/{filtervalue?}', 'ProgramasController@index')->name('programas.index');	
	Route::get('programas/view/{rec_id}', 'ProgramasController@view')->name('programas.view');	
	Route::get('programas/add', 'ProgramasController@add')->name('programas.add');
	Route::post('programas/add', 'ProgramasController@store')->name('programas.store');
		
	Route::any('programas/edit/{rec_id}', 'ProgramasController@edit')->name('programas.edit');

/* routes for Roles Controller */
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');

/* routes for Rutinas Controller */
	Route::get('rutinas', 'RutinasController@index')->name('rutinas.index');
	Route::get('rutinas/index/{filter?}/{filtervalue?}', 'RutinasController@index')->name('rutinas.index');	
	Route::get('rutinas/view/{rec_id}', 'RutinasController@view')->name('rutinas.view');	
	Route::get('rutinas/add', 'RutinasController@add')->name('rutinas.add');
	Route::post('rutinas/add', 'RutinasController@store')->name('rutinas.store');
		
	Route::any('rutinas/edit/{rec_id}', 'RutinasController@edit')->name('rutinas.edit');

/* routes for Suscripciones Controller */
	Route::get('suscripciones', 'SuscripcionesController@index')->name('suscripciones.index');
	Route::get('suscripciones/index/{filter?}/{filtervalue?}', 'SuscripcionesController@index')->name('suscripciones.index');	
	Route::get('suscripciones/view/{rec_id}', 'SuscripcionesController@view')->name('suscripciones.view');	
	Route::get('suscripciones/add', 'SuscripcionesController@add')->name('suscripciones.add');
	Route::post('suscripciones/add', 'SuscripcionesController@store')->name('suscripciones.store');
		
	Route::any('suscripciones/edit/{rec_id}', 'SuscripcionesController@edit')->name('suscripciones.edit');

/* routes for Tipos Controller */
	Route::get('tipos', 'TiposController@index')->name('tipos.index');
	Route::get('tipos/index/{filter?}/{filtervalue?}', 'TiposController@index')->name('tipos.index');	
	Route::get('tipos/view/{rec_id}', 'TiposController@view')->name('tipos.view');	
	Route::get('tipos/add', 'TiposController@add')->name('tipos.add');
	Route::post('tipos/add', 'TiposController@store')->name('tipos.store');
		
	Route::any('tipos/edit/{rec_id}', 'TiposController@edit')->name('tipos.edit');

/* routes for Usuarios Controller */
	Route::get('usuarios', 'UsuariosController@index')->name('usuarios.index');
	Route::get('usuarios/index/{filter?}/{filtervalue?}', 'UsuariosController@index')->name('usuarios.index');	
	Route::get('usuarios/view/{rec_id}', 'UsuariosController@view')->name('usuarios.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('usuarios/add', 'UsuariosController@add')->name('usuarios.add');
	Route::post('usuarios/add', 'UsuariosController@store')->name('usuarios.store');
		
	Route::any('usuarios/edit/{rec_id}', 'UsuariosController@edit')->name('usuarios.edit');

/* routes for Valores Controller */
	Route::get('valores', 'ValoresController@index')->name('valores.index');
	Route::get('valores/index/{filter?}/{filtervalue?}', 'ValoresController@index')->name('valores.index');	
	Route::get('valores/view/{rec_id}', 'ValoresController@view')->name('valores.view');	
	Route::get('valores/add', 'ValoresController@add')->name('valores.add');
	Route::post('valores/add', 'ValoresController@store')->name('valores.store');
		
	Route::any('valores/edit/{rec_id}', 'ValoresController@edit')->name('valores.edit');
});


	
Route::get('componentsdata/id_suscripcion_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_suscripcion_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_tipo_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_tipo_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_rutina_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_rutina_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/repeticiones_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->repeticiones_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_horario_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_horario_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_ciente_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_ciente_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_plan_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_plan_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_valor_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_valor_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_estado_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_estado_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/usuarios_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->usuarios_email_value_exist($request);
	}
);
	
Route::get('componentsdata/usuarios_user_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->usuarios_user_value_exist($request);
	}
);
	
Route::get('componentsdata/getcount_clientes',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_clientes($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_horarios',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_horarios($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_planes',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_planes($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');
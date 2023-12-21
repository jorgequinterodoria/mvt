
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Inicio", 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'horarioclientes',
			'label' => "Horario Clientes", 
			'icon' => '<i class="material-icons ">schedule</i>'
		],
		
		[
			'path' => '',
			'label' => "Configuración", 
			'icon' => '<i class="material-icons ">settings</i>','submenu' => [
		[
			'path' => 'cambiofechas',
			'label' => "Cambio Fechas", 
			'icon' => ''
		],
		
		[
			'path' => 'clientes',
			'label' => "Clientes", 
			'icon' => ''
		],
		
		[
			'path' => 'ejercicios',
			'label' => "Ejercicios", 
			'icon' => ''
		],
		
		[
			'path' => 'ejerciciosrutinas',
			'label' => "Ejercicios-Rutinas", 
			'icon' => ''
		],
		
		[
			'path' => 'estados',
			'label' => "Estados-Suscripción", 
			'icon' => ''
		],
		
		[
			'path' => 'horarios',
			'label' => "Horarios", 
			'icon' => ''
		],
		
		[
			'path' => 'planes',
			'label' => "Planes", 
			'icon' => ''
		],
		
		[
			'path' => 'programas',
			'label' => "Programas", 
			'icon' => ''
		],
		
		[
			'path' => 'roles',
			'label' => "Roles", 
			'icon' => ''
		],
		
		[
			'path' => 'rutinas',
			'label' => "Rutinas", 
			'icon' => ''
		],
		
		[
			'path' => 'suscripciones',
			'label' => "Suscripciones", 
			'icon' => ''
		],
		
		[
			'path' => 'tipos',
			'label' => "Tipos de Ejercicio", 
			'icon' => ''
		],
		
		[
			'path' => 'usuarios',
			'label' => "Usuarios", 
			'icon' => ''
		],
		
		[
			'path' => 'valores',
			'label' => "Valores de Planes", 
			'icon' => ''
		]
	]
		]
	] ;
	}
	
	public static function navbartopright(){
		return [
		[
			'path' => 'home',
			'label' => "Inicio", 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'horarioclientes',
			'label' => "Horario Clientes", 
			'icon' => '<i class="material-icons ">home</i>'
		]
	] ;
	}
	
		
	}

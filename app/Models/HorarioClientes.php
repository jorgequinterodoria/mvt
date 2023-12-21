<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HorarioClientes extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'horario_clientes';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'id_cliente','id_horario'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				horario_clientes.id LIKE ?  OR 
				clientes.id LIKE ?  OR 
				clientes.nombre LIKE ?  OR 
				clientes.correo LIKE ?  OR 
				clientes.celular LIKE ?  OR 
				clientes.eps LIKE ?  OR 
				clientes.telefono LIKE ?  OR 
				clientes.foto LIKE ?  OR 
				horarios.id LIKE ?  OR 
				horarios.horario LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"horario_clientes.id AS id",
			"horario_clientes.id_cliente AS id_cliente",
			"clientes.id AS clientes_id",
			"clientes.nombre AS clientes_nombre",
			"horarios.id AS horarios_id",
			"horarios.horario AS horarios_horario" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"horario_clientes.id AS id",
			"horario_clientes.id_cliente AS id_cliente",
			"clientes.id AS clientes_id",
			"clientes.nombre AS clientes_nombre",
			"horarios.id AS horarios_id",
			"horarios.horario AS horarios_horario" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"horario_clientes.id AS id",
			"horario_clientes.id_cliente AS id_cliente",
			"horario_clientes.id_horario AS id_horario",
			"clientes.id AS clientes_id",
			"clientes.nombre AS clientes_nombre",
			"clientes.edad AS clientes_edad",
			"clientes.imc AS clientes_imc",
			"clientes.correo AS clientes_correo",
			"clientes.celular AS clientes_celular",
			"clientes.eps AS clientes_eps",
			"clientes.telefono AS clientes_telefono",
			"clientes.foto AS clientes_foto",
			"horarios.id AS horarios_id",
			"horarios.horario AS horarios_horario" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"horario_clientes.id AS id",
			"horario_clientes.id_cliente AS id_cliente",
			"horario_clientes.id_horario AS id_horario",
			"clientes.id AS clientes_id",
			"clientes.nombre AS clientes_nombre",
			"clientes.edad AS clientes_edad",
			"clientes.imc AS clientes_imc",
			"clientes.correo AS clientes_correo",
			"clientes.celular AS clientes_celular",
			"clientes.eps AS clientes_eps",
			"clientes.telefono AS clientes_telefono",
			"clientes.foto AS clientes_foto",
			"horarios.id AS horarios_id",
			"horarios.horario AS horarios_horario" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_horario",
			"id" 
		];
	}
}

<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CambioFechas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'cambio_fechas';
	

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
		'id_suscripcion','nueva_fecha_inicio','nueva_fecha_fin','motivo'
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
				cambio_fechas.id LIKE ?  OR 
				clientes.nombre LIKE ?  OR 
				clientes.foto LIKE ?  OR 
				cambio_fechas.motivo LIKE ?  OR 
				estados.estado LIKE ?  OR 
				suscripciones.id LIKE ?  OR 
				clientes.id LIKE ?  OR 
				clientes.correo LIKE ?  OR 
				clientes.celular LIKE ?  OR 
				clientes.eps LIKE ?  OR 
				clientes.telefono LIKE ?  OR 
				estados.id LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"cambio_fechas.id AS id",
			"clientes.nombre AS clientes_nombre",
			"clientes.foto AS clientes_foto",
			"cambio_fechas.nueva_fecha_inicio AS nueva_fecha_inicio",
			"cambio_fechas.nueva_fecha_fin AS nueva_fecha_fin",
			"cambio_fechas.motivo AS motivo",
			"estados.estado AS estados_estado",
			"suscripciones.id AS suscripciones_id",
			"clientes.id AS clientes_id",
			"estados.id AS estados_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"cambio_fechas.id AS id",
			"clientes.nombre AS clientes_nombre",
			"clientes.foto AS clientes_foto",
			"cambio_fechas.nueva_fecha_inicio AS nueva_fecha_inicio",
			"cambio_fechas.nueva_fecha_fin AS nueva_fecha_fin",
			"cambio_fechas.motivo AS motivo",
			"estados.estado AS estados_estado",
			"suscripciones.id AS suscripciones_id",
			"clientes.id AS clientes_id",
			"estados.id AS estados_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_suscripcion",
			"nueva_fecha_inicio",
			"nueva_fecha_fin",
			"motivo",
			"id" 
		];
	}
}

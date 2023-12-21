<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Clientes extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'clientes';
	

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
		'nombre','edad','imc','correo','celular','eps','telefono','foto'
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
				id LIKE ?  OR 
				nombre LIKE ?  OR 
				correo LIKE ?  OR 
				celular LIKE ?  OR 
				eps LIKE ?  OR 
				telefono LIKE ?  OR 
				foto LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"id",
			"nombre",
			"edad",
			"imc",
			"correo",
			"celular",
			"eps",
			"telefono",
			"foto" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"nombre",
			"edad",
			"imc",
			"correo",
			"celular",
			"eps",
			"telefono",
			"foto" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"nombre",
			"edad",
			"imc",
			"correo",
			"celular",
			"eps",
			"telefono",
			"foto" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"nombre",
			"edad",
			"imc",
			"correo",
			"celular",
			"eps",
			"telefono",
			"foto" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nombre",
			"edad",
			"imc",
			"correo",
			"celular",
			"eps",
			"telefono",
			"foto",
			"id" 
		];
	}
}

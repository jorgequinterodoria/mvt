<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * id_suscripcion_option_list Model Action
     * @return array
     */
	function id_suscripcion_option_list(){
		$sqltext = "SELECT  DISTINCT s.id AS value,c.nombre AS label FROM suscripciones s, clientes c where s.id_ciente = c.id";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_tipo_option_list Model Action
     * @return array
     */
	function id_tipo_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,tipo AS label FROM tipos ORDER BY tipo";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_rutina_option_list Model Action
     * @return array
     */
	function id_rutina_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,rutina AS label FROM rutinas";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * repeticiones_option_list Model Action
     * @return array
     */
	function repeticiones_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nombre AS label FROM ejercicios ORDER BY nombre";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_horario_option_list Model Action
     * @return array
     */
	function id_horario_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,horario AS label FROM horarios ORDER BY horario";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_ciente_option_list Model Action
     * @return array
     */
	function id_ciente_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nombre AS label FROM clientes ORDER BY nombre";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_plan_option_list Model Action
     * @return array
     */
	function id_plan_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,plan AS label FROM planes ORDER BY plan";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_valor_option_list Model Action
     * @return array
     */
	function id_valor_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,valor AS label FROM valores ORDER BY id";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_estado_option_list Model Action
     * @return array
     */
	function id_estado_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,estado AS label FROM estados ORDER BY estado";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Usuarios table
	 * @param string $value
     * @return bool
     */
	function usuarios_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('usuarios')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Usuarios table
	 * @param string $value
     * @return bool
     */
	function usuarios_user_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('usuarios')->where('user', $value)->value('user');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * getcount_clientes Model Action
     * @return int
     */
	function getcount_clientes(){
		$sqltext = "SELECT COUNT(*) AS num FROM clientes";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_horarios Model Action
     * @return int
     */
	function getcount_horarios(){
		$sqltext = "SELECT COUNT(*) AS num FROM horarios";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_planes Model Action
     * @return int
     */
	function getcount_planes(){
		$sqltext = "SELECT COUNT(*) AS num FROM planes";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
}

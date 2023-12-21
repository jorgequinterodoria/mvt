<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CambioFechasAddRequest;
use App\Http\Requests\CambioFechasEditRequest;
use App\Models\CambioFechas;
use Illuminate\Http\Request;
use Exception;
class CambioFechasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.cambiofechas.list";
		$query = CambioFechas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			CambioFechas::search($query, $search); // search table records
		}
		$query->join("suscripciones", "cambio_fechas.id_suscripcion", "=", "suscripciones.id");
		$query->join("clientes", "suscripciones.id_ciente", "=", "clientes.id");
		$query->join("estados", "suscripciones.id_estado", "=", "estados.id");
		$orderby = $request->orderby ?? "cambio_fechas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, CambioFechas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.cambiofechas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(CambioFechasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save CambioFechas record
		$record = CambioFechas::create($modeldata);
		$rec_id = $record->id;
		$this->afterAdd($record);
		return $this->redirect("cambiofechas", "Guardado exitosamente");
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
    private function afterAdd($record){
    }
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(CambioFechasEditRequest $request, $rec_id = null){
		$query = CambioFechas::query();
		$record = $query->findOrFail($rec_id, CambioFechas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("cambiofechas", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.cambiofechas.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuscripcionesAddRequest;
use App\Http\Requests\SuscripcionesEditRequest;
use App\Models\Suscripciones;
use Illuminate\Http\Request;
use Exception;
class SuscripcionesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.suscripciones.list";
		$query = Suscripciones::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Suscripciones::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "suscripciones.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Suscripciones::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Suscripciones::query();
		$record = $query->findOrFail($rec_id, Suscripciones::viewFields());
		return $this->renderView("pages.suscripciones.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.suscripciones.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(SuscripcionesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Suscripciones record
		$record = Suscripciones::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("suscripciones", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(SuscripcionesEditRequest $request, $rec_id = null){
		$query = Suscripciones::query();
		$record = $query->findOrFail($rec_id, Suscripciones::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("suscripciones", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.suscripciones.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

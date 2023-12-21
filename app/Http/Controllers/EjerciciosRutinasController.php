<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EjerciciosRutinasAddRequest;
use App\Http\Requests\EjerciciosRutinasEditRequest;
use App\Models\EjerciciosRutinas;
use Illuminate\Http\Request;
use Exception;
class EjerciciosRutinasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ejerciciosrutinas.list";
		$query = EjerciciosRutinas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EjerciciosRutinas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "ejercicios_rutinas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, EjerciciosRutinas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = EjerciciosRutinas::query();
		$record = $query->findOrFail($rec_id, EjerciciosRutinas::viewFields());
		return $this->renderView("pages.ejerciciosrutinas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.ejerciciosrutinas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(EjerciciosRutinasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save EjerciciosRutinas record
		$record = EjerciciosRutinas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ejerciciosrutinas", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(EjerciciosRutinasEditRequest $request, $rec_id = null){
		$query = EjerciciosRutinas::query();
		$record = $query->findOrFail($rec_id, EjerciciosRutinas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("ejerciciosrutinas", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.ejerciciosrutinas.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

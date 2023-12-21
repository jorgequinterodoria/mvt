<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RutinasAddRequest;
use App\Http\Requests\RutinasEditRequest;
use App\Models\Rutinas;
use Illuminate\Http\Request;
use Exception;
class RutinasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.rutinas.list";
		$query = Rutinas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Rutinas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "rutinas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Rutinas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Rutinas::query();
		$record = $query->findOrFail($rec_id, Rutinas::viewFields());
		return $this->renderView("pages.rutinas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.rutinas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(RutinasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Rutinas record
		$record = Rutinas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("rutinas", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(RutinasEditRequest $request, $rec_id = null){
		$query = Rutinas::query();
		$record = $query->findOrFail($rec_id, Rutinas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("rutinas", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.rutinas.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EjerciciosAddRequest;
use App\Http\Requests\EjerciciosEditRequest;
use App\Models\Ejercicios;
use Illuminate\Http\Request;
use Exception;
class EjerciciosController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ejercicios.list";
		$query = Ejercicios::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ejercicios::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "ejercicios.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ejercicios::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Ejercicios::query();
		$record = $query->findOrFail($rec_id, Ejercicios::viewFields());
		return $this->renderView("pages.ejercicios.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.ejercicios.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(EjerciciosAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Ejercicios record
		$record = Ejercicios::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ejercicios", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(EjerciciosEditRequest $request, $rec_id = null){
		$query = Ejercicios::query();
		$record = $query->findOrFail($rec_id, Ejercicios::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("ejercicios", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.ejercicios.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

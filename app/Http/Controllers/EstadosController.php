<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadosAddRequest;
use App\Http\Requests\EstadosEditRequest;
use App\Models\Estados;
use Illuminate\Http\Request;
use Exception;
class EstadosController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estados.list";
		$query = Estados::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Estados::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estados.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Estados::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Estados::query();
		$record = $query->findOrFail($rec_id, Estados::viewFields());
		return $this->renderView("pages.estados.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.estados.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(EstadosAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Estados record
		$record = Estados::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("estados", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(EstadosEditRequest $request, $rec_id = null){
		$query = Estados::query();
		$record = $query->findOrFail($rec_id, Estados::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("estados", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.estados.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

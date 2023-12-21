<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramasAddRequest;
use App\Http\Requests\ProgramasEditRequest;
use App\Models\Programas;
use Illuminate\Http\Request;
use Exception;
class ProgramasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.programas.list";
		$query = Programas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Programas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "programas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Programas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Programas::query();
		$record = $query->findOrFail($rec_id, Programas::viewFields());
		return $this->renderView("pages.programas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.programas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ProgramasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Programas record
		$record = Programas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("programas", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProgramasEditRequest $request, $rec_id = null){
		$query = Programas::query();
		$record = $query->findOrFail($rec_id, Programas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("programas", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.programas.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

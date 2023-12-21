<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TiposAddRequest;
use App\Http\Requests\TiposEditRequest;
use App\Models\Tipos;
use Illuminate\Http\Request;
use Exception;
class TiposController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.tipos.list";
		$query = Tipos::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Tipos::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "tipos.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Tipos::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Tipos::query();
		$record = $query->findOrFail($rec_id, Tipos::viewFields());
		return $this->renderView("pages.tipos.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.tipos.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(TiposAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Tipos record
		$record = Tipos::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("tipos", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TiposEditRequest $request, $rec_id = null){
		$query = Tipos::query();
		$record = $query->findOrFail($rec_id, Tipos::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("tipos", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.tipos.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

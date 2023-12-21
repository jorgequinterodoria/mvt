<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValoresAddRequest;
use App\Http\Requests\ValoresEditRequest;
use App\Models\Valores;
use Illuminate\Http\Request;
use Exception;
class ValoresController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.valores.list";
		$query = Valores::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Valores::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "valores.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Valores::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Valores::query();
		$record = $query->findOrFail($rec_id, Valores::viewFields());
		return $this->renderView("pages.valores.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.valores.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ValoresAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Valores record
		$record = Valores::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("valores", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ValoresEditRequest $request, $rec_id = null){
		$query = Valores::query();
		$record = $query->findOrFail($rec_id, Valores::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("valores", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.valores.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

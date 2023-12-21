<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\HorariosAddRequest;
use App\Http\Requests\HorariosEditRequest;
use App\Models\Horarios;
use Illuminate\Http\Request;
use Exception;
class HorariosController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.horarios.list";
		$query = Horarios::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Horarios::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "horarios.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Horarios::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Horarios::query();
		$record = $query->findOrFail($rec_id, Horarios::viewFields());
		return $this->renderView("pages.horarios.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.horarios.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(HorariosAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Horarios record
		$record = Horarios::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("horarios", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(HorariosEditRequest $request, $rec_id = null){
		$query = Horarios::query();
		$record = $query->findOrFail($rec_id, Horarios::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("horarios", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.horarios.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

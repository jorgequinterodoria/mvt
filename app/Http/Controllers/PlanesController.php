<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanesAddRequest;
use App\Http\Requests\PlanesEditRequest;
use App\Models\Planes;
use Illuminate\Http\Request;
use Exception;
class PlanesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.planes.list";
		$query = Planes::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Planes::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "planes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Planes::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Planes::query();
		$record = $query->findOrFail($rec_id, Planes::viewFields());
		return $this->renderView("pages.planes.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.planes.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PlanesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Planes record
		$record = Planes::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("planes", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PlanesEditRequest $request, $rec_id = null){
		$query = Planes::query();
		$record = $query->findOrFail($rec_id, Planes::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("planes", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.planes.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientesAddRequest;
use App\Http\Requests\ClientesEditRequest;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Exception;
class ClientesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.clientes.list";
		$query = Clientes::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Clientes::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "clientes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Clientes::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Clientes::query();
		$record = $query->findOrFail($rec_id, Clientes::viewFields());
		return $this->renderView("pages.clientes.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.clientes.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ClientesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("foto", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto'], "foto");
			$modeldata['foto'] = $fileInfo['filepath'];
		}
		
		//save Clientes record
		$record = Clientes::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("clientes", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ClientesEditRequest $request, $rec_id = null){
		$query = Clientes::query();
		$record = $query->findOrFail($rec_id, Clientes::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("foto", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto'], "foto");
			$modeldata['foto'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("clientes", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.clientes.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuariosRegisterRequest;
use App\Http\Requests\UsuariosAccountEditRequest;
use App\Http\Requests\UsuariosAddRequest;
use App\Http\Requests\UsuariosEditRequest;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Exception;
class UsuariosController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.usuarios.list";
		$query = Usuarios::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Usuarios::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "usuarios.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Usuarios::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Usuarios::query();
		$record = $query->findOrFail($rec_id, Usuarios::viewFields());
		return $this->renderView("pages.usuarios.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.usuarios.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(UsuariosAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("foto", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto'], "foto");
			$modeldata['foto'] = $fileInfo['filepath'];
		}
		$modeldata['pwd'] = bcrypt($modeldata['pwd']);
		
		//save Usuarios record
		$record = Usuarios::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("usuarios", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(UsuariosEditRequest $request, $rec_id = null){
		$query = Usuarios::query();
		$record = $query->findOrFail($rec_id, Usuarios::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("foto", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto'], "foto");
			$modeldata['foto'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("usuarios", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.usuarios.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\HorarioClientesAddRequest;
use App\Http\Requests\HorarioClientesEditRequest;
use App\Models\HorarioClientes;
use Illuminate\Http\Request;
use Exception;
class HorarioClientesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.horarioclientes.list";
		$query = HorarioClientes::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			HorarioClientes::search($query, $search); // search table records
		}
		$query->join("clientes", "horario_clientes.id", "=", "clientes.id");
		$query->join("horarios", "horario_clientes.id_horario", "=", "horarios.id");
		$orderby = $request->orderby ?? "horario_clientes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, HorarioClientes::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = HorarioClientes::query();
		$query->join("clientes", "horario_clientes.id", "=", "clientes.id");
		$query->join("horarios", "horario_clientes.id_horario", "=", "horarios.id");
		$record = $query->findOrFail($rec_id, HorarioClientes::viewFields());
		return $this->renderView("pages.horarioclientes.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.horarioclientes.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(HorarioClientesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['id_cliente'] = auth()->user()->id;
		
		//save HorarioClientes record
		$record = HorarioClientes::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("horarioclientes", "Guardado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(HorarioClientesEditRequest $request, $rec_id = null){
		$query = HorarioClientes::query();
		$query->where("horario_clientes.id_cliente", auth()->user()->id);
		$record = $query->findOrFail($rec_id, HorarioClientes::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("horarioclientes", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.horarioclientes.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}

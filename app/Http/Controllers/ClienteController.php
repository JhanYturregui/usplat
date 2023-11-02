<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    date_default_timezone_set('America/Lima');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return view('clientes.index');
  }

  /**
  * Obtener datos
  *
  */
  public function obtenerDatos(Request $request)
  {
    $query = DB::table('clientes')->select('id', 'nombres', 'apellidos', 'email', 'estado')
                ->where('estado', 1)
                ->orderBy('id', 'desc');

    return datatables()
        ->of($query)
        ->addColumn('btn-crud-clientes', 'botones-crud.clientes')
        ->rawColumns(['btn-crud-clientes'])
        ->toJson();
  }

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.registrar');
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $datos = array();
    $datos["nombres"] = $request->input('nombres');
    $datos["apellidos"] = $request->input('apellidos');
    $datos["email"] = $request->input('email');

    // Validar datos
    $validator = Validator::make($datos, [
      'nombres'   => 'bail|required|max:100',
      'apellidos' => 'bail|required|max:100',
      'email'     => 'bail|required|email|unique:clientes|max:60',
    ], [
      'nombres.required'   => 'El campo NOMBRES es obligatorio.',
      'nombres.max'        => 'El campo NOMBRES puede tener máximo 100 caracteres.',
      'apellidos.required' => 'El campo APELLIDOS es obligatorio.',
      'apellidos.max'      => 'El campo APELLIDOS puede tener máximo 100 caracteres.',
      'email.required'     => 'El campo EMAIL es obligatorio.',
      'email.max'          => 'El campo EMAIL puede tener máximo 60 caracteres.',
      'email.email'        => 'El campo EMAIL debe tener formato de correo electrónico.',
      'email.unique'       => 'El EMAIL ya se encuentra registrado.',
    ]);

    $response = array();
    if ($validator->fails()) {
        $response["estado"] = false;
        $response["mensaje"] = $validator->messages()->first();
        return json_encode($response);
    }

    try {
      $marca = Cliente::create($datos);

      $response["estado"] = true;
      $response["mensaje"] = 'Registro correcto.';

    } catch (Exception $e) {
        $response["estado"] = false;
        $response["mensaje"] = $e->getMessage();
    }

    return json_encode($response);
  }

  /**
   * Display the specified resource by id.
   *
   * @param  \App\Cliente  $cliente
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $dato = Cliente::where([['id', $id], ['estado', 1]])->first();
      return view('clientes.modificar', compact('dato'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Cliente  $cliente
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $id = intval($request->input('id'));
    $datos = array();
    $datos["nombres"] = $request->input('nombres');
    $datos["apellidos"] = $request->input('apellidos');
    $datos["email"] = $request->input('email');

    // Validar datos
    $validator = Validator::make($datos, [
      'nombres'   => 'bail|required|max:100',
      'apellidos' => 'bail|required|max:100',
      'email'     => 'bail|required|email|max:60',
    ], [
      'nombres.required'   => 'El campo NOMBRES es obligatorio.',
      'nombres.max'        => 'El campo NOMBRES puede tener máximo 100 caracteres.',
      'apellidos.required' => 'El campo APELLIDOS es obligatorio.',
      'apellidos.max'      => 'El campo APELLIDOS puede tener máximo 100 caracteres.',
      'email.required'     => 'El campo EMAIL es obligatorio.',
      'email.max'          => 'El campo EMAIL puede tener máximo 60 caracteres.',
      'email.email'        => 'El campo EMAIL debe tener formato de correo electrónico.',
    ]);

    $response = array();
    if ($validator->fails()) {
        $response["estado"] = false;
        $response["mensaje"] = $validator->messages()->first();
        return json_encode($response);
    }

    try {
      $dato = Cliente::find($id);
      if ($dato === false) {
        $response["estado"] = false;
        $response["mensaje"] = 'El registro no existe.';
        return json_encode($response);
      }

      $existeEmail = Cliente::where([['id', '!=', $id], ['email', $datos["email"]]])->exists();
      if ($existeEmail) {
        $response["estado"] = false;
        $response["mensaje"] = 'El EMAIL ya existe.';
        return json_encode($response);
      }

      $dato->update($datos);
      $response["estado"] = true;
      $response["mensaje"] = 'Actualización correcta.';

    } catch (Exception $e) {
        $response["estado"] = false;
        $response["mensaje"] = $e->getMessage();
    }

    return json_encode($response);
  }

  /**
  *
  */
  public function delete(Request $request)
  {
    $id = $request->input("id");
    try {
      $dato = Cliente::find($id);
      if ($dato === false) {
        $response["estado"] = false;
        $response["mensaje"] = 'El registro no existe.';
        return json_encode($response);
      }

      $dato->estado = 0;
      $dato->save();

      $response = array();
      $response["estado"] = true;
      $response["mensaje"] = 'Eliminación correcta.';

    } catch (Exception $e) {
        $response["estado"] = false;
        $response["mensaje"] = $e->getMessage();
    }
    return json_encode($response);
  }
}

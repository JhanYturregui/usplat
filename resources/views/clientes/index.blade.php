@extends('adminlte::page')

@section('css')
    <link href="{{ asset('css/estilos/listas.css') }}" rel="stylesheet" >
@endsection

@section('content')
<div class="contenido">
    <div class="listado-md">
      <div class="card">
        <div class="card-header">
          <h4>Listado de Clientes</h4>
        </div>
        <div class="card-body">
          <div class="menu">
            <div class="col-xs-12">
              <a href="{{ route('clientes_crear') }}" class="btn btn-primary botones-expand">Nuevo cliente</a>
            </div>
          </div>
          <div class="table-responsive">
          <table id="tablaClientes" class="table table-hover table-mobile">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <th>APELLIDOS</th>
                  <th>EMAIL</th>
                  <!--<th>ESTADO</th>-->
                  <th>ACCIONES</th>
                </tr>
              </thead>
          </table>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idDatoEliminar" value="">
        ¿Desea eliminar este cliente?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="eliminar()">Si, eliminar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/cliente.js') }}"></script>
@endsection

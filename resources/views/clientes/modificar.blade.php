@extends('adminlte::page')

@section('css')
    <link href="{{ asset('css/estilos/procesos.css') }}" rel="stylesheet" >
@endsection

@section('content')
<div class="contenido">
    <div class="container col-xs-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h5>Modificar Cliente</h5>
          </div>
          <div class="card-body">
            <input type="hidden" id="idDato" value="{{ $dato["id"] }}">
            <!-- Datos -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Nombres</span>
              </div>
              <input type="text" class="form-control" id="nombres"
                value="{{ $dato["nombres"] }}">
            </div>
            <div class="input-group mt-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Apellidos</span>
              </div>
              <input type="text" class="form-control" id="apellidos"
                value="{{ $dato["apellidos"] }}">
            </div>
            <div class="input-group mt-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Email</span>
              </div>
              <input type="text" class="form-control" id="email"
                value="{{ $dato["email"] }}">
            </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary botones-expand" onclick="actualizar()">Actualizar</button>
          </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script src="{{ asset('js/cliente.js') }}"></script>
@endsection

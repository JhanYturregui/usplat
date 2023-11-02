@extends('adminlte::page')

@section('css')
    <link href="{{ asset('css/estilos/procesos.css') }}" rel="stylesheet" >
@endsection

@section('content')
<div class="contenido">
    <div class="container col-xs-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Registrar Cliente</h4>
          </div>
          <div class="card-body">
            <!-- Datos -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Nombres</span>
              </div>
              <input type="text" class="form-control" id="nombres">
            </div>
            <div class="input-group mt-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Apellidos</span>
              </div>
              <input type="text" class="form-control" id="apellidos">
            </div>
            <div class="input-group mt-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Correo electrónico</span>
              </div>
              <input type="text" class="form-control" id="email">
            </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary botones-expand" onclick="registrar()">Registrar</button>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <!-- JS -->
    <script src="{{ asset('js/cliente.js') }}"></script>
@endsection

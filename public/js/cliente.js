let origin = '';

window.onload = function() {
  origin = window.location.origin;
  $('#tablaClientes').DataTable({
      "serverSide": true,
      "processing": true,
      "ajax": {
        "url": "clientes/obtener",
        "type": "get"
      },
      "columns": [
          {data: 'id', 'searchable': false},
          {data: 'nombres'},
          {data: 'apellidos'},
          {data: 'email'},
          {data: 'btn-crud-clientes', 'orderable': false, 'searchable': false}
      ],
      "language": {
          "info": "_TOTAL_ registros",
          "search": "Buscar por:",
          "searchPlaceholder": "Nombre",
          "paginate": {
              "next": "Siguiente",
              "previous": "Anterior"
          },
          "lengthMenu": 'Mostrar <select>'+
                          '<option value="10">10</option>'+
                          '<option value="25">25</option>'+
                          '<option value="-1">Todos</option>'+
                          '</select> registros',
          "loadingRecords": "Cargando...",
          "processing": '<div class="progress" style="width: 40vw; margin-left: -10vw !important"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div> ',
          "emptyTable": "No se encontraron datos",
          "zeroRecords": "No se encontraron coincidencias",
          "infoEmpty": "",
          "infoFiltered": ""
      }
  });
  $('label').addClass('form-inline');
  $('select, input[type="search"]').addClass('form-control');
}

function registrar() {
    const nombres   = $('#nombres').val();
    const apellidos = $('#apellidos').val();
    const email     = $('#email').val();

    const validos = validarCampos([[nombres, false], [apellidos, false], [email, true]]);
    if (!validos) {
      Swal.fire(
        'Error!',
        'Verifique bien los campos',
        'warning'
      )
      return;
    }

    const data = {
      nombres,
      apellidos,
      email,
      _token: $('input[name=_token]').val(),
    };

    $.ajax({
        type: 'post',
        url: 'registrar',
        dataType: 'json',
        data,
        success: function(a){
          if (a.estado) {
            console.log(origin)
            location.replace(origin+'/clientes');

          } else {
            Swal.fire(
              'Error!',
              a.mensaje,
              'warning'
            )
          }
        },
        error: function(e) {
          console.log(e)
        }
    });
}

function actualizar()
{
    const id        = $('#idDato').val();
    const nombres   = $('#nombres').val();
    const apellidos = $('#apellidos').val();
    const email     = $('#email').val();

    const validos = validarCampos([[nombres, false], [apellidos, false], [email, true]]);
    if (!validos) {
      Swal.fire(
        'Error!',
        'Verifique bien los campos',
        'warning'
      )
      return;
    }

    const data = {
      id,
      nombres,
      apellidos,
      email,
      _token: $('input[name=_token]').val()
    };

    $.ajax({
        type: 'post',
        url: '../actualizar',
        dataType: 'json',
        data,
        success: function(a){
          if (a.estado) {
            location.replace(origin+'/clientes')

          } else {
            Swal.fire(
              'Error!',
              a.mensaje,
              'warning'
            )
          }
        },
        error: function(e) {
          console.log(e)
        }
    });
}

function modEliminar(id)
{
  $('#idDatoEliminar').val(id);
  $('#modalEliminar').modal();
}

function eliminar()
{
    const id = $('#idDatoEliminar').val();
    const data = {
      id,
      _token: $('input[name=_token]').val(),
    };
    $.ajax({
        type: 'post',
        url: 'clientes/eliminar',
        dataType: 'json',
        data,
        success: function(a){
          if (a.estado) {
            location.replace(origin+'/clientes')
          }else {

          }
        },
        error: function(e) {
          console.log(e)
        }
    });
}

function validarTexto(campo) {
  let valido = true;
  if (campo.trim() === '') {
    valido = false;
  }

  return valido;
}

function validarEmail(email) {
  let valido = true;
  const caracteres = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

  if (caracteres.test(email) == false){
    valido = false;
  }

  return valido;
}

function validarCampos(datos) {
  let valido = true;
  for (let i = 0; i < datos.length; i++) {
    const valor = datos[i][0];
    const esEmail = datos[i][1];
    valido = validarTexto(valor);
    if (!valido ) return valido;
    if (esEmail) {
      valido = validarEmail(valor);
      if (!valido) return valido;
    }
  }
  return valido;
}
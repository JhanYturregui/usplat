<div class="btn-crud">
	<a href="{{ route('clientes_editar', $id) }}"><i class="fas fa-pen" title="Editar"></i></a>
	<i class="fas fa-trash" onclick="modEliminar({{$id}})" title="Eliminar"
		style="color: red; cursor: pointer;"></i>
</div>

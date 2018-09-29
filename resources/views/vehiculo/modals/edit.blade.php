<div class="modal fade" tabindex="-1" role="dialog" id="modal-vehiculo-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Vehículo</h4>
            </div>
            <div class="modal-body">
                <form id="vehiculo-frm-update" action="{{route('vehiculo.update')}}" method="post" id="editarVehiculo">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="marca" class="control-label">Marca :</label>
                        <input type="text" class=" form-control" name="marca" value="{{old('marca')}}" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción :</label>
                        <input type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}" maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="placa" class="control-label">Placa :</label>
                        <input type="text" class=" form-control" name="placa" value="{{old('placa')}}" maxlength="8">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" value="" id="update">Actualizar</button>
                <a href="" class="btn btn-warning " data-dismiss="modal" id="index">Volver</a>
            </div>
        </div>
    </div>
</div>

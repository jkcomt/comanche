<div class="modal fade" tabindex="-1" role="dialog" id="modal-cli-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Cliente</h4>
            </div>
            <div class="modal-body">
                <form id="cli-frm-update" action="{{route('cliente.update')}}" method="post" id="editarCliente">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="apellidos" class="control-label">Apellidos :</label>
                        <input type="text" class=" form-control" name="apellidos" value="{{old('apellidos')}}">
                    </div>
                    <div class="form-group">
                        <label for="nombres" class="control-label">Nombres :</label>
                        <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}">
                    </div>

                    <div class="form-group">
                        <label for="dni" class="control-label">DNI :</label>
                        <input type="text" maxlength="8" class=" form-control" name="dni" value="{{old('dni')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-group">
                        <label for="celular" class="control-label">Celular :</label>
                        <input type="number" class="form-control" name="celular" value="{{old('celular')}}">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="control-label">Dirección :</label>
                        <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">E-mail :</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="ruc" class="control-label">RUC :</label>
                        <input type="text" class="form-control" name="ruc" value="{{old('ruc')}}">
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
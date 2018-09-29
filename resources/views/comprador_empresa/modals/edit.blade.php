<div class="modal fade" tabindex="-1" role="dialog" id="modal-comprador-empresa-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Empresa</h4>
            </div>
            <div class="modal-body">
                <form id="comprador-empresa-frm-update" action="{{route('comprador_empresa.update')}}" method="post" id="editarCompradorEmpresa">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="razon_social" class="control-label">Razón Social :</label>
                        <input type="text" class=" form-control" name="razon_social" value="{{old('razonsocial')}}" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="ruc" class="control-label">RUC :</label>
                        <input type="text" class="form-control" maxlength="12" name="ruc" value="{{old('ruc')}}" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Dirección :</label>
                        <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}" maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="control-label">Teléfono :</label>
                        <input type="text" class=" form-control"  maxlength="12" form-control" name="telefono" value="{{old('telefono')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">E-mail :</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}"  maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="representante" class="control-label">Representante :</label>
                        <input type="text" class="form-control" name="representante" value="{{old('representante')}}" maxlength="30" onkeypress="return lettersOnly(event)">
                    </div>
                    <div class="form-group">
                        <label for="dni_representante" class="control-label">DNI del representante :</label>
                        <input type="text" maxlength="8" class="form-control" name="dni_representante" value="{{old('dni_representante')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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

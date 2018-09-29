<div class="modal fade" tabindex="-1" role="dialog" id="modal-chofer-nuevo">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Chofer</h4>
            </div>
            <div class="modal-body">
                <form id="registrarChofer" action="{{route('chofer.create')}}" method="post" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="" class="control-label">Apellidos :</label>
                        <input type="text" class=" form-control" name="apellidos" value="{{old('apellidos')}}"  onkeypress="return lettersOnly(event)" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Nombres :</label>
                        <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}"  onkeypress="return lettersOnly(event)" maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="dni" class="control-label">DNI :</label>
                        <input type="text" maxlength="8" class=" form-control" name="dni" value="{{old('dni')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Celular :</label>
                        <input type="number" class="form-control" name="celular" value="{{old('celular')}}" maxlength="12">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Dirección :</label>
                        <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}" maxlength="20">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="submitRegistrarChofer">Registrar</button>
                <a href="" class="btn btn-warning " data-dismiss="modal" id="index">Volver</a>
            </div>
        </div>
    </div>
</div>

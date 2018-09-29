<div class="modal fade" tabindex="-1" role="dialog" id="modal-personal-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Personal</h4>
            </div>
            <div class="modal-body">
                <form id="personal-frm-update" action="{{route('personal.update')}}" method="post" id="editarPersonal">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="apellidos" class="control-label">Apellidos :</label>
                        <input type="text" class=" form-control" name="apellidos" value="{{old('apellidos')}}" onkeypress="return lettersOnly(event)" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="nombres" class="control-label">Nombres :</label>
                        <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}" onkeypress="return lettersOnly(event)" maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="dni" class="control-label">DNI :</label>
                        <input type="number" class=" form-control" name="dni" value="{{old('dni')}}"  maxlength="8">
                    </div>
                    <div class="form-group">
                        <label for="celular" class="control-label">Celular :</label>
                        <input type="number" class="form-control" name="celular" value="{{old('celular')}}"  maxlength="12">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="control-label">Dirección :</label>
                        <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}"  maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">E-mail :</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}"  maxlength="20">
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

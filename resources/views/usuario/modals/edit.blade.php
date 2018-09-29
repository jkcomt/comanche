<div class="modal fade" tabindex="-1" role="dialog" id="modal-usuario-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <form id="usuario-frm-update" action="{{route('usuario.update')}}" method="post" id="editarUsuario">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="personal" class="control-label">Personal :</label>
                        <input type="text" class=" form-control" name="personal" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="area" class="control-label  ">Área :</label>
                        <select name="area" id="area" class="form-control">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nick" class="control-label">Nick :</label>
                        <input type="text" class="form-control" name="nick" value="" readonly>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">Password :</label>
                        <input type="password" class=" form-control" name="password" value="" maxlength="10">
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label for="email" class="control-label">E-mail :</label>--}}
                        {{--<input type="email" class="form-control" name="email" value="{{old('email')}}">--}}
                    {{--</div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" value="" id="update">Actualizar</button>
                <a href="" class="btn btn-warning " data-dismiss="modal" id="index">Volver</a>
            </div>
        </div>
    </div>
</div>

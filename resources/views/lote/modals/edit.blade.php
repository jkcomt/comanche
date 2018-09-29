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
                        <label for="" class="control-label">Apellidos :</label>
                        <input type="text" class=" form-control" name="apellidos" value="{{old('apellidos')}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Nombres :</label>
                        <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">DNI :</label>
                        <input type="number" class=" form-control" name="dni" value="{{old('dni')}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Celular :</label>
                        <input type="number" class="form-control" name="celular" value="{{old('celular')}}">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Dirección :</label>
                        <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">E-mail :</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
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
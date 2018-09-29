<div class="modal fade" tabindex="-1" role="dialog" id="modal-empresa-nuevo">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva Empresa</h4>
            </div>
            <div class="modal-body">
                <form id="registrarEmpresa" action="{{route('empresa.create')}}" method="post">
                    {{csrf_field()}}
                    {{--<div class="form-group">--}}
                        {{--<label for="" class="control-label">Tipo :</label>--}}
                        {{--<div class="radio-inline">--}}
                            {{--<label for="control-label"><input type="radio" checked name="rbTipoAgri" value="natural" id="rbTipoAgri">Persona Natural</label>--}}
                        {{--</div>--}}
                        {{--<div class="radio-inline">--}}
                            {{--<label for="control-label"><input type="radio" name="rbTipoAgri" value="empresa" id="rbTipoAgri">Empresa</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="razon_social" class="control-label">Razón Social :</label>
                        <input type="text" class=" form-control" name="razon_social" value="{{old('razonsocial')}}" maxlength="30"  onkeypress="return lettersOnly(event)">
                    </div>
                    <div class="form-group">
                        <label for="ruc" class="control-label">RUC :</label>
                        <input type="text" class="form-control" name="ruc" value="{{old('ruc')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Dirección :</label>
                        <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}" maxlength="12">
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="control-label">Teléfono :</label>
                        <input type="number" class="form-control" name="telefono" value="{{old('telefono')}}"  maxlength="12">
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">E-mail :</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}"  maxlength="20" >
                    </div>
                    <div class="form-group">
                        <label for="representante" class="control-label">Representante :</label>
                        <input type="text" class="form-control" name="representante" value="{{old('representante')}}"  maxlength="40">
                    </div>
                    <div class="form-group">
                        <label for="dni_representante" class="control-label">DNI del representante :</label>
                        <input type="number" class="form-control" name="dni_representante" value="{{old('dni_representante')}}"  maxlength="8">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="submitRegistrarEmpresa">Registrar</button>
                <a href="" class="btn btn-warning " data-dismiss="modal" id="index">Volver</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-area-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Área</h4>
            </div>
            <div class="modal-body">
                <form id="area-frm-update" action="{{route('area.update')}}" method="post" id="editarArea">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="" class="control-label">Descripción :</label>
                        <input type="text" class=" form-control" name="descripcion" value="{{old('descripcion')}}" style="text-transform:uppercase">
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
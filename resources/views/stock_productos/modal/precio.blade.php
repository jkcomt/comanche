<div class="modal fade" tabindex="-1" role="dialog" id="stock-precio-edit">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Personal</h4>
            </div>
            <form id="stock-frm-precio-update" action="{{route('stock_producto.updatePrecio')}}" method="post">
            <div class="modal-body">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="" class="control-label">Producto:</label>
                        <input type="text" class="form-control productoNombre" value="" readonly>
                        <input type="hidden" value="" name="stockItemId" class="stockItemId">
                    </div>
                    <div class="form-group">
                        <label for="precio" class="control-label">Precio :</label>
                        <input type="number" step="0.1" class=" form-control precioProducto" name="precio" value="{{old('precio')}}">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" value="" id="update"  name="updatePrecio">Actualizar</button>
                <a href="" class="btn btn-warning " data-dismiss="modal" id="index">Volver</a>
            </div>
            </form>
        </div>
    </div>
</div>
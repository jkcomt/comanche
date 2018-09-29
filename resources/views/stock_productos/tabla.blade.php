<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>COD PRODUCTO</th>
        <th>DESCRIPCIÓN</th>
        <th>SALDO DISPONIBLE</th>
        <th>KILOS</th>
        <th>PRECIO</th>
        <th>ESTADO</th>
        <th>OPCIONES</th>
        </thead>
        <tbody>
        @foreach($stockProductos as $stockProducto)

                {{--{{$produccionIngreso}}--}}
                <tr>
                    <td>
                        {{$stockProducto->serie_producto}}
                    </td>
                    <td>
                        {{$stockProducto->descripcion_producto}}
                    </td>
                    <td>
                        @if($stockProducto->cantidad_stock)
                            {{$stockProducto->cantidad_stock}}
                            @else
                            0
                        @endif
                    </td>
                    <td>
                        {{$stockProducto->kilos}}
                    </td>
                    <td>
                        {{$stockProducto->precio}}
                    </td>
                    <td>
                        @if($stockProducto->cantidad_stock)
                            @if($stockProducto->cantidad_stock > 0)
                                DISPONIBLE
                            @else
                                NO DISPONIBLE
                            @endif
                            @else
                            NO DISPONIBLE
                        @endif


                    </td>
                    <td>

                        <button class="btn btn-xs btn-primary cambiarPrecio
                            @if($stockProducto->cantidad_stock == 0)
                                    disabled
                            @endif" id="{{$stockProducto->stock_producto_id}}">INGRESAR PRECIO</button>
                    </td>
                </tr>

        @endforeach
        </tbody>
    </table>
    {{--{{$stockProductos->links()}}--}}
</div>
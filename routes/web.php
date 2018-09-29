<?php



Route::get('/','Auth\LoginController@showLoginForm');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/configuracion', 'DashboardController@configuracion')->name('configuracion')->middleware('gerencia');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::view('/blank','blank');

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'agricultor'
],function()
{
    Route::get('/','AgricultorController@index')->name('agricultor.index');
    Route::get('/nuevo','AgricultorController@create')->name('agricultor.nuevo');
    Route::post('/crear','AgricultorController@store')->name('agricultor.create');
    Route::get('/{id}/edit','AgricultorController@edit')->name('agricultor.edit');
    Route::post('/update','AgricultorController@update')->name('agricultor.update');
    Route::post('/delete','AgricultorController@destroy')->name('agricultor.destroy');
    Route::get('/buscar','AgricultorController@search')->name('agricultor.search');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'cliente'
],function()
{
    Route::get('/','ClienteController@index')->name('cliente.index');
    Route::get('/nuevo','ClienteController@create')->name('cliente.nuevo');
    Route::post('/crear','ClienteController@store')->name('cliente.create');
    Route::get('/{id}/edit','ClienteController@edit')->name('cliente.edit');
    Route::post('/update','ClienteController@update')->name('cliente.update');
    Route::post('/delete','ClienteController@destroy')->name('cliente.destroy');
    Route::get('/buscar','ClienteController@search')->name('cliente.search');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'empresa'
],function()
{
    Route::get('/','EmpresasController@index')->name('empresa.index');
    Route::get('/nuevo','EmpresasController@create')->name('empresa.nuevo');
    Route::post('/crear','EmpresasController@store')->name('empresa.create');
    Route::get('/{id}/edit','EmpresasController@edit')->name('empresa.edit');
    Route::post('/update','EmpresasController@update')->name('empresa.update');
    Route::post('/delete','EmpresasController@destroy')->name('empresa.destroy');
    Route::get('/buscar','EmpresasController@search')->name('empresa.search');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'chofer'
],function()
{
    Route::get('/','ChoferController@index')->name('chofer.index');
    Route::get('/nuevo','ChoferController@create')->name('chofer.nuevo');
    Route::post('/crear','ChoferController@store')->name('chofer.create');
    Route::get('/{id}/edit','ChoferController@edit')->name('chofer.edit');
    Route::post('/update','ChoferController@update')->name('chofer.update');
    Route::post('/delete','ChoferController@destroy')->name('chofer.destroy');
    Route::get('/buscar','ChoferController@search')->name('chofer.search');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'variedad'
],function()
{
    Route::get('/','VariedadController@index')->name('variedad.index');
    Route::get('/nuevo','VariedadController@create')->name('variedad.nuevo');
    Route::post('/crear','VariedadController@store')->name('variedad.create');
    Route::get('/{id}/edit','VariedadController@edit')->name('variedad.edit');
    Route::post('/update','VariedadController@update')->name('variedad.update');
    Route::post('/delete','VariedadController@destroy')->name('variedad.destroy');
    Route::get('/buscar','VariedadController@search')->name('variedad.search');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'procedencia'
],function()
{
    Route::post('/crear','ProcedenciaController@store')->name('procedencia.create');
    Route::get('/','ProcedenciaController@index')->name('procedencia.index');
    Route::get('/nuevo','ProcedenciaController@create')->name('procedencia.nuevo');
    Route::get('/{id}/edit','ProcedenciaController@edit')->name('procedencia.edit');
    Route::post('/update','ProcedenciaController@update')->name('procedencia.update');
    Route::post('/delete','ProcedenciaController@destroy')->name('procedencia.destroy');
    Route::get('/buscar','ProcedenciaController@search')->name('procedencia.search');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'vehiculo'
],function()
{
    Route::get('/','VehiculoController@index')->name('vehiculo.index');
    Route::get('/nuevo','VehiculoController@create')->name('vehiculo.nuevo');
    Route::post('/crear','VehiculoController@store')->name('vehiculo.create');
    Route::get('/{id}/edit','VehiculoController@edit')->name('vehiculo.edit');
    Route::post('/update','VehiculoController@update')->name('vehiculo.update');
    Route::post('/delete','VehiculoController@destroy')->name('vehiculo.destroy');
    Route::get('/buscar','VehiculoController@search')->name('vehiculo.search');
});

Route::group([
    'middleware'=>['gerencia','auth'],
    'prefix'=>'usuario'
],function()
{
    Route::get('/','UsuarioController@index')->name('usuario.index');
    Route::get('/nuevo','UsuarioController@create')->name('usuario.nuevo');
    Route::post('/crear','UsuarioController@store')->name('usuario.create');
    Route::get('/{id}/edit','UsuarioController@edit')->name('usuario.edit');
    Route::post('/update','UsuarioController@update')->name('usuario.update');
    Route::post('/delete','UsuarioController@destroy')->name('usuario.destroy');
    Route::get('/buscar','UsuarioController@search')->name('usuario.search');
});

Route::group([
    'middleware'=>['gerencia','auth'],
    'prefix'=>'personal'
],function()
{
    Route::get('/{id}/edit','PersonalController@edit')->name('personal.edit');
    Route::get('/','PersonalController@index')->name('personal.index');
    Route::get('/nuevo','PersonalController@create')->name('personal.nuevo');
    Route::post('/crear','PersonalController@store')->name('personal.create');
    Route::post('/update','PersonalController@update')->name('personal.update');
    Route::post('/delete','PersonalController@destroy')->name('personal.destroy');
    Route::get('/buscar','PersonalController@search')->name('personal.search');
});

Route::group([
    'middleware'=>['administrador','auth'],
    'prefix'=>'area'
],function()
{
    Route::get('/','AreaController@index')->name('area.index');
    Route::get('/nuevo','AreaController@create')->name('area.nuevo');
    Route::post('/crear','AreaController@store')->name('area.create');
    Route::get('/{id}/edit','AreaController@edit')->name('area.edit');
    Route::post('/update','AreaController@update')->name('area.update');
    Route::post('/delete','AreaController@destroy')->name('area.destroy');
});

Route::group([
    'middleware'=>['recepcion','auth'],
    'prefix'=>'lote'
],function()
{
    Route::get('/{id}/detalle','LoteController@show')->name('lote.show');
    Route::get('/','LoteController@index')->name('lote.index');
    Route::get('/nuevo','LoteController@create')->name('lote.nuevo');
    Route::post('/crear','LoteController@store')->name('lote.create');
    Route::get('/{id}/edit','LoteController@edit')->name('lote.edit');
    Route::post('/update','LoteController@update')->name('lote.update');
    Route::post('/delete','LoteController@destroy')->name('lote.destroy');
    Route::get('/clientes','LoteController@listarCliente')->name('lote.clientes');
    Route::get('/agricultores','LoteController@listarAgricultor')->name('lote.agricultores');
    Route::get('/empresas','LoteController@listarEmpresa')->name('lote.empresas');
    Route::get('/variedades','LoteController@listarVariedad')->name('lote.variedades');
    Route::get('/procedencia','LoteController@listarProcedencia')->name('lote.procedencias');
    Route::get('/chofer','LoteController@listarChofer')->name('lote.choferes');
    Route::get('/vehiculo','LoteController@listarVehiculo')->name('lote.vehiculos');
    Route::get('reporte/{id}/detalle','LoteController@reporteDetalle')->name('lote.reporte');
    Route::post('/conforme','LoteController@cambiarConformidad')->name('lote.conforme');
    Route::get('/buscar','LoteController@search')->name('lote.search');
});

Route::group([
    'middleware'=>['secado','auth'],
    'prefix'=>'secado'
],function()
{
    Route::get('/{id}/detalle','LoteController@show')->name('lote.show');
    Route::get('/','LoteSecadoController@index')->name('secado.index');
    Route::get('/nuevo','LoteSecadoController@create')->name('secado.nuevo');
    Route::post('/crear','LoteSecadoController@store')->name('secado.create');
    Route::get('/{id}/edit','LoteSecadoController@edit')->name('secado.edit');
    Route::post('/update','LoteSecadoController@update')->name('secado.update');
    Route::post('/delete','LoteSecadoController@destroy')->name('secado.destroy');
    Route::get('/markasread/{id}','LoteSecadoController@markasread')->name('secado.markasread');
    Route::get('/notifications','LoteSecadoController@notifications')->name('secado.notifications');
    Route::post('/conforme','LoteSecadoController@cambiarConformidad')->name('secado.conforme');
    Route::get('/buscar','LoteSecadoController@search')->name('secado.search');
    Route::get('/reporte/{id}/detalle','LoteSecadoController@reporteDetalle')->name('secado.reporte');
});

Route::group([
    'middleware'=>['secado','auth'],
    'prefix'=>'responsable'
],function()
{
    Route::get('/','ResponsableCuadrillaController@index')->name('responsable.index');
    Route::get('/nuevo','ResponsableCuadrillaController@create')->name('responsable.nuevo');
    Route::post('/crear','ResponsableCuadrillaController@store')->name('responsable.create');
    Route::get('/{id}/edit','ResponsableCuadrillaController@edit')->name('responsable.edit');
    Route::post('/update','ResponsableCuadrillaController@update')->name('responsable.update');
    Route::post('/delete','ResponsableCuadrillaController@destroy')->name('responsable.destroy');
    Route::get('/buscar','ResponsableCuadrillaController@search')->name('responsable.search');
});

Route::group([
    'middleware'=>['secado','auth'],
    'prefix'=>'tendido'
],function()
{
    Route::get('/buscar','TendidoController@search')->name('tendido.search');
    Route::post('/crear','TendidoController@store')->name('tendido.create');
    Route::get('/responsable','TendidoController@listarResponsable')->name('tendido.responsables');
    Route::get('/{id}','TendidoController@index')->name('tendido.index');
    Route::get('/nuevo/{id}','TendidoController@create')->name('tendido.nuevo');
    Route::get('/{id}/edit','TendidoController@edit')->name('tendido.edit');
    Route::post('/update','TendidoController@update')->name('tendido.update');
    Route::post('/delete','TendidoController@destroy')->name('tendido.destroy');
    Route::get('/{id}/detalle','TendidoController@show')->name('tendido.show');
    Route::get('/reporte/{id}/detalle','TendidoController@reporteDetalle')->name('tendido.reporte');

});

Route::group([
    'middleware'=>['secado','auth'],
   'prefix'=>'almacen'
],function()
{
    Route::get('/','AlmacenController@index')->name('almacen.index');
    Route::get('/nuevo','AlmacenController@create')->name('almacen.nuevo');
    Route::post('/crear','AlmacenController@store')->name('almacen.create');
    Route::get('/{id}/edit','AlmacenController@edit')->name('almacen.edit');
    Route::post('/update','AlmacenController@update')->name('almacen.update');
    Route::post('/delete','AlmacenController@destroy')->name('almacen.destroy');
});

Route::group([
    'middleware'=>['secado','auth'],
    'prefix'=>'recojo'
],function()
{
    Route::get('/buscar','RecojoController@search')->name('recojo.search');
    Route::post('/crear','RecojoController@store')->name('recojo.create');
    Route::get('/{id}','RecojoController@index')->name('recojo.index');
    Route::get('/nuevo/{id}','RecojoController@create')->name('recojo.nuevo');
    Route::get('/{id}/edit','RecojoController@edit')->name('recojo.edit');
    Route::post('/update','RecojoController@update')->name('recojo.update');
    Route::post('/delete','RecojoController@destroy')->name('recojo.destroy');
    Route::get('/{id}/detalle','RecojoController@show')->name('recojo.show');
    Route::get('/reporte/{id}/detalle','RecojoController@reporteDetalle')->name('recojo.reporte');
});

Route::group([
    'middleware'=>['produccion','auth'],
    'prefix'=>'produccion_ingreso'
],function() {
    Route::post('/conforme','ProduccionIngresoController@cambiarConformidad')->name('produccion.conforme');
    Route::get('/{id}/detalle','ProduccionIngresoController@show')->name('produccion.show');
    Route::get('/buscar','ProduccionIngresoController@search')->name('produccion.search');
    Route::get('/reporte/{id}/detalle','ProduccionIngresoController@reporteDetalle')->name('produccion.reporte');
    Route::get('/','ProduccionIngresoController@index')->name('produccion.index');
    Route::get('/markasread/{id}','ProduccionIngresoController@markasread')->name('produccion.markasread');
    Route::get('/notifications','ProduccionIngresoController@notifications')->name('produccion.notifications');

});

Route::group([
    'middleware'=>['produccion','auth'],
    'prefix'=>'nueva_produccion'
],function() {
    Route::get('/buscar','NuevaProduccionController@search')->name('nuevaproduccion.search');
    Route::post('/crear','NuevaProduccionController@store')->name('nuevaproduccion.create');
    Route::get('/{id}','NuevaProduccionController@index')->name('nuevaproduccion.index');
    Route::get('/nuevo/{id}','NuevaProduccionController@create')->name('nuevaproduccion.nuevo');
    Route::get('/edit/{id}','NuevaProduccionController@edit')->name('nuevaproduccion.edit');
    Route::post('/update','NuevaProduccionController@update')->name('nuevaproduccion.update');
    Route::post('/delete','NuevaProduccionController@destroy')->name('nuevaproduccion.destroy');
    Route::get('/{id}/detalle','NuevaProduccionController@show')->name('nuevaproduccion.show');
    Route::get('/reporte/{id}/detalle','NuevaProduccionController@reporteDetalle')->name('nuevaproduccion.reporte');
});


Route::group([
    'middleware'=>['produccion','auth'],
    'prefix'=>'resultado_produccion'
],function() {
    Route::get('/{nueva_produccion_id}/listar','ResultadoProducionController@listarResultados')->name('resultado.listarresultados');

});


Route::group([
    'middleware'=>['ventas','auth'],
    'prefix'=>'comprador_persona'
],function()
{
    Route::get('/','CompradorAgricultorController@index')->name('comprador_persona.index');
    Route::get('/nuevo','CompradorAgricultorController@create')->name('comprador_persona.nuevo');
    Route::post('/crear','CompradorAgricultorController@store')->name('comprador_persona.create');
    Route::get('/{id}/edit','CompradorAgricultorController@edit')->name('comprador_persona.edit');
    Route::post('/update','CompradorAgricultorController@update')->name('comprador_persona.update');
    Route::post('/delete','CompradorAgricultorController@destroy')->name('comprador_persona.destroy');
    Route::get('/buscar','CompradorAgricultorController@search')->name('comprador_persona.search');
});

Route::group([
    'middleware'=>['ventas','auth'],
    'prefix'=>'comprador_empresa'
],function()
{
    Route::get('/','CompradorEmpresaController@index')->name('comprador_empresa.index');
    Route::get('/nuevo','CompradorEmpresaController@create')->name('comprador_empresa.nuevo');
    Route::post('/crear','CompradorEmpresaController@store')->name('comprador_empresa.create');
    Route::get('/{id}/edit','CompradorEmpresaController@edit')->name('comprador_empresa.edit');
    Route::post('/update','CompradorEmpresaController@update')->name('comprador_empresa.update');
    Route::post('/delete','CompradorEmpresaController@destroy')->name('comprador_empresa.destroy');
    Route::get('/buscar','CompradorEmpresaController@search')->name('comprador_empresa.search');
});

Route::group([
    'middleware'=>['ventas','auth'],
    'prefix'=>'stock_producto'
],function()
{
    Route::get('/','StockProductoItemController@index')->name('stock_producto.index');
    Route::get('/nuevo','StockProductoItemController@create')->name('stock_producto.nuevo');
    Route::post('/crear','StockProductoItemController@store')->name('stock_producto.create');
    Route::get('/{id}/edit','StockProductoItemController@edit')->name('stock_producto.edit');
    Route::post('/update','StockProductoItemController@update')->name('stock_producto.update');
    Route::post('/delete','StockProductoItemController@destroy')->name('stock_producto.destroy');
    Route::get('/buscar','StockProductoItemController@search')->name('stock_producto.search');

    Route::get('{id}/buscar_item','StockProductoItemController@buscarItemStock')->name('stock_producto.buscarItemStock');
    Route::post('/actualizar_precio','StockProductoItemController@updatePrecio')->name('stock_producto.updatePrecio');

    Route::get('/reporte','StockProductoItemController@reporte')->name('stock_producto.reporte');
});

Route::group([
    'middleware'=>['ventas','auth'],
    'prefix'=>'ventas'
],function()
{
    Route::get('/','VentasController@index')->name('ventas.index');
    Route::get('/nuevo','VentasController@create')->name('ventas.nuevo');
    Route::post('/crear','VentasController@store')->name('ventas.create');
    Route::get('/{id}/edit','VentasController@edit')->name('ventas.edit');
    Route::post('/update','VentasController@update')->name('ventas.update');
    Route::post('/delete','VentasController@destroy')->name('ventas.destroy');
    Route::get('/buscar','VentasController@search')->name('ventas.search');
    Route::get('/tipo_boleta','VentasController@tipoBoleta')->name('ventas.tipoboleta');
    Route::get('/stock_producto','VentasController@listarStock')->name('ventas.listarStock');

    Route::get('/reporte/{id}/detalle','VentasController@reporteDetalle')->name('ventas.reporte');

    Route::get('/agricultores','VentasController@listarAgricultor')->name('ventas.agricultores');
    Route::get('/empresas','VentasController@listarEmpresa')->name('ventas.empresas');
});

Route::group([
    'middleware'=>['ventas','auth'],
    'prefix'=>'detalle_ventas'
],function() {
    Route::get('/{venta_id}/listar','DetalleVentaController@listarDetalle')->name('resultado.listardetalles');

});

Route::group([
    'middleware'=>['ventas','auth'],
    'prefix'=>'liquidacion'
],function()
{
    Route::get('/','LiquidacionController@index')->name('liquidacion.index');
    Route::get('/{id}/reporte','LiquidacionController@reporteDetalle')->name('liquidacion.reporte');
});

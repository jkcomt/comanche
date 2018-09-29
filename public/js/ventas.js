$(document).ready(function(){
    $ruta = window.location.pathname

    $array = $ruta.split('/')
    if($array[3] == "edit"){
        listarResultados($('input[name=venta_id]').val());
    }

    $( "#agricultor" ).select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: $("#reloadAgricultor").attr('url'),
            delay: 200,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            }
        }
    });

    $( "#empresa" ).select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: $("#reloadEmpresa").attr('url'),
            delay: 200,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            }
        }
    });

    valorCliente();
    }
);

$('input[name="optradio"]').on('change',function()
{
    $estadoCliente = valorCliente();
    //console.log($estadoCliente)
    if($estadoCliente == "persona")
    {
        $('#clienteGroup').hide();
        $('#agricultorGroup').show();
        $('#empresaGroup').hide();

        $('#cliente').val('').trigger('change');

        $('#pagadoporCliente').val($estadoCliente)
        $('label[for=pagadoporCliente]').html('Agricultor');

    }else if($estadoCliente == "cliente"){
        $('#clienteGroup').show();
        $('#agricultorGroup').hide();
        $('#empresaGroup').hide();

        $('#agricultor').val('').trigger('change');

        $('#pagadoporCliente').val($estadoCliente)
        $('label[for=pagadoporCliente]').html('Cliente');

    }else if($estadoCliente == "empresa"){
        $('#clienteGroup').hide();
        $('#agricultorGroup').hide();
        $('#empresaGroup').show();

        $('#empresa').val('').trigger('change');

        $('#pagadoporEmpresa').val($estadoCliente)
        $('label[for=pagadoporCliente]').html('Empresa');
    }
});

function valorCliente()
{
    $estado = $('input[name="optradio"]:checked').val();
    //console.log($estado)
    if($estado == "persona")
    {
        $('#clienteGroup').hide();
        $('#agricultorGroup').show();
        $('#empresaGroup').hide();

        $('input[name=pagadopor]:checked').val('persona')
        $('label[for=pagadoporCliente]').html('Persona');
    }else if($estado == "cliente"){
        $('#clienteGroup').show();
        $('#agricultorGroup').hide();
        $('#empresaGroup').hide();

        //$('#pagadoporCliente').val($estadoCliente)
        $('input[name=pagadopor]:checked').val('cliente')
        $('label[for=pagadoporCliente]').html('Cliente');
    }else if($estado == "empresa"){
        $('#clienteGroup').show();
        $('#agricultorGroup').hide();
        $('#empresaGroup').show();

        //$('#pagadoporCliente').val($estadoCliente)
        $('input[name=pagadopor]:checked').val('empresa')
        $('label[for=pagadoporCliente]').html('Empresa');
    }
    return $estado
}

$('#addAgricultor').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addAgricultor';

    $('#modal-persona-nuevo input[name=apellidos]').parent().removeClass('has-error')
    $('#modal-persona-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-persona-nuevo input[name=dni]').parent().removeClass('has-error')
    $('#modal-persona-nuevo label[for=dni]').html('DNI: ')
    $('#modal-persona-nuevo').modal('show')
});

$('#addEmpresa').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addEmpresa'

    $('#modal-comprador-empresa-nuevo input[name=razon_social]').parent().removeClass('has-error')
    $('#modal-comprador-empresa-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-comprador-empresa-nuevo input[name=ruc]').parent().removeClass('has-error')
    $('#modal-comprador-empresa-nuevo input[name=representante]').parent().removeClass('has-error')
    $('#modal-comprador-empresa-nuevo input[name=dni_representante]').parent().removeClass('has-error')

    $('#modal-comprador-empresa-nuevo label[for=ruc]').html('RUC: ')
    $('#modal-comprador-empresa-nuevo label[for=ruc]').html('RUC: ')
    $('#modal-comprador-empresa-nuevo label[for=ruc]').html('RUC: ')
    $('#modal-comprador-empresa-nuevo label[for=dni_representante]').html('DNI Representante: ')
    $('#modal-comprador-empresa-nuevo label[for=representante]').html('Representante: ')
    $('#modal-comprador-empresa-nuevo').modal('show')
});

$('#submitRegistrarPersona').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarPersona');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-persona-nuevo [name=apellidos]').val('')
            $('#modal-persona-nuevo [name=nombres]').val('')
            $('#modal-persona-nuevo [name=dni]').val('')
            $('#modal-persona-nuevo [name=celular]').val('')
            $('#modal-persona-nuevo [name=direccion]').val('')
            $('#modal-persona-nuevo [name=email]').val('')
            $('#modal-persona-nuevo [name=ruc]').val('')
            $('#modal-persona-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.apellidos)
        {
            $('#modal-persona-nuevo input[name=apellidos]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#modal-persona-nuevo input[name=apellidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nombres)
        {
            $('#modal-persona-nuevo input[name=nombres]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.nombres)
        }else{
            $('#modal-persona-nuevo input[name=nombres]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.dni)
        {
            $('#modal-persona-nuevo input[name=dni]').parent().addClass('has-error')
            $('#modal-persona-nuevo label[for=dni]').html('DNI: '+data.responseJSON.errors.dni)
            console.log(data.responseJSON.errors.dni)
        }else{
            $('#modal-persona-nuevo input[name=dni]').parent().removeClass('has-error')
            $('#modal-persona-nuevo label[for=dni]').html('DNI: ')
        }
        if(data.responseJSON.errors.email)
        {
            $('#modal-persona-nuevo input[name=email]').parent().addClass('has-error')
            $('#modal-persona-nuevo label[for=email]').html('EMAIL: '+data.responseJSON.errors.email)
            console.log(data.responseJSON.errors.email)
        }else{
            $('#modal-persona-nuevo input[name=email]').parent().removeClass('has-error')
            $('#modal-persona-nuevo label[for=email]').html('EMAIL: ')
        }
        if(data.responseJSON.errors.ruc)
        {
            $('#modal-persona-nuevo input[name=ruc]').parent().addClass('has-error')
            $('#modal-persona-nuevo label[for=ruc]').html('RUC: '+data.responseJSON.errors.ruc)
            console.log(data.responseJSON.errors.ruc)
        }else{
            $('#modal-persona-nuevo label[for=ruc]').html('RUC:')
            $('#modal-persona-nuevo input[name=ruc]').parent().removeClass('has-error')
        }
    });
});

$('#submitRegistrarCompradorEmpresa').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarCompradorEmpresa');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-empresa-nuevo [name=razon_social]').val('')
            $('#modal-empresa-nuevo [name=ruc]').val('')
            $('#modal-empresa-nuevo [name=telefono]').val('')
            $('#modal-empresa-nuevo [name=direccion]').val('')
            $('#modal-empresa-nuevo [name=email]').val('')
            $('#modal-empresa-nuevo [name=representante]').val('')
            $('#modal-empresa-nuevo [name=dni_representante]').val('')
            $('#modal-comprador-empresa-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.razon_social)
        {
            $('#modal-empresa-nuevo input[name=razon_social]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#modal-empresa-nuevo input[name=razon_social]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.ruc)
        {
            $('#modal-empresa-nuevo input[name=ruc]').parent().addClass('has-error')
            $('#modal-empresa-nuevo label[for=ruc]').html('RUC: '+data.responseJSON.errors.ruc)
            console.log(data.responseJSON.errors.ruc)
        }else{
            $('#modal-empresa-nuevo input[name=ruc]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.email)
        {
            $('#modal-empresa-nuevo input[name=email]').parent().addClass('has-error')
            $('#modal-empresa-nuevo label[for=email]').html('E-mail: '+data.responseJSON.errors.email)
            console.log(data.responseJSON.errors.email)
        }else{
            $('#modal-empresa-nuevo label[for=email]').html('E-mail:')
            $('#modal-empresa-nuevo input[name=email]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.representante)
        {
            $('#modal-empresa-nuevo input[name=representante]').parent().addClass('has-error')
            $('#modal-empresa-nuevo label[for=representante]').html('Representante: Ingrese representante');
            console.log(data.responseJSON.errors.representante)
        }else{
            $('#modal-empresa-nuevo input[name=representante]').parent().removeClass('has-error')
            $('#modal-empresa-nuevo label[for=representante]').html('Representante: ')
        }

        if(data.responseJSON.errors.dni_representante)
        {
            $('#modal-empresa-nuevo input[name=dni_representante]').parent().addClass('has-error')
            $('#modal-empresa-nuevo label[for=dni_representante]').html('DNI de representante: Ingrese DNI del representante');
            console.log(data.responseJSON.errors.dni_representante)
        }else{
            $('#modal-empresa-nuevo input[name=dni_representante]').parent().removeClass('has-error')
            $('#modal-empresa-nuevo label[for=dni_representante]').html('DNI de representante: ')
        }
    });
});

$('#tipoComprobante').on('change',function(event){
    event.preventDefault();
    //console.log("valor:"+$(this).val());
    var datos = $('#tipoComprobante');
    var url = '/ventas/tipo_boleta';
    $.get(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('input[name=serie_comprobante]').val(data.resultado);
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        console.log(data)
    });
});

$('#producto').on('change',function(event){
   event.preventDefault();
   var valor = $('#producto');
    var url = '/ventas/stock_producto';
    $.get(url,valor.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('input[name=cantidad_stock]').val(data.resultado);
            $('input[name=sacos_kilos]').val(data.producto.kilos);
            $('input[name=precio]').val(data.producto.precio);
            $('input[name=cantidad]').attr('max',data.resultado);
            $('input[name=cantidad]').val('');
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        console.log(data)
    });
});

$items = [];

$('button[name=add]').on('click',function(e){
    e.preventDefault();
    if(parseInt($('input[name=cantidad]').val()) == 0 || $('input[name=cantidad]').val() === ""){
        $('input[name=cantidad]').parent().addClass('has-error');
        return;
    }

    if(parseInt($('input[name=cantidad]').val()) > parseInt($('input[name=cantidad_stock]').val())){
        $('input[name=cantidad]').parent().addClass('has-error');
        return;
    }

    $codProducto = $('select[name=producto] option:selected').val();
    $producto = $('select[name=producto] option:selected').text();
    $nroSacos = $('input[name=cantidad]').val();
    $sacosKilos = $('input[name=sacos_kilos]').val();
    $precio = $('input[name=precio]').val();

    $item = {
        codProducto: $codProducto,
        producto: $producto,
        nroSacos: $nroSacos,
        sacosKilos: $sacosKilos,
        precio: $precio
    };

    $igual = false;
    if($items.length == 0)
    {
        $items.push($item);
        $index = $items.indexOf($item);
        console.log($items);
        $('#tabla tbody').append('<tr><td>'+$codProducto+'</td><td>'+$producto+'</td><td>'+$nroSacos+'</td><td>'+$sacosKilos+'</td><td>'+$precio+'</td><td>'+parseFloat($precio * $nroSacos).toFixed(2)+'</td><td><button class="btn btn-danger btn-xs quitar" index="'+$index+'"><span class="glyphicon glyphicon-remove"></span> Quitar</button></td></tr>');

        $('select[name=producto]').val("");

        $('input[name=cantidad_stock]').val('0');
        $('input[name=sacos_kilos]').val('0');
        $('input[name=precio]').val('0');
        $('input[name=cantidad]').val('0');

    }else{
        for(var i = 0;i < $items.length; i++){
            if($items[i].producto == $item.producto){

                $igual = true;
            }
        }
        if(!$igual){
            $items.push($item);
            console.log($items);
            $index = $items.indexOf($item);
            $('#tabla tbody').append('<tr><td>'+$codProducto+'</td><td>'+$producto+'</td><td>'+$nroSacos+'</td><td>'+$sacosKilos+'</td><td>'+$precio+'</td><td>'+parseFloat($precio * $nroSacos).toFixed(2)+'</td><td><button class="btn btn-danger btn-xs quitar" index="'+$index+'"><span class="glyphicon glyphicon-remove"></span> Quitar</button></td></tr>');

            $('select[name=producto]').val("");

            $('input[name=cantidad_stock]').val('0');
            $('input[name=sacos_kilos]').val('0');
            $('input[name=precio]').val('0');
            $('input[name=cantidad]').val('0');
        }
    }

    totales();
});

$('body').on('click','tr .quitar',function(e){
    e.preventDefault();
    //$items.splice($(this).attr('index'),1);
    $tr = $(this).parent().parent();
    $tr.each(function(){
        var $tds = $(this).find('td');
        if($tds.length != 0){
            $codProducto = $tds.eq(1).text();
            $producto = $tds.eq(2).text();
            $nroSacos = $tds.eq(3).text();
            $sacosKilos = $tds.eq(4).text();
            $precio = $tds.eq(5).text();

            $item = {
                codProducto: $codProducto,
                producto: $producto,
                nroSacos: $nroSacos,
                sacosKilos: $sacosKilos,
                precio: $precio
            };

            $index = $items.map(function(o) { return o.producto; }).indexOf($item.producto);

            $items.splice($index,1);
        }
    });

    console.log($items);

    totales();

    $(this).parent().parent().remove();
});

function totales(){
    var longitud = $items.length;
    var subtotal = 0;
    var igv = 0;
    var total = 0;
    for(var i = 0;i<longitud;i++){
        total += ($items[i].nroSacos * $items[i].precio)
    }
    
    if($('#tipoComprobante').val() == "FACTURA"){
        subtotal =  total / 1.18;
        igv = subtotal * 0.18;
        total = subtotal + igv
    }else{
      subtotal = total;
      igv = 0;

    }

    //igv = (total * 0.18);

    $('input[name=sub_total]').val(parseFloat(subtotal).toFixed(2));
    $('input[name=igv]').val(parseFloat(igv).toFixed(2));
    $('input[name=total]').val(parseFloat(total).toFixed(2));
    //console.log(parseFloat(total).toFixed(2));
}

$('input[name=cantidad]').on('keyup',function(e) {
    if (parseInt($('input[name=cantidad]').val()) > parseInt($('input[name=cantidad_stock]').val())) {
        $('input[name=cantidad]').parent().addClass('has-error')
        return;
    }else {
        $('input[name=cantidad]').parent().removeClass('has-error')
        return;
    }
});

$('#registrarVenta').on('submit',function(e){
    e.preventDefault();
    var datos = $('#registrarVenta');
    var url = datos.attr('action');

    $.post(url,datos.serialize() + "&" + $.param({'items':$items}),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-confirmacion').modal('hide');
            $('#modal-exito').modal('show')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        $('#msg-error').html('')
        $('#msg-error').fadeIn();
        $.each(data.responseJSON.errors, function( index, value ) {
            $('#msg-error').append(value)
            console.log( index + ": " + value );
        });

        // if(data.responseJSON.errors.nro_sacos_procesar)
        // {
        //     $('input[name=nro_sacos_procesar]').parent().addClass('has-error')
        // }else{
        //     $('input[name=nro_sacos_procesar]').parent().removeClass('has-error')
        // }
    });
});

$('body').on('click','.delete',function (e) {
    e.preventDefault();

    $botonPresionado = 'eliminar'

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('.confirmar').attr('estado','eliminar')
    $('#modal-confirmacion').modal('show')
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    $estado = $(this).attr('estado')
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    if($estado == 'eliminar') {
        $(this).attr('disabled','disabled');
        var url = "/ventas/delete"

        console.log(id)
        $.ajax({
            type: "post",
            url: url,
            headers: {'X-CSRF-TOKEN': token},
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {

                console.log(data.responseJSON)
                $('#modal-confirmacion').modal('hide')
                $('#modal-exito').modal('show')

            },
            error: function (data) {
                console.log(data.responseJSON)
            }
        });
    }else if($estado === 'registrar'){
        $('#registrarVenta').trigger('submit');
    }else if($estado === 'actualizar'){
        $('#actualizarVenta').trigger('submit');
    }
});

$('.registarVenta').on('click',function(e){
    e.preventDefault();

    $botonPresionado = 'registrar';

    //var id = $(this).attr('id');
    //$('.confirmar').attr('id',id);
    $('.confirmar').attr('estado','registrar');
    $('#modal-confirmacion').modal('show');
});

function listarResultados(id){
    var url = "/detalle_ventas/"+id+"/listar";
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",

        success: function(data){

            console.log(data);
            $item = {};

            $total = 0;
            $.each(data, function( index, value ) {
                //console.log(data);
                $item = {
                    codProducto: data[index].stock_producto_id,
                    producto: data[index].descripcion_producto,
                    nroSacos: data[index].cantidad,
                    sacosKilos: data[index].kilos,
                    precio: data[index].precio
                };

                $items.push($item);
                $index = $items.indexOf($item);

                $('#tabla tbody').append('<tr><td>'+$item.codProducto+'</td><td>'+$item.producto+'</td><td>'+$item.nroSacos+'</td><td>'+$item.sacosKilos+'</td><td>'+$item.precio+'</td><td>'+parseFloat($item.precio * $item.nroSacos).toFixed(2)+'</td><td><button class="btn btn-danger btn-xs quitar" index="'+$index+'"><span class="glyphicon glyphicon-remove"></span> Quitar</button></td></tr>');
            });

        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
}

$('.actualizarVenta').on('click',function(e){
    e.preventDefault();

    $botonPresionado = 'actualizar';

    //var id = $(this).attr('id');
    //$('.confirmar').attr('id',id);
    $('.confirmar').attr('estado','actualizar');
    $('#modal-confirmacion').modal('show');
});

$('#actualizarVenta').on('submit',function(e){
    e.preventDefault();
    var datos = $('#actualizarVenta');
    var url = datos.attr('action');

    $.post(url,datos.serialize() + "&" + $.param({'items':$items}),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-confirmacion').modal('hide');
            $('#modal-exito').modal('show')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        $('#msg-error').html('')
        $('#msg-error').fadeIn();
        $.each(data.responseJSON.errors, function( index, value ) {
            $('#msg-error').append(value)
            console.log( index + ": " + value );
        });

        // if(data.responseJSON.errors.nro_sacos_procesar)
        // {
        //     $('input[name=nro_sacos_procesar]').parent().addClass('has-error')
        // }else{
        //     $('input[name=nro_sacos_procesar]').parent().removeClass('has-error')
        // }
    });
});

$('#filtroVenta').on('submit',function(e){
    e.preventDefault();
    var datos = $('#filtroVenta');
    var url = datos.attr('action');
    console.log(url);
    $.get(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        $('#tabla').html(data.html)
    }).error(function(data){
        // $('#msg-error').html('')
        // $('#msg-error').fadeIn();
        // $.each(data.responseJSON.errors, function( index, value ) {
        //     $('#msg-error').append(value)
        //     console.log( index + ": " + value );
        // });
    });
});

$('#filtroVenta').on('reset',function(e){
    e.preventDefault();
    $('select[name=filtro]').val(null);
    $('input[name=buscador]').val(null);

    var datos = $('#filtroVenta');
    var url = datos.attr('action');
    console.log(url);
    $.get(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        $('#tabla').html(data.html)
    }).error(function(data){
        // $('#msg-error').html('')
        // $('#msg-error').fadeIn();
        // $.each(data.responseJSON.errors, function( index, value ) {
        //     $('#msg-error').append(value)
        //     console.log( index + ": " + value );
        // });
    });

});



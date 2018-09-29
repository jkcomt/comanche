$(document).ready(function() {
    $('#msg-error').hide();


    $ruta = window.location.pathname
    $array = $ruta.split('/')
    if($array[2] == "edit"){
        listarResultados($('input[name=nueva_produccion_id]').val());
    }
});

$sacos_stock_inicial = $('input[name=nro_sacos_stock_inicial]').val();
$('input[name=nro_sacos_procesar]').on('change keyup',function(e) {
    e.preventDefault();
    $nrosacos = $(this).val();
    $resultado = $sacos_stock_inicial - $nrosacos;
    if($resultado >= 0)
    {
        $('label[for=nro_sacos_procesar]').text('Sacos a procesar: ')
        $(this).parent().removeClass('has-error');

        $kiloPorSacos = $('input[name=kilo_por_sacos]').val();

        $('input[name=kilos_sacos_procesar]').val($nrosacos * $kiloPorSacos);

        $('input[name=nro_sacos_saldo]').val($resultado);
        $('input[name=kilos_sacos_saldo]').val($resultado * $kiloPorSacos);

    }else if($nrosacos > $sacos_stock_inicial){

        $('label[for=nro_sacos_procesar]').text('Max. '+$sacos_stock_inicial)
        $(this).parent().addClass('has-error');
    }
});

$('input[name=precio_maquila]').on('change keyup',function(e){
    e.preventDefault();
    $nroSacos = $('input[name=nro_sacos]').val();
    $precioMaquila = $(this).val();
    $subTotal = parseFloat($nroSacos).toFixed(2) * parseFloat($precioMaquila).toFixed(2);

   $('input[name=sub_total_maquila]').val($subTotal);

});

$('input[name=precio_envase]').on('change keyup',function(e){
    e.preventDefault();
    $nroEnvases = $('input[name=nro_envases]').val();
    $precioEnvase = $(this).val();
    $subTotal = parseFloat($nroEnvases).toFixed(2) * parseFloat($precioEnvase).toFixed(2);

    $('input[name=sub_total_envases]').val($subTotal);

});

$('input[name=cobro_adicional]').on('change keyup',function(e){
    e.preventDefault();
    $nroSacos = $('input[name=nro_sacos]').val();
    $adicional = $(this).val();
    $subTotal = parseFloat($adicional).toFixed(2) * parseFloat($nroSacos).toFixed(2);

    $('input[name=sub_total_adicional]').val($subTotal);

});

$items = [];

$('button[name=add]').on('click',function(e){
    e.preventDefault();

    $producto = $('select[name=producto] option:selected').text();
    $nroSacos = $('input[name=nro_sacos]').val();
    $sacosKilos = $('input[name=sacos_kilos]').val();
    $precioMaquila = $('input[name=precio_maquila]').val();
    $subTotal = $('input[name=sub_total_maquila]').val();
    $nroEnvases = $('input[name=nro_envases]').val();
    $envase = $('select[name=envase] option:selected').text();
    $precioEnvase = $('input[name=precio_envase]').val();
    $subTotalEnvases = $('input[name=sub_total_envases]').val();

    $adicional = $('input[name=cobro_adicional]').val();
    $subTotalAdicional = $('input[name=sub_total_adicional]').val();

    $item = {
        producto: $producto,
        nroSacos: $nroSacos,
        sacosKilos: $sacosKilos,
        precioMaquila: $precioMaquila,
        subTotal: $subTotal,
        nroEnvases : $nroEnvases,
        envase: $envase,
        precioEnvase: $precioEnvase,
        subTotalEnvases: $subTotalEnvases,
        adicional: $adicional,
        subTotalAdicional: $subTotalAdicional
    };

    $igual = false;
    if($items.length == 0)
    {
        $items.push($item);
        $index = $items.indexOf($item);
        console.log($items);
        $('#tabla tbody').append('<tr><td>'+$producto+'</td><td>'+$nroSacos+'</td><td>'+$sacosKilos+'</td><td>'+$precioMaquila+'</td><td>'+$nroEnvases+'</td><td>'+$envase+'</td><td>'+$precioEnvase+'</td><td>'+$subTotal+'</td><td>'+$subTotalEnvases+'</td><td>'+$subTotalAdicional+'</td><td><button class="btn btn-danger btn-xs quitar" index="'+$index+'"><span class="glyphicon glyphicon-remove"></span> Quitar</button></td></tr>');

        $('input[name=nro_sacos]').val('');
        $('input[name=sacos_kilos]').val('');
        $('input[name=precio_maquila]').val('');
        $('input[name=sub_total_maquila]').val('');
        $('input[name=nro_envases]').val('');
        // $('select[name=envase] option:selected').text();
        $('input[name=precio_envase]').val('');
        $('input[name=sub_total_envases]').val('');

        $('input[name=cobro_adicional]').val('');
        $('input[name=sub_total_adicional]').val('');
    }else{
        for(var i = 0;i < $items.length; i++){
            if($items[i].producto == $item.producto){
                // console.log($items[i].producto+'es igual'+$item.producto)
                $igual = true;
            }
        }
        if(!$igual){
            $items.push($item);
            console.log($items);
            $index = $items.indexOf($item);
            $('#tabla tbody').append('<tr><td>'+$producto+'</td><td>'+$nroSacos+'</td><td>'+$sacosKilos+'</td><td>'+$precioMaquila+'</td><td>'+$nroEnvases+'</td><td>'+$envase+'</td><td>'+$precioEnvase+'</td><td>'+$subTotal+'</td><td>'+$subTotalEnvases+'</td><td>'+$subTotalAdicional+'</td><td><button class="btn btn-danger btn-xs quitar" index="'+$index+'"><span class="glyphicon glyphicon-remove"></span> Quitar</button></td></tr>');

            $('input[name=nro_sacos]').val('');
            $('input[name=sacos_kilos]').val('');
            $('input[name=precio_maquila]').val('');
            $('input[name=sub_total_maquila]').val('');
            $('input[name=nro_envases]').val('');
            // $('select[name=envase] option:selected').text();
            $('input[name=precio_envase]').val('');
            $('input[name=sub_total_envases]').val('');

            $('input[name=cobro_adicional]').val('');
            $('input[name=sub_total_adicional]').val('');
        }
    }

    totales();
    //console.log($producto+' '+$nroSacos+' '+$sacosKilos+' '+$precioMaquila+' '+$subTotal+' '+$nroEnvases+' '+$envase+' '+$precioEnvase+' '+$subTotalEnvases);
    // $('select[name=producto] option:selected').text();


});

$('body').on('click','tr .quitar',function(e){
    e.preventDefault();
    //$items.splice($(this).attr('index'),1);
    $tr = $(this).parent().parent();
    $tr.each(function(){
       var $tds = $(this).find('td');
       if($tds.length != 0){
           $producto = $tds.eq(0).text();
           $nroSacos = $tds.eq(1).text();
           $sacosKilos = $tds.eq(2).text();
           $precioMaquila = $tds.eq(3).text();
           $subTotal = $tds.eq(4).text();
           $nroEnvases = $tds.eq(5).text();
           $envase = $tds.eq(6).text();
           $precioEnvase= $tds.eq(7).text();
           $subTotalEnvases= $tds.eq(8).text();

           $item = {
               producto: $producto,
               nroSacos: $nroSacos,
               sacosKilos: $sacosKilos,
               precioMaquila: $precioMaquila,
               subTotal: $subTotal,
               nroEnvases : $nroEnvases,
               envase: $envase,
               precioEnvase: $precioEnvase,
               subTotalEnvases: $subTotalEnvases,
               //adicional: $adicional,
               //subTotalAdicional: $subTotalAdicional
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
    $resultadoSubtTotalMaquila = 0;
    $resultadoSubtTotalenvase = 0;
    $resultadoSubtTotaladicional = 0;
    for(var i = 0;i < $items.length; i++){
        $resultadoSubtTotalMaquila = parseFloat($resultadoSubtTotalMaquila) + parseFloat($items[i].subTotal);
        $resultadoSubtTotalenvase = parseFloat($resultadoSubtTotalenvase) + parseFloat($items[i].subTotalEnvases);
        $resultadoSubtTotaladicional = parseFloat($resultadoSubtTotaladicional) + parseFloat($items[i].subTotalAdicional);

    }

    $('label[name=produccion]').text('S/ '+$resultadoSubtTotalMaquila);
    $('label[name=envases]').text('S/ '+$resultadoSubtTotalenvase);
    $('label[name=adicional]').text('S/ '+$resultadoSubtTotaladicional);

    $resultadoTotal = parseFloat($resultadoSubtTotalMaquila) + parseFloat($resultadoSubtTotalenvase) + parseFloat($resultadoSubtTotaladicional);

    $('label[name=total]').text('S/ '+$resultadoTotal);
}

$('#registrarSalidaProduccion').submit(function(event) {
    event.preventDefault();
    var datos = $('#registrarSalidaProduccion');
    var url = datos.attr('action');

    $.post(url,datos.serialize() + "&" + $.param({'items':$items}),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
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
        })

        if(data.responseJSON.errors.nro_sacos_procesar)
        {
            $('input[name=nro_sacos_procesar]').parent().addClass('has-error')
        }else{
            $('input[name=nro_sacos_procesar]').parent().removeClass('has-error')
        }
        //
        // if(data.responseJSON.errors.nombres)
        // {
        //     $('input[name=nombres]').parent().addClass('has-error')
        //     console.log(data.responseJSON.errors.nombres)
        // }else{
        //     $('input[name=nombres]').parent().removeClass('has-error')
        // }
        // if(data.responseJSON.errors.dni)
        // {
        //     $('input[name=dni]').parent().addClass('has-error')
        //     $('label[for=dni]').html('DNI: '+data.responseJSON.errors.dni);
        //     console.log(data.responseJSON.errors.dni)
        // }else{
        //     $('input[name=dni]').parent().removeClass('has-error')
        //     $('label[for=dni]').html('DNI: ');
        // }
        //
        // if(data.responseJSON.errors.celular)
        // {
        //     $('input[name=celular]').parent().addClass('has-error')
        //     $('label[for=celular]').html('Celular: '+data.responseJSON.errors.celular);
        //     console.log(data.responseJSON.errors.celular)
        // }else{
        //     $('input[name=celular]').parent().removeClass('has-error')
        //     $('label[for=celular]').html('Celular: ')
        // }
        //
        // if(data.responseJSON.errors.email)
        // {
        //     $('input[name=email]').parent().addClass('has-error')
        //     $('label[for=email]').html('E-mail: El email ya está registrado');
        //     console.log(data.responseJSON.errors.email)
        // }else{
        //     $('input[name=email]').parent().removeClass('has-error')
        //     $('label[for=email]').html('E-mail: ')
        // }
    });
});

$('#actualizarNuevaProduccion').submit(function(event) {
    event.preventDefault();
    var datos = $('#actualizarNuevaProduccion');
    var url = datos.attr('action');
    console.log($items);
    $.post(url,datos.serialize() + "&" + $.param({'items':$items}),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
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
        //
        // if(data.responseJSON.errors.nombres)
        // {
        //     $('input[name=nombres]').parent().addClass('has-error')
        //     console.log(data.responseJSON.errors.nombres)
        // }else{
        //     $('input[name=nombres]').parent().removeClass('has-error')
        // }
        // if(data.responseJSON.errors.dni)
        // {
        //     $('input[name=dni]').parent().addClass('has-error')
        //     $('label[for=dni]').html('DNI: '+data.responseJSON.errors.dni);
        //     console.log(data.responseJSON.errors.dni)
        // }else{
        //     $('input[name=dni]').parent().removeClass('has-error')
        //     $('label[for=dni]').html('DNI: ');
        // }
        //
        // if(data.responseJSON.errors.celular)
        // {
        //     $('input[name=celular]').parent().addClass('has-error')
        //     $('label[for=celular]').html('Celular: '+data.responseJSON.errors.celular);
        //     console.log(data.responseJSON.errors.celular)
        // }else{
        //     $('input[name=celular]').parent().removeClass('has-error')
        //     $('label[for=celular]').html('Celular: ')
        // }
        //
        // if(data.responseJSON.errors.email)
        // {
        //     $('input[name=email]').parent().addClass('has-error')
        //     $('label[for=email]').html('E-mail: El email ya está registrado');
        //     console.log(data.responseJSON.errors.email)
        // }else{
        //     $('input[name=email]').parent().removeClass('has-error')
        //     $('label[for=email]').html('E-mail: ')
        // }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();

    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/nueva_produccion/delete"

    console.log(id)
    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){

            console.log(data.responseJSON)
            $('#modal-confirmacion').modal('hide')
            $('#modal-exito').modal('show')

        },
        error: function(data){
            console.log(data.responseJSON)
        }
    });
});

$('body').on('click','.delete',function (e) {
    e.preventDefault();

    $botonPresionado = "eliminar"

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('#modal-confirmacion').modal({
        show:true,
        keyboard:false
    })
});

$totalMaquila = 0;
$totalEnvases = 0;
$resultado = 0;

$('body').on('click','.detalle',function(e){
    e.preventDefault();
    var id = $(this).attr('value');

    var url = "/nueva_produccion/"+id+"/detalle"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            console.log(data)
            // $('#update').attr('value',data.id)
            $('#detalleSalidaProduccion input[name=nro_guia_nueva_produccion]').val(data.nro_guia_salida)
            $('#detalleSalidaProduccion input[name=fecha]').val(data.fecha)
            $('#detalleSalidaProduccion input[name=hora]').val(data.hora)

            $('#detalleSalidaProduccion input[name=nro_sacos_stock_inicial]').val(data.nro_sacos_stock_inicial)
            $('#detalleSalidaProduccion input[name=kilos_totales_stock_inicial]').val(data.kilos_total_inicial)

            $('#detalleSalidaProduccion input[name=nro_sacos_procesar]').val(data.nro_sacos_a_procesar)
            $('#detalleSalidaProduccion input[name=kilos_sacos_procesar]').val(data.kilos_a_procesar)

            $('#detalleSalidaProduccion input[name=nro_sacos_saldo]').val(data.nro_sacos_saldo)
            $('#detalleSalidaProduccion input[name=kilos_sacos_saldo]').val(data.kilos_total_saldo)


            $('#tabla > tbody').html('');
            $totalMaquila = 0;
            $totalEnvases = 0;
            $totalAdicional = 0;
            $resultado = 0;
            $subTotalesMaquila  = [];
            $subTotalesEnvase  = [];
            $subTotalesAdicional  = [];
            $.each(data.resultado_produccion,function(index,value){
                $('#tabla tbody').append('<tr><td>'+value.producto+'</td><td>'+value.nro_sacos+'</td><td>'+value.kilos+'</td><td>'+value.precio_maquila+'</td><td>'+value.nro_envases+'</td><td>'+value.envase+'</td><td>'+value.precio_envase+'</td><td>'+value.sub_total_maquila+'</td><td>'+value.sub_total_envase+'</td><td>'+value.sub_total_adicional+'</td></tr>');
                $subTotalesMaquila.push(parseFloat(value.sub_total_maquila).toFixed(2))
                $subTotalesEnvase.push(parseFloat(value.sub_total_envase).toFixed(2))
                $subTotalesAdicional.push(parseFloat(value.sub_total_adicional).toFixed(2))
            });

            $.each($subTotalesMaquila ,function($i,$item)
            {
                $totalMaquila = parseFloat($totalMaquila) + parseFloat($item);
                $totalMaquila = parseFloat($totalMaquila).toFixed(2)
            });

            $.each($subTotalesEnvase ,function($i,$item)
            {
                $totalEnvases = parseFloat($totalEnvases) + parseFloat($item);
                $totalEnvases = parseFloat($totalEnvases).toFixed(2)
            });

            $.each($subTotalesAdicional ,function($i,$item)
            {
                $totalAdicional = parseFloat($totalAdicional) + parseFloat($item);
                $totalAdicional = parseFloat($totalAdicional).toFixed(2)
            });

            $resultado = (parseFloat($totalMaquila) + parseFloat($totalEnvases) + parseFloat($totalAdicional))
            $resultado = parseFloat($resultado).toFixed(2);


            $('#detalleSalidaProduccion label[name=produccion]').text("S/ "+$totalMaquila);
            $('#detalleSalidaProduccion label[name=envases]').text("S/ "+$totalEnvases);
            $('#detalleSalidaProduccion label[name=adicional]').text("S/ "+$totalAdicional);
            $('#detalleSalidaProduccion label[name=total]').text("S/ "+$resultado);

            $('#modal-nuevaproduccion-detalle').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

function listarResultados(id){
    var url = "/resultado_produccion/"+id+"/listar";
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",

        success: function(data){
            //$('#update').attr('value',data.id)
            console.log(data)
            $item = {};
            var produccionMaquilaSuma = 0;
            $sumaEnvases = 0;
            $sumaAdicional = 0;
            $total = 0;
                $.each(data, function( index, value ) {
                $item = {
                    producto: data[index].producto,
                    nroSacos: data[index].nro_sacos,
                    sacosKilos: data[index].kilos,
                    precioMaquila: data[index].precio_maquila,
                    subTotal: data[index].sub_total_maquila,
                    nroEnvases : data[index].nro_envases,
                    envase: data[index].envase,
                    precioEnvase: data[index].precio_envase,
                    subTotalEnvases: data[index].sub_total_envase,
                    adicional: data[index].adicional,
                    subTotalAdicional: data[index].sub_total_adicional
                };

                $items.push($item);
                $index = $items.indexOf($item);

                console.log($item.subTotal+' '+produccionMaquilaSuma);
                produccionMaquilaSuma = parseFloat(produccionMaquilaSuma)+parseFloat($item.subTotal);
                $sumaEnvases = parseFloat($sumaEnvases) + parseFloat($item.subTotalEnvases);
                $sumaAdicional = parseFloat($sumaAdicional) + parseFloat($item.subTotalAdicional);
                console.log(produccionMaquilaSuma)
                $total = parseFloat(produccionMaquilaSuma)+parseFloat($sumaEnvases)+parseFloat($sumaAdicional);


                $('#tabla tbody').append('<tr><td>'+$item.producto+'</td><td>'+$item.nroSacos+'</td><td>'+$item.sacosKilos+'</td><td>'+$item.precioMaquila+'</td><td>'+$item.nroEnvases+'</td><td>'+$item.envase+'</td><td>'+$item.precioEnvase+'</td><td>'+$item.subTotal+'</td><td>'+$item.subTotalEnvases+'</td><td>'+$item.subTotalAdicional+'</td><td><button class="btn btn-danger btn-xs quitar" index="'+$index+'"><span class="glyphicon glyphicon-remove"></span> Quitar</button></td></tr>');
            });

            $('#actualizarNuevaProduccion label[name=produccion]').text('S/ '+parseFloat(produccionMaquilaSuma).toFixed(2));
            $('#actualizarNuevaProduccion label[name=envases]').text('S/ '+parseFloat($sumaEnvases).toFixed(2));
            $('#actualizarNuevaProduccion label[name=adicional]').text('S/ '+parseFloat($sumaAdicional).toFixed(2));
            $('#actualizarNuevaProduccion label[name=total]').text('S/ '+parseFloat($total).toFixed(2));

            //console.log($produccionMaquilaSuma+' '+$sumaEnvases+' '+$total);
            //$igual = false;

        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
}

$('#buscarNuevaPro').on('keyup',function(){
    valor = $(this).val();
    $id = $('#idIngresoProduccion').val();
    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/nueva_produccion/buscar";
    $.ajax({
        type:"get",
        headers: {'X-CSRF-TOKEN':token},
        url:url,
        dataType:"json",
        data:{
            buscar : valor,
            id : $id
        },
        success: function(data){
            $('#tabla2').html(data.html)

            //console.log(data.html);
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$(document).ready(function() {
    $('#msg-error').hide();
});
$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();
    location.reload()
});

$('input[name=nro_sacos_recogidos]').on('change keyup',function(e){

    $nroSacosTendido = $('input[name=nroSacosTendidos]').val();

    $nroSacosRecogidosAnteriormente = $('input[name=nro_saco_recogidos_anteriormente]').val();

    $diferencia = parseInt($nroSacosTendido) - parseInt($nroSacosRecogidosAnteriormente)

    $nroSacosRecogidos = $(this).val();

    if($nroSacosRecogidos > $diferencia){
        $('input[name=nro_sacos_recogidos]').parent().addClass('has-error');
        $('label[for=nro_sacos_recogidos]').text('Nro. Sacos Recogidos: Ingrese un valor menor')

    }else{
        $('input[name=nro_sacos_recogidos]').parent().removeClass('has-error')
        $('label[for=nro_sacos_recogidos]').text('Nro. Sacos Recogidos:')
        $kilosRecogidos = $('input[name=kilos_recogidos]').val();
        $('input[name=pesos_recogidos]').val(parseFloat($nroSacosRecogidos * $kilosRecogidos).toFixed(2))
    }
});

$('input[name=kilos_recogidos]').on('change keyup',function(e){
    $kilosRecogidos = $(this).val();
    $nroSacosRecogidos = $('input[name=nro_sacos_recogidos]').val();
    $('input[name=pesos_recogidos]').val(parseFloat($nroSacosRecogidos * $kilosRecogidos).toFixed(2))


    $sumatotalpesorecojo = $('input[name=sumatotalrecojos]').val();
    $sumatotalpesorecojo = parseFloat($sumatotalpesorecojo + 1).toFixed(2);

    $pesorealrecepcion = parseFloat($('input[name=pesorealrecepcion]').val()).toFixed(2);

    $peso_recogido = parseFloat($nroSacosRecogidos * $kilosRecogidos).toFixed(2);

    $total = (parseFloat($sumatotalpesorecojo) + parseFloat($peso_recogido));

    /*console.log('peso real recepcion '+$pesorealrecepcion)
    console.log('suma total peso recojo actual'+$sumatotalpesorecojo);
    console.log('peso recogido '+$peso_recogido);
    console.log('total '+$total);*/

    if($total > $pesorealrecepcion)
    {
        //console.log("se pasó "+$pesorealrecepcion)

        $('input[name=pesos_recogidos]').parent().addClass('has-error')
        $('label[for=pesos_recogidos]').text('Peso Recogidos (Kg): Se excedió el peso real')
    }else{
        $('input[name=pesos_recogidos]').parent().removeClass('has-error')
        $('label[for=pesos_recogidos]').text('Peso Recogidos (Kg): ')
    }

});
/*
$('input[name=pesos_recogidos]').on('change',function(e) {
    //e.preventDefault();
    $sumatotalpesorecojo = $('input[name=sumatotalrecojos]').val();
    $peso_recogido = $(this).val();
    $total = parseFloat($sumatotalpesorecojo).toFixed(2) + parseFloat($peso_recogido).toFixed(2);
    console.log('total '+$total);
});*/


$('input[name=nro_sacos_no_recogidos]').on('change keyup',function(e){
    $nroSacosNoRecogidos = $(this).val();
    $kilosNoRecogidos = $('input[name=kilos_no_recogidos]').val();
    $('input[name=peso_no_recogido]').val(parseFloat($nroSacosNoRecogidos * $kilosNoRecogidos).toFixed(2))

});

$('input[name=kilos_no_recogidos]').on('change keyup',function(e){
    $kilosNoRecogidos = $(this).val();
    $nroSacosNoRecogidos = $('input[name=nro_sacos_no_recogidos]').val();
    $('input[name=peso_no_recogido]').val(parseFloat($nroSacosNoRecogidos * $kilosNoRecogidos).toFixed(2))
});

$('input[name=importe_sacos]').on('change keyup',function (e) {
   $importe = $(this).val()
   $nroSacosRecogidos = $('input[name=nro_sacos_recogidos]').val();
   $('input[name=importe_total]').val(parseFloat($importe * $nroSacosRecogidos).toFixed(2))
});

$('#registrarRecojo').submit(function(e){
    e.preventDefault();

    var datos = $('#registrarRecojo');
    var url = datos.attr('action');
    console.log(url)

    $nroSacosRecogidos = $('input[name=nro_sacos_recogidos]').val();
    $nroSacosTendido = $('input[name=nroSacosTendidos]').val();
    $nroSacosRecogidosAnteriormente = $('input[name=nro_saco_recogidos_anteriormente]').val();

    $total = parseInt($nroSacosRecogidos) + parseInt($nroSacosRecogidosAnteriormente);
    if($total > $nroSacosTendido){
        $('input[name=nro_sacos_recogidos]').parent().addClass('has-error')
        $('label[for=nro_sacos_recogidos]').text('Nro. Sacos Recogidos: Ingrese un valor menor')
        return;
    }else{
        $('input[name=nro_sacos_recogidos]').parent().removeClass('has-error')
    }


    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            console.log(data)
            $('#modal-exito').modal('show')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        $('#msg-error').fadeIn();
        //console.log(data)
        if(data.responseJSON.errors.nro_sacos_recogidos)
        {
            $('input[name=nro_sacos_recogidos]').parent().addClass('has-error')
        }else{
            $('input[name=nro_sacos_recogidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.kilos_recogidos)
        {
            $('input[name=kilos_recogidos]').parent().addClass('has-error')
        }else{
            $('input[name=kilos_recogidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nro_sacos_no_recogidos)
        {
            $('input[name=nro_sacos_no_recogidos]').parent().addClass('has-error')
        }else{
            $('input[name=nro_sacos_no_recogidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.kilos_no_recogidos)
        {
            $('input[name=kilos_no_recogidos]').parent().addClass('has-error')
        }else{
            $('input[name=kilos_no_recogidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.importe_sacos)
        {
            $('input[name=importe_sacos]').parent().addClass('has-error')
        }else{
            $('input[name=importe_sacos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.humedad_al_recoger)
        {
            $('input[name=humedad_al_recoger]').parent().addClass('has-error')
        }else{
            $('input[name=humedad_al_recoger]').parent().removeClass('has-error')
        }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    $estado = $(this).attr('estado')
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')

        var url = "/recojo/delete"

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

});

$('body').on('click','.delete',function (e) {
    e.preventDefault();

    $botonPresionado = 'eliminar'

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('.confirmar').attr('estado','eliminar')
    $('#modal-confirmacion').modal('show')
});

$('body').on('click','.detalle',function(e){
    e.preventDefault();
    console.log('click')
    var id = $(this).attr('value');

    var url = "/recojo/"+id+"/detalle"
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
            $('input[name=nro_guia_recojo]').val(data.nro_guia_recojo)
            $('input[name=fecha_recojo]').val(data.fecha+' '+data.hora)
            $('input[name=nro_sacos_recogidos]').val(data.nro_sacos_recogidos)
            $('input[name=kilos_recogidos]').val(data.kilos_recogidos)
            $('input[name=pesos_recogidos]').val(data.peso_recogidos)
            $('input[name=nro_sacos_no_recogidos]').val(data.nro_sacos_no_recogidos)
            $('input[name=kilos_no_recogidos]').val(data.kilos_no_recogidos)
            $('input[name=peso_no_recogido]').val(data.peso_no_recogido)
            $('input[name=importe_sacos]').val(data.importe_sacos)
            $('input[name=importe_total]').val(data.importe_total)
            $('input[name=humedad_al_recoger]').val(data.humedad_al_recoger)
            $('input[name=almacen]').val(data.almacen.nombre)
            $('textarea[name=observacion_recojo]').text(data.observacion)

            $('#modal-recojo-detalle').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#buscarRecojo').on('keyup',function(e){
    valor = $(this).val();
    id = $('input[name=idtendido]').val()
    e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/recojo/buscar"
    $.ajax({
        type:"get",
        headers: {'X-CSRF-TOKEN':token},
        url:url,
        dataType:"json",
        data:{
            buscar : valor,
            tendidoid : id
        },
        success: function(data){
            //console.log(data)
            $('#tabla').html(data.html)
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$botonPresionado = "";
$(document).keypress(function(e) {

    if(e.which == 13){
        return false;
    }
    // if(e.which == 13 && $botonPresionado == 'eliminar'){
    //     console.log("se presionó enter")
    //     console.log($botonPresionado)
    //     $('.confirmar').trigger('click')
    //     $botonPresionado = "volver"
    // }else if(e.which == 13 && $botonPresionado == 'volver'){
    //     console.log("se presionó enter")
    //     console.log($botonPresionado)
    //     location.reload();
    // }
});
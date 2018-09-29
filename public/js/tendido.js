$(document).ready(function() {
    $('#msg-error').hide();

    $( "#responsable" ).select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: $("#reloadResponsable").attr('url'),
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

    calculos()
});

$loteKilos = 0
function calculos()
{
    $nroSacosPendientes = $('input[name=sacos_pendientes]').val()
    $loteKilos = $('input[name=lote_kilos]').val()

    $('input[name=sacos_secar]').attr('max',$nroSacosPendientes);
    $kilosPendientes = parseFloat($nroSacosPendientes * $loteKilos).toFixed(2)

    $('input[name=kilos_pendientes]').val($kilosPendientes)
}

$('input[name=sacos_secar]').on('keyup',function (e) {
   $sacosSecar = $(this).val();
   $max = parseInt($(this).attr('max'))

    $restantes = $max - $sacosSecar
     $(this).parent().removeClass('has-error')
    if($sacosSecar == ""){
      $('#btnTendido').prop('disabled', true);
    }else{
      $('#btnTendido').prop('disabled', false);
    }

   if($sacosSecar > $max) {
       $('label[for=sacos_secar]').html('Nro Sacos a Secar: Max. ' + $max)

       $(this).parent().addClass('has-warning')
       $('input[name=kilos_secar]').val(0)
       $('input[name=sacos_restantes]').val(0)
       $('input[name=kilos_restantes]').val(0)
       $('#btnTendido').prop('disabled', true);

   }else if($sacosSecar<=0)
   {

       $('label[for=sacos_secar]').html('Nro Sacos a Secar: ')
       $(this).parent().removeClass('has-warning')

       $('input[name=kilos_secar]').val(0)

       $('input[name=sacos_restantes]').val(0)

       $('input[name=kilos_restantes]').val(0)

       $('#btnTendido').prop('disabled', false);
   }else{

       $('label[for=sacos_secar]').html('Nro Sacos a Secar: ')
       $(this).parent().removeClass('has-warning')

       $kilosSecar = parseFloat($sacosSecar * $loteKilos).toFixed(2)
       $('input[name=kilos_secar]').val($kilosSecar)

       $('input[name=sacos_restantes]').val($restantes)
       $kilosRestants = parseFloat($restantes * $loteKilos).toFixed(2)
       $('input[name=kilos_restantes]').val($kilosRestants)

       $('#btnTendido').prop('disabled', false);
   }


});


$('#addResponsable').on('click',function(e)
{
    e.preventDefault();
    $('#modal-responsable-nuevo input[name=apellidos]').parent().removeClass('has-error')
    $('#modal-responsable-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-responsable-nuevo input[name=dni]').parent().removeClass('has-error')
    $('#modal-responsable-nuevo input[name=celular]').parent().removeClass('has-error')
    $('label[for=celular]').html('Celular: ');
    $('label[for=dni]').html('DNI: ');
    $('#modal-responsable-nuevo').modal('show')
});

$('#submitRegistrarResponsable').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarResponsable');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-responsable-nuevo [name=apellidos]').val('')
            $('#modal-responsable-nuevo [name=nombres]').val('')
            $('#modal-responsable-nuevo [name=dni]').val('')
            $('#modal-responsable-nuevo [name=celular]').val('')
            $('#modal-responsable-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.apellidos)
        {
            $('#modal-responsable-nuevo input[name=apellidos]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#modal-responsable-nuevo input[name=apellidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nombres)
        {
            $('#modal-responsable-nuevo input[name=nombres]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.nombres)
        }else{
            $('#modal-responsable-nuevo input[name=nombres]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.dni)
        {
            $('#modal-responsable-nuevo input[name=dni]').parent().addClass('has-error')
            $('label[for=dni]').html('DNI: '+data.responseJSON.errors.dni);
            console.log(data.responseJSON.errors.dni)
        }else{
            $('#modal-responsable-nuevo input[name=dni]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.celular)
        {
            $('#modal-responsable-nuevo input[name=celular]').parent().addClass('has-error')
            $('label[for=celular]').html('Celular: '+data.responseJSON.errors.celular);
            console.log(data.responseJSON.errors.celular)
        }else{
            $('#modal-responsable-nuevo input[name=celular]').parent().removeClass('has-error')
        }
    });
});

$('#reloadResponsable').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadResponsable").attr('url')
    //console.log(url)
    $('#responsable').select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: url,
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
});

$('#registrarTendido').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarTendido');
    var url = datos.attr('action');
    console.log(url)
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-exito').modal('show')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        $('#msg-error').fadeIn();
        //console.log(data.responseJSON.errors)
        if(data.responseJSON.errors.responsable)
        {
            $('#responsableGroup').addClass('has-error')
            $('label[for=responsable]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#responsableGroup').removeClass('has-error')
            $('label[for=responsable]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.sacos_secar)
        {
            $('input[name=sacos_secar]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.sacos_secar)
        }else{
            $('input[name=sacos_secar]').parent().removeClass('has-error')
        }
    });
});

$('body').on('click','.detalle',function(e){
    e.preventDefault();
    var id = $(this).attr('value');

    var url = "/tendido/"+id+"/detalle"
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
            $('input[name=campana]').val(data.lote_secado.lote.compania)
            $('input[name=guia_lote]').val(data.lote_secado.lote.nro_guia)
            $('input[name=fecha_lote]').val(data.lote_secado.fecha+' '+data.lote_secado.hora)
            // if(data.lote_secado.lote.agricultor != null)
            // {
            //     $('label[for=cliente_lote]').text('Agricultor :')
            //     $('input[name=cliente_lote]').val(data.lote_secado.lote.agricultor.apellidos+' '+data.lote_secado.lote.agricultor.nombres+' '+data.lote_secado.lote.agricultor.dni)
            // }else if(data.lote_secado.lote.cliente != null)
            // {
            //     $('label[for=cliente_lote]').text('Cliente :')
            //     $('input[name=cliente_lote]').val(data.lote_secado.lote.cliente.apellidos+' '+data.lote_secado.lote.cliente.nombres+' '+data.lote_secado.lote.cliente.dni)
            // }

            // $('input[name=sacos_lote]').val(data.lote_secado.lote.nro_sacos)
            // $('input[name=lote_kilos]').val(data.lote_secado.lote.kilos)
            // $('input[name=peso_real_lote]').val(data.lote_secado.lote.peso_real)
            // $('input[name=variedad_lote]').val(data.lote_secado.lote.variedad.descripcion)

            $('input[name=nro_guia_tendido]').val(data.nro_guia_tendido)
            $('input[name=fecha_tendido]').val(data.fecha+' '+data.hora)
            $('input[name=responsable]').val(data.responsable.apellidos+' '+data.responsable.nombres)

            $('input[name=sacos_pendientes]').val(data.nro_sacos_pre_secado)
            $('input[name=kilos_pendientes]').val(data.kilos_pre_secado )
            $('input[name=sacos_secar]').val(data.nro_sacos_a_secar)
            $('input[name=kilos_secar]').val(data.kilos_a_secar)

            $('input[name=sacos_restantes]').val(data.nro_sacos_no_secado)
            $('input[name=kilos_restantes]').val(data.kilos_no_secado)
            // $('input[name=observacion]').val(data.observacion)

            $('textarea[name=observacion]').val(data.observacion)

            $('#modal-tendido-detalle').modal('show');
        },
        error: function(data){
            //alert("Error "+json.stringify(data))
        }
    });

});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')

    var url = "/tendido/delete"
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
    //s$('.confirmar').attr('estado','eliminar')
    $('#modal-confirmacion').modal('show')
});

$('#buscarTendido').on('keyup',function(e){
    valor = $(this).val();
    id = $('input[name=idlote]').val()
    e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/tendido/buscar"
    $.ajax({
        type:"get",
        headers: {'X-CSRF-TOKEN':token},
        url:url,
        dataType:"json",
        data:{
            buscar : valor,
            lotesecado : id
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

    if(e.which == 13 && $botonPresionado == 'eliminar'){
        console.log("se presionó enter")
        console.log($botonPresionado)
        $('.confirmar').trigger('click')
        $botonPresionado = "volver"
    }else if(e.which == 13 && $botonPresionado == 'volver'){
        console.log("se presionó enter")
        console.log($botonPresionado)
        location.reload();
    }
});

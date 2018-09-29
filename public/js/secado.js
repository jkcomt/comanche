$(document).ready(function() {
    $('#msg-error').hide();

    $('#filtro').trigger('change');
});

$filtro = "";
$('#filtro').on('change',function(e){
    e.preventDefault();
    $filtro = $(this).val();
});

$('#buscarSecado').on('keyup',function(){
    valor = $(this).val()

    $filtro = $('#filtro').val();
    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/secado/buscar"
    $.ajax({
        type:"get",
        headers: {'X-CSRF-TOKEN':token},
        url:url,
        dataType:"json",
        data:{
            buscar : valor,
            filtro : $filtro
        },
        success: function(data){
            $('#tabla').html(data.html)
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});


$('body').on('click','.detalle',function(e){
    e.preventDefault();
    console.log('click')
    var id = $(this).attr('value');

    var url = "/secado/"+id+"/detalle"
    var token = $('input[name=_token]').val()
    console.log(url)
    $.ajax({
        type:"get",
        headers: {'X-CSRF-TOKEN':token},
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            console.log(data.fecha)
            // $('#update').attr('value',data.id)
            $('input[name=campania]').val(data.compania)
            $('input[name=nro_guia]').val(data.nro_guia)
            $('input[name=fecha]').val(data.fecha+' - '+data.hora)
            if(data.agricultor != null)
            {
                $('label[name=lblCliente]').text('Agricultor :')
                $('#clienteAgricultor').val(data.agricultor.apellidos+' '+data.agricultor.nombres)
            }else if(data.cliente != null)
            {
                $('label[name=lblCliente]').text('Cliente :')
                $('#clienteAgricultor').val(data.cliente.apellidos+' '+data.cliente.nombres)
            }else if(data.empresa != null)
            {
                $('label[name=lblCliente]').text('Empresa :')
                $('#clienteAgricultor').val(data.empresa.razon_social)
            }
            $('#variedad').val(data.variedad.descripcion)
            // $('input[name=email]').val(data.email)
            //
            switch(data.tipo_peso){
                case 'sacos':
                    $('label[name=lblTipoPeso]').text('Saco')
                    $('label[name=lblPeso1]').text('Nro. Sacos:')
                    $('label[name=lblPeso2]').text('Kilos:')
                    $('label[name=lblPeso3]').text('Peso Real(Kg):')

                    $('input[name=nro_sacos]').val(data.nro_sacos)
                    $('input[name=kilos]').val(data.kilos)
                    $('input[name=pesoreal]').val(data.peso_real)
                    break;
                case 'kilos':
                    $('label[name=lblTipoPeso]').text('Kilos')
                    $('label[name=lblPeso1]').text('Peso Real(Kg):')
                    $('label[name=lblPeso2]').text('Nro. Sacos:')
                    $('label[name=lblPeso3]').text('Kilos:')
                    $('input[name=nro_sacos]').val(data.peso_real)
                    $('input[name=kilos]').val(data.nro_sacos)
                    $('input[name=pesoreal]').val(data.kilos)
                    break;
            }

            switch(data.tipo_flete){
                case 'fletePeso':
                    $('label[name=lblTipoFlete]').text('Peso')
                    break;
                case 'fleteSaco':
                    $('label[name=lblTipoFlete]').text('Saco')
                    break;
                case 'fleteTonelada':
                    $('label[name=lblTipoFlete]').text('Tonelada')
                    break;
            }

            switch(data.tipo_flete){
                case 'fletePeso':
                    $('label[name=lblTipoFlete]').text('Peso')
                    break;
                case 'fleteSaco':
                    $('label[name=lblTipoFlete]').text('Saco')
                    break;
                case 'fleteTonelada':
                    $('label[name=lblTipoFlete]').text('Tonelada')
                    break;
            }

            $('input[name=procedencia]').val(data.procedencia.lugar)

            $('label[name=pagadoPor]').text(data.pagado_por.ucfirst())

            $('input[name=fletexSaco]').val(data.flete_x_saco)
            $('input[name=fletexPeso]').val(data.flete_x_peso)
            $('input[name=fletexTonelada]').val(data.flete_x_tonelada)
            $('input[name=fletexTotal]').val(data.flete_total)
            $('input[name=chofer]').val(data.chofer.apellidos+' '+data.chofer.nombres)
            $('input[name=vehiculo]').val(data.vehiculo.marca+' '+data.vehiculo.descripcion+' '+data.vehiculo.placa)

            $('input[name=nro_sacos_mayor_13]').val(data.nro_humedad_mayor_13)
            if(data.nro_humedad_mayor_13 > 0){
                $('input[name=condicion_mayor_13]').val('Secado')
            }else{
                $('input[name=condicion_mayor_13]').val('Vacío')
            }

            $('input[name=nro_sacos_menor_13]').val(data.nro_humedad_menor_13)

            if(data.nro_humedad_menor_13 > 0){
                $('input[name=condicion_menor_13]').val('Producción')
            }else{
                $('input[name=condicion_menor_13]').val('Vacío')
            }

            $('textarea[name=observacion]').val(data.observacion)

            $('#modal-lote-detalle').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

String.prototype.ucfirst = function()
{
    return this.charAt(0).toUpperCase() + this.substr(1);
}

$(document).keypress(function(e) {

    if(e.which == 13)
    {
        return false;
    }
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    $estado = $(this).attr('estado')
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    console.log(id)
    if($estado == 'conforme'){
        console.log('conforme')
        var url = "/secado/conforme"

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

                console.log(data)
                $('#modal-exito .modal-body').html('<h3 class="text-success text-center">Cambio exitoso</h3>')
                $('#modal-confirmacion').modal('hide')
                $('#modal-exito').modal('show')
                console.log(id)



            },
            error: function (data) {
                console.log('error '+data.responseJSON)
            }
        });
    }
});

$('body').on('click','.conformidad',function(e){
    e.preventDefault();

    $botonPresionado = 'conforme'

    //console.log('click')
    $id = $(this).attr('loteSecado')
    console.log('id'+$id)
    $('.confirmar').attr('id',$id)
    $('#modal-confirmacion .modal-body').html('<h3 class="text-warning text-center">¿Está conforme con el Secado?</h3>')
    $('.confirmar').attr('estado','conforme')

    $('.confirmar').removeClass('btn-danger')
    $('.confirmar').addClass('btn-success')
    $('#modal-confirmacion').modal('show')
});

$(document).ready(function() {
    $('#msg-error').hide();

    $('#filtro').trigger('change');
});

$('body').on('click','.detalle',function(e){
    e.preventDefault();
    console.log('click')
    var id = $(this).attr('value');
    var prodId = $(this).attr('id');
    console.log(prodId);

    var url = "/produccion_ingreso/"+id+"/detalle"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            console.log(data);
            // $('#update').attr('value',data.id)
            $('input[name=campania]').val(data.compania)
            $('input[name=nro_guia]').val(data.nro_guia)
            $('input[name=fecha]').val(data.fecha+' - '+data.hora)
            $('input[name=area_origen]').val(data.procedencia.lugar)
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

            data.produccion_ingreso.forEach(function (row,index) {
                if(row.id == prodId){
                    $('input[name=nro_guia_ingreso]').val(row.nro_guia_ingreso)
                    $('input[name=fecha_ingreso]').val(row.fecha+' - '+row.hora)
                    $('input[name=area]').val(row.area_origen)
                    $('input[name=nro_sacos_ingreso]').val(row.nro_sacos_ingresados)
                    $('input[name=kilos_totales_ingreso]').val(parseFloat(row.kilo_por_saco * row.nro_sacos_ingresados))
                }
            });

            $('#modal-produccion-detalle').modal('show');
        },
        error: function(data){
            //alert("Error "+json.stringify(data))
        }
    });
});

$('#buscarProduccionIngreso').on('keyup',function(){
    valor = $(this).val();

    $filtro = $('#filtro').val();
    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/produccion_ingreso/buscar"
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

$filtro = "";
$('#filtro').on('change',function(e){
    e.preventDefault();
    $filtro = $(this).val();
});

$('body').on('click','.conformidad',function(e){
    e.preventDefault();

    $botonPresionado = 'conforme'

    //console.log('click')
    $id = $(this).attr('produccion')
    console.log('id'+$id)
    $('.confirmar').attr('id',$id)
    $('#modal-confirmacion .modal-body').html('<h3 class="text-warning text-center">¿Está conforme con la producción?</h3>')
    $('.confirmar').attr('estado','conforme')

    $('.confirmar').removeClass('btn-danger')
    $('.confirmar').addClass('btn-success')
    $('#modal-confirmacion').modal('show')
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    $estado = $(this).attr('estado')
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    if($estado == 'conforme'){
        var url = "/produccion_ingreso/conforme"
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
            },
            error: function (data) {
                console.log('error '+data.responseJSON)
            }
        });
    }
});


$('body').on('click','.cambiarPrecio',function(e){
    e.preventDefault();
    var id = $(this).attr('id');

    var url = "/stock_producto/"+id+"/buscar_item";
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            console.log(data);
            $('#stock-precio-edit .stockItemId').val(data.mensaje.id);
            //
            $('#stock-precio-edit .productoNombre').val(data.mensaje.descripcion_producto);
            $('#stock-precio-edit .precioProducto').val(data.mensaje.precio);
            $('#stock-precio-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#stock-frm-precio-update').on('submit',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    var datos = $('#stock-frm-precio-update');
    var url = datos.attr('action');

    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#tabla').html(data.html);
            $('#stock-precio-edit').modal('hide');
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        // if(data.responseJSON.errors.apellidos)
        // {
        //     $('#stock-precio-edit .precioProducto').parent().addClass('has-error')
        //     console.log(data.responseJSON.errors.apellidos)
        // }else{
        //     $('#stock-precio-edit .precioProducto').parent().removeClass('has-error')
        // }
    });
});
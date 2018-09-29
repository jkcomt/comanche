
$(document).ready(function() {

    $('#msg-error').hide();

    $( "#cliente" ).select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: $("#reloadCliente").attr('url'),
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

    $( "#variedad" ).select2({
        theme: "bootstrap"
    });

    $( "#procedencia" ).select2({
        theme: "bootstrap"
    });

    $( "#chofer" ).select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: $("#reloadChofer").attr('url'),
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

    $( "#vehiculo" ).select2({
        theme: "bootstrap",
        ajax: {
            dataType: 'json',
            url: $("#reloadVehiculo").attr('url'),
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

    valorPeso();

    valorTipoFlete();

    //$('#filtro option[value=guia]').attr('selected','selected');
    //$filtro = "guia";
    $('#filtro').trigger('change');

    //valorTipoAgri();

    //valorTipoCli();
});

$estadoCliente = ""

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();

    location.reload()

    //$('#modal-exito').modal('hide')


});

$('input[name="optradio"]').on('change',function()
{
    $estadoCliente = valorCliente();
    //console.log($estadoCliente)
    if($estadoCliente == "agricultor")
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
    if($estado == "agricultor")
    {
        $('#clienteGroup').hide();
        $('#agricultorGroup').show();
        $('#empresaGroup').hide();

        $('input[name=pagadopor]:checked').val('agricultor')
        $('label[for=pagadoporCliente]').html('Agricultor');
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

$('input[name="rbtipoPeso"]').on('change',function()
{
    $estadoPeso = valorPeso();
    //console.log($estadoCliente)
    if($estadoPeso == "sacos")
    {
        //console.log($estadoPeso)
        $('.kilos-grupo').hide();
        $('.sacos-grupo').show();

        $('input[name=kilos_pesoreal]').val('0')
        $('input[name=kilos_nro_sacos]').val('0')
        $('input[name=kilos_kilos]').val('0')

    }else if($estadoPeso == "kilos"){
        //console.log($estadoPeso)
        $('.kilos-grupo').show();
        $('.sacos-grupo').hide();

        $('input[name=nro_sacos]').val('0')
        $('input[name=kilos]').val('0')
        $('input[name=pesoreal]').val('0')
    }
});

function valorPeso(){
    $estado = $('input[name="rbtipoPeso"]:checked').val();
    //console.log($estado)
    if($estado == "sacos")
    {
        //console.log($estado)
        $('.kilos-grupo').hide();
        $('.sacos-grupo').show();

        $('input[name=kilos_pesoreal]').val('0')
        $('input[name=kilos_nro_sacos]').val('0')
        $('input[name=kilos_kilos]').val('0')

    }else if($estado == "kilos"){
        $('.kilos-grupo').show();
        $('.sacos-grupo').hide();

        $('input[name=nro_sacos]').val('0')
        $('input[name=kilos]').val('0')
        $('input[name=pesoreal]').val('0')
        //console.log($estado)
    }
    return $estado
}

$('#reloadCliente').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadCliente").attr('url')
    $('#cliente').select2({
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

$('#reloadAgricultor').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadAgricultor").attr('url')
    $('#agricultor').select2({
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

$('#reloadEmpresa').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadEmpresa").attr('url')
    $('#empresa').select2({
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

$('#reloadVariedad').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadVariedad").attr('url')
    $('#variedad').select2({
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

$('#reloadProcedencia').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadProcedencia").attr('url')
    $('#procedencia').select2({
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

$('#reloadChofer').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadChofer").attr('url')
    $('#chofer').select2({
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

$('#reloadVehiculo').on('click',function (e) {
    e.preventDefault();
    var url = $("#reloadVehiculo").attr('url')
    $('#vehiculo').select2({
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



$('#addCliente').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addCliente'
    $('#modal-cli-nuevo input[name=apellidos]').parent().removeClass('has-error')
    $('#modal-cli-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-cli-nuevo input[name=dni]').parent().removeClass('has-error')
    $('#modal-cli-nuevo label[for=dni]').html('DNI: ')
    $('#modal-cli-nuevo').modal('show')
});

$('#addAgricultor').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addAgricultor'

    $('#modal-agri-nuevo input[name=apellidos]').parent().removeClass('has-error')
    $('#modal-agri-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-agri-nuevo input[name=dni]').parent().removeClass('has-error')
    $('#modal-agri-nuevo label[for=dni]').html('DNI: ')
    $('#modal-agri-nuevo').modal('show')
});

$('#addEmpresa').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addEmpresa'

    $('#modal-empresa-nuevo input[name=razon_social]').parent().removeClass('has-error')
    $('#modal-empresa-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-empresa-nuevo input[name=ruc]').parent().removeClass('has-error')
    $('#modal-empresa-nuevo input[name=representante]').parent().removeClass('has-error')
    $('#modal-empresa-nuevo input[name=dni_representante]').parent().removeClass('has-error')

    $('#modal-empresa-nuevo label[for=ruc]').html('RUC: ')
    $('#modal-empresa-nuevo label[for=ruc]').html('RUC: ')
    $('#modal-empresa-nuevo label[for=ruc]').html('RUC: ')
    $('#modal-empresa-nuevo label[for=dni_representante]').html('DNI Representante: ')
    $('#modal-empresa-nuevo label[for=representante]').html('Representante: ')
    $('#modal-empresa-nuevo').modal('show')
});

$('#addVariedad').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addVariedad'
    $('#modal-variedad-nuevo input[name=descripcion]').parent().removeClass('has-error')
    $('#modal-variedad-nuevo').modal('show')
});

$('#addProcedencia').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addProcedencia'

    //console.log($botonPresionado)
    $('#modal-procedencia-nuevo input[name=lugar]').parent().removeClass('has-error')
    $('#modal-procedencia-nuevo').modal('show')
});

$('#addChofer').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addChofer'
    $('#modal-chofer-nuevo input[name=apellidos]').parent().removeClass('has-error')
    $('#modal-chofer-nuevo input[name=nombres]').parent().removeClass('has-error')
    $('#modal-chofer-nuevo input[name=dni]').parent().removeClass('has-error')
    $('#modal-chofer-nuevo label[for=dni]').html('DNI: ')
    $('#modal-chofer-nuevo').modal('show')
});

$('#addVehiculo').on('click',function(e)
{
    e.preventDefault();

    $botonPresionado = 'addVehiculo'

    $('#modal-vehiculo-nuevo input[name=marca]').parent().removeClass('has-error')
    $('#modal-vehiculo-nuevo input[name=descripcion]').parent().removeClass('has-error')
    $('#modal-vehiculo-nuevo input[name=placa]').parent().removeClass('has-error')
    $('#modal-vehiculo-nuevo label[for=placa]').html('Placa: ');
    $('#modal-vehiculo-nuevo').modal('show')
});

$('#submitRegistrarCliente').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarCliente');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-cli-nuevo [name=apellidos]').val('')
            $('#modal-cli-nuevo [name=nombres]').val('')
            $('#modal-cli-nuevo [name=dni]').val('')
            $('#modal-cli-nuevo [name=celular]').val('')
            $('#modal-cli-nuevo [name=direccion]').val('')
            $('#modal-cli-nuevo [name=email]').val('')
            $('#modal-cli-nuevo [name=ruc]').val('')
            $('#modal-cli-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.apellidos)
        {
            $('#modal-cli-nuevo input[name=apellidos]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#modal-cli-nuevo input[name=apellidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nombres)
        {
            $('#modal-cli-nuevo input[name=nombres]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.nombres)
        }else{
            $('#modal-cli-nuevo input[name=nombres]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.dni)
        {
            $('#modal-cli-nuevo input[name=dni]').parent().addClass('has-error')
            $('#modal-cli-nuevo label[for=dni]').html('DNI: '+data.responseJSON.errors.dni)
            console.log(data.responseJSON.errors.dni)
        }else{
            $('#modal-cli-nuevo input[name=dni]').parent().removeClass('has-error')
        }
		if(data.responseJSON.errors.email)
        {
            $('#modal-cli-nuevo input[name=email]').parent().addClass('has-error')
            $('#modal-cli-nuevo label[for=email]').html('E-mail: '+data.responseJSON.errors.email)
            console.log(data.responseJSON.errors.email)
        }else{
			$('#modal-cli-nuevo label[for=email]').html('E-mail:')
            $('#modal-cli-nuevo input[name=email]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.ruc)
        {
            $('#modal-cli-nuevo input[name=ruc]').parent().addClass('has-error')
            $('#modal-cli-nuevo label[for=ruc]').html('RUC: '+data.responseJSON.errors.ruc)
            console.log(data.responseJSON.errors.ruc)
        }else{
            $('#modal-cli-nuevo label[for=ruc]').html('RUC:')
            $('#modal-cli-nuevo input[name=ruc]').parent().removeClass('has-error')
        }
    });
});

$('#submitRegistrarAgricultor').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarAgricultor');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-agri-nuevo [name=apellidos]').val('')
            $('#modal-agri-nuevo [name=nombres]').val('')
            $('#modal-agri-nuevo [name=dni]').val('')
            $('#modal-agri-nuevo [name=celular]').val('')
            $('#modal-agri-nuevo [name=direccion]').val('')
            $('#modal-agri-nuevo [name=email]').val('')
            $('#modal-agri-nuevo [name=ruc]').val('')
            $('#modal-agri-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.apellidos)
        {
            $('#modal-agri-nuevo input[name=apellidos]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#modal-agri-nuevo input[name=apellidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nombres)
        {
            $('#modal-agri-nuevo input[name=nombres]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.nombres)
        }else{
            $('#modal-agri-nuevo input[name=nombres]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.dni)
        {
            $('#modal-agri-nuevo input[name=dni]').parent().addClass('has-error')
            $('#modal-agri-nuevo label[for=dni]').html('DNI: '+data.responseJSON.errors.dni)
            console.log(data.responseJSON.errors.dni)
        }else{
            $('#modal-agri-nuevo input[name=dni]').parent().removeClass('has-error')
            $('#modal-agri-nuevo label[for=dni]').html('DNI: ')
        }
		if(data.responseJSON.errors.email)
        {
            $('#modal-agri-nuevo input[name=email]').parent().addClass('has-error')
            $('#modal-agri-nuevo label[for=email]').html('EMAIL: '+data.responseJSON.errors.email)
            console.log(data.responseJSON.errors.email)
        }else{
            $('#modal-agri-nuevo input[name=email]').parent().removeClass('has-error')
            $('#modal-agri-nuevo label[for=email]').html('EMAIL: ')
        }
        if(data.responseJSON.errors.ruc)
        {
            $('#modal-agri-nuevo input[name=ruc]').parent().addClass('has-error')
            $('#modal-agri-nuevo label[for=ruc]').html('RUC: '+data.responseJSON.errors.ruc)
            console.log(data.responseJSON.errors.ruc)
        }else{
            $('#modal-agri-nuevo label[for=ruc]').html('RUC:')
            $('#modal-agri-nuevo input[name=ruc]').parent().removeClass('has-error')
        }
    });
});

$('#submitRegistrarEmpresa').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarEmpresa');
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
            $('#modal-empresa-nuevo').modal('hide')
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

$('#submitRegistrarVariedad').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarVariedad');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-variedad-nuevo [name=descripcion]').val('')
            $('#modal-variedad-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.descripcion)
        {
            $('#modal-variedad-nuevo [name=descripcion]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.descripcion)
        }else{
            $('#modal-variedad-nuevo [name=descripcion]').parent().removeClass('has-error')
        }
    });
});

$('#submitRegistrarProcedencia').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarProcedencia');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-procedencia-nuevo [name=lugar]').val('')
            $('#modal-procedencia-nuevo').modal('hide')
        }else{
            return false;
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.lugar)
        {
            $('#modal-procedencia-nuevo [name=lugar]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.lugar)
        }else{
            $('#modal-procedencia-nuevo [name=lugar]').parent().removeClass('has-error')
        }
    });
});

$('#submitRegistrarChofer').on('click',function(event)
{
    event.preventDefault();

    var datos = $('#registrarChofer');
    var url = datos.attr('action');
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            $('#modal-chofer-nuevo [name=apellidos]').val('')
            $('#modal-chofer-nuevo [name=nombres]').val('')
            $('#modal-chofer-nuevo [name=dni]').val('')
            $('#modal-chofer-nuevo [name=celular]').val('')
            $('#modal-chofer-nuevo [name=direccion]').val('')
            $('#modal-chofer-nuevo [name=email]').val('')
            $('#modal-chofer-nuevo').modal('hide')
        }else{
            console.log(data.error)
        }
    }).error(function(data){
        //$('#msg-error').fadeIn();
        if(data.responseJSON.errors.apellidos)
        {
            $('#modal-chofer-nuevo input[name=apellidos]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('#modal-chofer-nuevo input[name=apellidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nombres)
        {
            $('#modal-chofer-nuevo input[name=nombres]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.nombres)
        }else{
            $('#modal-chofer-nuevo input[name=nombres]').parent().removeClass('has-error')
        }
        if(data.responseJSON.errors.dni)
        {
            $('#modal-chofer-nuevo input[name=dni]').parent().addClass('has-error')
            $('#modal-chofer-nuevo label[for=dni]').html('DNI: '+data.responseJSON.errors.dni)
            console.log(data.responseJSON.errors.dni)
        }else{
            $('#modal-chofer-nuevo input[name=dni]').parent().removeClass('has-error')
        }
    });
});

function validarPlaca(placa)
{
    if(/\s/.test(placa)){
        $('input[name=placa]').parent().addClass('has-error')
        $('label[for=placa]').html('Placa: No se permiten espacios');
        return false;
    }else{
        $('input[name=placa]').parent().removeClass('has-error')
        $('label[for=placa]').html('Placa:');
        return true;
    }
}

$('#registrarVehiculo input[name=placa]').on('keypress',function(e){
   if(e.which == 32){
       return false;
   }
});

$('#submitRegistrarVehiculo').on('click',function(event)
{
    event.preventDefault();

    estadoPlaca = validarPlaca( $('input[name=placa]').val())

    if(estadoPlaca == true) {

        var datos = $('#registrarVehiculo');
        var url = datos.attr('action');

        $.post(url, datos.serialize(), function (result) {

        }).success(function (data) {
            if ($.isEmptyObject(data.error)) {
                $('#modal-vehiculo-nuevo input[name=marca]').val('')
                $('#modal-vehiculo-nuevo input[name=descripcion]').val('')
                $('#modal-vehiculo-nuevo input[name=placa]').val('')
                $('#modal-vehiculo-nuevo').modal('hide')
            } else {
                console.log(data.error)
            }
        }).error(function (data) {
            //$('#msg-error').fadeIn();
            if (data.responseJSON.errors.marca) {
                $('#modal-vehiculo-nuevo input[name=marca]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.marca)
            } else {
                $('#modal-vehiculo-nuevo input[name=marca]').parent().removeClass('has-error')
            }

            if (data.responseJSON.errors.descripcion) {
                $('#modal-vehiculo-nuevo input[name=descripcion]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.descripcion)
            } else {
                $('#modal-vehiculo-nuevo input[name=descripcion]').parent().removeClass('has-error')
            }
            if (data.responseJSON.errors.placa) {
                $('label[for=placa]').html('Placa: '+data.responseJSON.errors.placa);
                $('#modal-vehiculo-nuevo input[name=placa]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.placa)
            } else {
                $('#modal-vehiculo-nuevo input[name=placa]').parent().removeClass('has-error')
            }

        });
    }
});

$('input[name=nro_sacos],input[name=kilos]').on('change keyup',function(){
   var nroSacos =  $('input[name=nro_sacos]').val();
   var kilos =  $('input[name=kilos]').val();
   var pesoReal = nroSacos * kilos
    $('input[name=pesoreal]').val(parseFloat(pesoReal).toFixed(2))
   //console.log(nroSacos+' * '+kilos+' = '+pesoReal)
});

$('input[name=kilos_pesoreal],input[name=kilos_nro_sacos]').on('change keyup',function(){
    var pesoReal =  $('input[name=kilos_pesoreal]').val();
    var nroSacos =  $('input[name=kilos_nro_sacos]').val();
    var kilos = pesoReal / nroSacos
    $('input[name=kilos_kilos]').val(parseFloat(kilos).toFixed(2))
    //console.log(nroSacos+' * '+kilos+' = '+pesoReal)
});

$('input[name="rbtipoflete"]').on('change',function()
{
    $estadoTipoFlete = $(this).val();

    $valorFlete = 0

    $nroSacos = 0
    $pesoReal = 0
    $kilos = 0

    $tipoPeso = $('input[name=rbtipoPeso]:checked').val()

    $resultadoFleteTotal = 0

    if($tipoPeso == "sacos")
    {
        $nroSaco = $('input[name=nro_sacos]').val()
        $pesoReal = $('input[name=pesoreal]').val()
        $kilos = $('input[name=kilos]').val()
    }else if($tipoPeso == "kilos")
    {
        $nroSaco = $('input[name=kilos_nro_sacos]').val()
        $pesoReal = $('input[name=kilos_pesoreal]').val()
        $kilos = $('input[name=kilos_kilos]').val()
    }

    $valorFleteTotal = 0

    //console.log($estadoTipoFlete)
    switch ($estadoTipoFlete){
        case 'fleteSaco':
            $('input[name=fletexSaco]').removeAttr('readonly')

            $('input[name=fletexPeso]').val('0')
            $('input[name=fletexTonelada]').val('0')

            $('input[name=fletexPeso]').attr('readonly','readonly')
            $('input[name=fletexTonelada]').attr('readonly','readonly')

            $valorFlete = $('input[name=fletexSaco]').val()

            $resultadoFleteTotal = $valorFlete * $nroSaco

            //console.log($valorFlete)
            break;
        case 'fletePeso':
            $('input[name=fletexPeso]').removeAttr('readonly')

            $('input[name=fletexSaco]').val('0')
            $('input[name=fletexTonelada]').val('0')

            $('input[name=fletexSaco]').attr('readonly','readonly')
            $('input[name=fletexTonelada]').attr('readonly','readonly')

            $valorFlete = $('input[name=fletexPeso]').val()

            $resultadoFleteTotal = $valorFlete * $pesoReal

            //console.log($valorFlete)
            break;
        case 'fleteTonelada':
            $('input[name=fletexTonelada]').removeAttr('readonly')

            $('input[name=fletexSaco]').val('0')
            $('input[name=fletexPeso]').val('0')

            $('input[name=fletexSaco]').attr('readonly','readonly')
            $('input[name=fletexPeso]').attr('readonly','readonly')

            $valorFlete = $('input[name=fletexTonelada]').val()

            $resultadoFleteTotal = $valorFlete * $pesoReal

            //console.log($valorFlete)
            break;
        default:
            $('input[name=fletexSaco]').removeAttr('readonly')
            $('input[name=fletexPeso]').removeAttr('readonly')
            $('input[name=fletexTonelada]').removeAttr('readonly')
    }

    $('input[name=fletexTotal]').val(parseFloat($resultadoFleteTotal).toFixed(2))
});

function valorTipoFlete()
{
    $estadoTipoFlete = $('input[name="rbtipoflete"]:checked').val();

    $valorFlete = 0

    //console.log($estadoTipoFlete)
    switch ($estadoTipoFlete){
        case 'fleteSaco':
            $('input[name=fletexSaco]').removeAttr('readonly')

            $('input[name=fletexPeso]').val('0')
            $('input[name=fletexTonelada]').val('0')

            $('input[name=fletexPeso]').attr('readonly','readonly')
            $('input[name=fletexTonelada]').attr('readonly','readonly')

            $valorFlete = $('input[name=fletexSaco]').val()

            break;
        case 'fletePeso':
            $('input[name=fletexPeso]').removeAttr('readonly')

            $('input[name=fletexSaco]').val('0')
            $('input[name=fletexTonelada]').val('0')

            $('input[name=fletexSaco]').attr('readonly','readonly')
            $('input[name=fletexTonelada]').attr('readonly','readonly')

            $valorFlete = $('input[name=fletexPeso]').val()

            console.log($valorFlete)
            break;
        case 'fleteTonelada':
            $('input[name=fletexTonelada]').removeAttr('readonly')

            $('input[name=fletexSaco]').val('0')
            $('input[name=fletexPeso]').val('0')

            $('input[name=fletexSaco]').attr('readonly','readonly')
            $('input[name=fletexPeso]').attr('readonly','readonly')

            $valorFlete = $('input[name=fletexTonelada]').val()

            console.log($valorFlete)
            break;
        default:
            $('input[name=fletexPeso]').removeAttr('readonly')
            $('input[name=fletexTonelada]').removeAttr('readonly')
    }
}

$('input[name=fletexSaco],input[name=fletexPeso],input[name=fletexTonelada]').on('change keyup',function(e){
   e.preventDefault();

   $fletexSaco = $('input[name=fletexSaco]').val()
   $fletexPeso = $('input[name=fletexPeso]').val()
   $fletexTonelada = $('input[name=fletexTonelada]').val()

   $estadoTipoFlete = $('input[name="rbtipoflete"]:checked').val()

    $valorFlete = 0

    $nroSacos = 0
    $pesoReal = 0
    $kilos = 0

    $tipoPeso = $('input[name=rbtipoPeso]:checked').val()

    $resultadoFleteTotal = 0

    if($tipoPeso == "sacos")
    {
        $nroSaco = $('input[name=nro_sacos]').val()
        $pesoReal = $('input[name=pesoreal]').val()
        $kilos = $('input[name=kilos]').val()
    }else if($tipoPeso == "kilos")
    {
        $nroSaco = $('input[name=kilos_nro_sacos]').val()
        $pesoReal = $('input[name=kilos_pesoreal]').val()
        $kilos = $('input[name=kilos_kilos]').val()
    }

    $valorFleteTotal = 0

    switch ($estadoTipoFlete){
        case 'fleteSaco':
            $valorFlete = $('input[name=fletexSaco]').val()

            $resultadoFleteTotal = $valorFlete * $nroSaco
            break;
        case 'fletePeso':
            $valorFlete = $('input[name=fletexPeso]').val()

            $resultadoFleteTotal = $valorFlete * $pesoReal
            break;
        case 'fleteTonelada':
            $valorFlete = $('input[name=fletexTonelada]').val()

            $resultadoFleteTotal = $valorFlete * ($pesoReal/1000)
            break;
    }

    $('input[name=fletexTotal]').val(parseFloat($resultadoFleteTotal).toFixed(2))
});

$('input[name=nro_sacos_mayor_13]').on('change keyup',function(){
    $nroSacos = $('input[name=nro_sacos_mayor_13]').val()
    $estado = $('input[name="rbtipoPeso"]:checked').val()
    $nroSacosTotal = 0;

    $diferencia = 0;
    if($estado == 'sacos')
    {
        $nroSacosTotal = $('input[name=nro_sacos]').val();
    }else if($estado == 'kilos'){
        $nroSacosTotal = $('input[name=kilos_nro_sacos]').val();
    }

    if($nroSacos > 0)
    {
        $('input[name=condicion_mayor_13]').val('Secado')
        $diferencia = $nroSacosTotal - $nroSacos;
        $('input[name=nro_sacos_menor_13]').val($diferencia)
    }else if($nroSacos <= 0){
        $('input[name=condicion_mayor_13]').val('Vacío')
        $diferencia = $nroSacosTotal - $nroSacos;
        $('input[name=nro_sacos_menor_13]').val($diferencia)
    }

    if($('input[name=nro_sacos_mayor_13]').is(':focus')){
        $('input[name=nro_sacos_menor_13]').trigger('change')
    }
});

$('input[name=nro_sacos_menor_13]').on('change keyup',function(){
    $nroSacos = $('input[name=nro_sacos_menor_13]').val()
    $estado = $('input[name="rbtipoPeso"]:checked').val()
    $nroSacosTotal = 0;

    if($estado == 'sacos')
    {
        $nroSacosTotal = $('input[name=nro_sacos]').val();
    }else if($estado == 'kilos'){
        $nroSacosTotal = $('input[name=kilos_nro_sacos]').val();
    }

    if($nroSacos > 0)
    {
        $('input[name=condicion_menor_13]').val('Producción')
        $diferencia = $nroSacosTotal - $nroSacos;
        $('input[name=nro_sacos_mayor_13]').val($diferencia)

    }else if($nroSacos <= 0){
        $('input[name=condicion_menor_13]').val('Vacío')
        $diferencia = $nroSacosTotal - $nroSacos;
        $('input[name=nro_sacos_mayor_13]').val($diferencia)
    }

    if($('input[name=nro_sacos_menor_13]').is(':focus')){
        $('input[name=nro_sacos_mayor_13]').trigger('change')
    }
});


$('#registrarLote').submit(function(e){
    e.preventDefault();

    var datos = $('#registrarLote');
    var url = datos.attr('action');
    console.log(url)
    $.post(url,datos.serialize(),function (result) {

    }).success(function(data)
    {
        if($.isEmptyObject(data.error)){
            console.log(data)
            $('#modal-exito').modal({
                backdrop: 'static',
                keyboard:false
            });
            $('#modal-exito').modal('show')
        }else{
            console.log(data.error)
            return;
        }
    }).error(function(data){
        $('#msg-error').fadeIn();
        if(data.responseJSON.errors.campania)
        {
            $('input[name=campania]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.campania)
        }else{
            $('input[name=campania]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.fecha)
        {
            $('input[name=fecha]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.fecha)
        }else{
            $('input[name=fecha]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.agricultor)
        {
            $('#agricultorGroup').addClass('has-error')
            console.log(data.responseJSON.errors.agricultor)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.agricultor+'</li>')
        }else{
            $('#agricultorGroup').removeClass('has-error')
        }

        if(data.responseJSON.errors.cliente)
        {
            $('#clienteGroup').addClass('has-error')
            console.log(data.responseJSON.errors.cliente)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.cliente+'</li>')
        }else{
            $('#clienteGroup').removeClass('has-error')
        }

        if(data.responseJSON.errors.variedad)
        {
            $('#grupoVariedad').addClass('has-error')
            console.log(data.responseJSON.errors.variedad)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.variedad+'</li>')
        }else{
            $('#grupoVariedad').removeClass('has-error')
        }

        if(data.responseJSON.errors.nro_sacos)
        {
            $('input[name=nro_sacos]').parent().removeClass('has-error')
            console.log(data.responseJSON.errors.nro_sacos)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.nro_sacos+'</li>')
        }else{
            $('input[name=nro_sacos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.chofer)
        {
            $('#grupoChofer').addClass('has-error')
            console.log(data.responseJSON.errors.chofer)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.chofer+'</li>')
        }else{
            $('#grupoChofer').removeClass('has-error')
        }

        if(data.responseJSON.errors.procedencia)
        {
            $('#grupoProcedencia').addClass('has-error')
            console.log(data.responseJSON.errors.procedencia)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.procedencia+'</li>')
        }else{
            $('#grupoProcedencia').removeClass('has-error')
        }

        if(data.responseJSON.errors.procedencia)
        {
            $('#grupoVehiculo').addClass('has-error')
            console.log(data.responseJSON.errors.procedencia)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.procedencia+'</li>')
        }else{
            $('#grupoVehiculo').removeClass('has-error')
        }
        if(data.responseJSON.errors.nro_sacos_mayor_13)
        {
            $('#mayor13group').addClass('has-error')
            console.log(data.responseJSON.errors.nro_sacos_mayor_13)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.variedad+'</li>')
        }else{
            $('#mayor13group').removeClass('has-error')
        }
        if(data.responseJSON.errors.nro_sacos_menor_13)
        {
            $('#menor13group').addClass('has-error')
            console.log(data.responseJSON.errors.nro_sacos_menor_13)
            //$('#listaerrores').html('<li>'+data.responseJSON.errors.variedad+'</li>')
        }else{
            $('#menor13group').removeClass('has-error')
        }

        return;

    });
});

$('body').on('click','.detalle',function(e){
   e.preventDefault();
   console.log('click')
    var id = $(this).attr('value');

    var url = "/lote/"+id+"/detalle"
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

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    $estado = $(this).attr('estado')
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    if($estado == 'eliminar') {
        $(this).attr('disabled','disabled');
        var url = "/lote/delete"

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
    }else if($estado == 'conforme'){
        console.log('conforme')
        var url = "/lote/conforme"

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

$('body').on('click','.delete',function (e) {
    e.preventDefault();

    $botonPresionado = 'eliminar'

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('.confirmar').attr('estado','eliminar')
    $('#modal-confirmacion').modal('show')
});


$('body').on('click','.conformidad',function(e){
    e.preventDefault();

    $botonPresionado = 'conforme'

    //console.log('click')
    $id = $(this).attr('lote')
    console.log('id'+$id)
    $('.confirmar').attr('id',$id)
    $('#modal-confirmacion .modal-body').html('<h3 class="text-warning text-center">¿Está conforme con el lote?</h3>')
    $('.confirmar').attr('estado','conforme')

    $('.confirmar').removeClass('btn-danger')
    $('.confirmar').addClass('btn-success')
    $('#modal-confirmacion').modal('show')
});

$('#buscarLote').on('keyup',function(){
    valor = $(this).val();

    $filtro = $('#filtro').val();
    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/lote/buscar"
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



String.prototype.ucfirst = function()
{
    return this.charAt(0).toUpperCase() + this.substr(1);
}


$botonPresionado = "";
$(document).keypress(function(e) {
    if(e.which == 13)
    {
        return false;
    }
    // if(e.which == 13 && $botonPresionado == 'eliminar'){
    //
    //     console.log($botonPresionado)
    //     $('.confirmar').trigger('click')
    //     $botonPresionado = "volver"
    // }else if(e.which == 13 && $botonPresionado == 'volver'){
    //
    //     console.log($botonPresionado)
    //     location.reload();
    // }else if(e.which == 13 && $botonPresionado == 'conforme'){
    //
    //     console.log($botonPresionado)
    //     $('#modal-confirmacion .modal-footer button').trigger('click')
    //     $botonPresionado = 'volver'
    // }else if(e.which == 13 && $botonPresionado == 'addAgricultor'){
    //     console.log($botonPresionado)
    //     $('#submitRegistrarAgricultor').trigger('click')
    //     $botonPresionado = ''
    // }else if(e.which == 13 && $botonPresionado == 'addCliente'){
    //     console.log($botonPresionado)
    //     $('#submitRegistrarCliente').trigger('click')
    //     $botonPresionado = ''
    // }else if(e.which == 13 && $botonPresionado == 'addVariedad'){
    //     console.log($botonPresionado)
    //     $('#submitRegistrarVariedad').trigger('click')
    //     $botonPresionado = ''
    // }else if(e.which == 13 && $botonPresionado == 'addProcedencia'){
    //     console.log($botonPresionado)
    //     //$('#submitRegistrarProcedencia').trigger('click')
    //     $botonPresionado = ''
    // }else if(e.which == 13 && $botonPresionado == 'addChofer'){
    //     console.log($botonPresionado)
    //     $('#submitRegistrarChofer').trigger('click')
    //     $botonPresionado = ''
    // }else if(e.which == 13 && $botonPresionado == 'addVehiculo'){
    //     console.log($botonPresionado)
    //     $('#submitRegistrarVehiculo').trigger('click')
    //     $botonPresionado = ''
    // }
});

$('#limpiar').on('click',function(e) {
    //selects
    // $('#cliente').val('0').trigger('change');
    // $('#agricultor').val('-1').trigger('change');

    $('#rbAgri').prop('checked',true);
    $('#agricultor').val('-1').trigger('change');
    $('#variedad').val('-1').trigger('change');
    $('#procedencia').val('-1').trigger('change');
    $('#chofer').val('-1').trigger('change');
    $('#vehiculo').val('-1').trigger('change');
    //inputs
    $('input[name=nro_sacos]').val('0');
    $('input[name=kilos]').val('0');
    $('input[name=pesoreal]').val('0');
    $('input[name=kilos_pesoreal]').val('0');
    $('input[name=kilos_nro_sacos]').val('0');
    $('input[name=kilos_kilos]').val('0');
    $('input[name=fletexSaco]').val('0');
    $('input[name=fletexPeso]').val('0');
    $('input[name=fletexTonelada]').val('0');
    $('input[name=fletexTotal]').val('0');
    $('input[name=nro_sacos_mayor_13]').val('0');
    $('input[name=nro_sacos_menor_13]').val('0');
    $('input[name=condicion_mayor_13]').val('Vacío');
    $('input[name=condicion_menor_13]').val('Vacío');
    $('textarea[name=observacion]').val('');

    //label errors
    $('#agricultorGroup').removeClass('has-error');
    $('#clienteGroup').removeClass('has-error');
    $('#grupoVariedad').removeClass('has-error');
    $('#grupoProcedencia').removeClass('has-error');
    $('#grupoChofer').removeClass('has-error');
    $('#grupoVehiculo').removeClass('has-error');
    //aviso
    $('#msg-error').fadeOut();

});

$filtro = "";
$('#filtro').on('change',function(e){
    e.preventDefault();
   $filtro = $(this).val();
});

$tipoAgri = "";
$tipoCli = "";

$('#modal-agri-nuevo input[name=ruc]').on('keyup',function(event){
    $longitud = $(this).val().length;
    if($longitud > 0)
    {
        $('#modal-agri-nuevo input[name=dni]').prop('readonly',true);
    }else{
        $('#modal-agri-nuevo input[name=dni]').prop('readonly',false);
    }
});

$('#modal-agri-nuevo input[name=dni]').on('keyup',function(event){
    $longitud = $(this).val().length;
    if($longitud > 0)
    {
        $('#modal-agri-nuevo input[name=ruc]').prop('readonly',true);
    }else{
        $('#modal-agri-nuevo input[name=ruc]').prop('readonly',false);
    }
});
/*
function valorTipoAgri(){
    $tipoAgri = $('input[name="rbTipoAgri"]:checked').val();
    if($tipoAgri == 'natural'){
        $('label[for=apellidos]').show();
        $('input[name=apellidos]').show();

        $('label[for=nombres]').text('Nombres :');
        $('label[for=dni]').text('DNI :');
    }else if($tipoAgri == 'empresa'){
        $('label[for=apellidos]').hide();
        $('input[name=apellidos]').hide();

        $('label[for=nombres]').text('Razón Social :');
        $('label[for=dni]').text('RUC :');
    }
}

function valorTipoCli(){
    $tipoCli = $('input[name="rbTipoCli"]:checked').val();
    if($tipoCli == 'natural'){
        $('#registrarCliente label[for=apellidos]').show();
        $('#registrarCliente input[name=apellidos]').show();

        $('#registrarCliente label[for=nombres]').text('Nombres :');
        $('#registrarCliente label[for=dni]').text('DNI :');
    }else if($tipoCli == 'empresa'){
        $('#registrarCliente label[for=apellidos]').hide();
        $('#registrarCliente input[name=apellidos]').hide();

        $('#registrarCliente label[for=nombres]').text('Razón Social :');
        $('#registrarCliente label[for=dni]').text('RUC :');
    }
}

$('input[name="rbTipoAgri"]').on('change',function() {
    valorTipoAgri();
});

$('input[name="rbTipoCli"]').on('change',function() {
    valorTipoCli();
});*/

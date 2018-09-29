$(document).ready(function() {
    $('#msg-error').hide();
});

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();
    $('input[name=marca]').parent().removeClass('has-error')
    $('input[name=descripcion]').parent().removeClass('has-error')
    $('input[name=placa]').parent().removeClass('has-error')

    $('label[for=placa]').html('Placa: ')
    $('#modal-exito').modal('hide')

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

$('#registrarVehiculo').submit(function(event)
{
    event.preventDefault();

    estadoPlaca = validarPlaca( $('input[name=placa]').val())

   if(estadoPlaca == true) {


        var datos = $('#registrarVehiculo');
        var url = datos.attr('action');

        $.post(url, datos.serialize(), function (result) {

        }).success(function (data) {
            if ($.isEmptyObject(data.error)) {
                $('#modal-exito').modal('show')
            } else {
                console.log(data.error)
            }
        }).error(function (data) {
            $('#msg-error').fadeIn();
            if (data.responseJSON.errors.marca) {
                $('input[name=marca]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.marca)
            } else {
                $('input[name=marca]').parent().removeClass('has-error')
            }

            if (data.responseJSON.errors.descripcion) {
                $('input[name=descripcion]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.descripcion)
            } else {
                $('input[name=descripcion]').parent().removeClass('has-error')
            }
            if (data.responseJSON.errors.placa) {
                $('input[name=placa]').parent().addClass('has-error')
                $('label[for=placa]').html('Placa: ' + data.responseJSON.errors.placa);
                console.log(data.responseJSON.errors.placa)
            } else {
                $('input[name=placa]').parent().removeClass('has-error')
                $('label[for=placa]').html('Placa: ');
            }

        });
    }
});


$('body').on('click','.edit',function(e){
    e.preventDefault();

    $botonPresionado = "editar";

    $('input[name=marca]').parent().removeClass('has-error')
    $('input[name=descripcion]').parent().removeClass('has-error')
    $('input[name=placa]').parent().removeClass('has-error')

    $('label[for=placa]').html('Placa: ')

    estadoPlaca = validarPlaca( $('input[name=placa]').val())

    if(estadoPlaca == true) {

        var id = $(this).attr('value');

        var url = "/vehiculo/" + id + "/edit"
        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {
                $('#update').attr('value', data.id)
                $('input[name=marca]').val(data.marca)
                $('input[name=descripcion]').val(data.descripcion)
                $('input[name=placa]').val(data.placa)

                $('#modal-vehiculo-edit').modal('show');
            },
            error: function (data) {
                alert("Error " + json.stringify(data))
            }
        });
    }
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#vehiculo-frm-update').attr('action');

    var id = $('#update').attr('value')
    var marca = $('input[name=marca]').val()
    var descripcion = $('input[name=descripcion]').val()
    var placa = $('input[name=placa]').val()

    var token = $('input[name=_token]').val()
    estadoPlaca = validarPlaca( $('input[name=placa]').val())

    if(estadoPlaca == true) {

        $.ajax({
            type: "post",
            url: url,
            headers: {'X-CSRF-TOKEN': token},
            dataType: "json",
            data: {
                id: id,
                marca: marca,
                descripcion: descripcion,
                placa: placa
            },
            success: function (data) {
                $('#modal-vehiculo-edit').modal('hide');
                location.reload();

            },
            error: function (data) {
                if (data.responseJSON.errors.marca) {
                    $('input[name=marca]').parent().addClass('has-error')
                    console.log(data.responseJSON.errors.marca)
                } else {
                    $('input[name=marca]').parent().removeClass('has-error')
                }
                if (data.responseJSON.errors.descripcion) {
                    $('input[name=descripcion]').parent().addClass('has-error')
                    console.log(data.responseJSON.errors.descripcion)
                } else {
                    $('input[name=descripcion]').parent().removeClass('has-error')
                }
                if (data.responseJSON.errors.placa) {
                    $('input[name=placa]').parent().addClass('has-error')
                    $('label[for=placa]').html('Placa: ' + data.responseJSON.errors.placa);
                    console.log(data.responseJSON.errors.placa)
                } else {
                    $('input[name=placa]').parent().removeClass('has-error')
                    $('label[for=placa]').html('Placa: ');
                }
            }
        });
    }
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/vehiculo/delete"

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

    $botonPresionado = "eliminar";

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('#modal-confirmacion').modal('show')
});

$('#limpiar').on('click',function(e){
    e.preventDefault();
    $('#msg-error').hide();
    $('input[name=marca]').parent().removeClass('has-error')
    $('input[name=descripcion]').parent().removeClass('has-error')
    $('input[name=placa]').parent().removeClass('has-error')

    $('input[name=marca]').val('')
    $('input[name=descripcion]').val('')
    $('input[name=placa]').val('')

    $('label[for=placa]').html('Placa: ')
});

$('#buscarVehiculo').on('keyup',function(){
    valor = $(this).val()

    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/vehiculo/buscar"
    $.ajax({
        type:"get",
        headers: {'X-CSRF-TOKEN':token},
        url:url,
        dataType:"json",
        data:{
            buscar : valor
        },
        success: function(data){
            $('#tabla').html(data.html)
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$botonPresionado = "";

$(document).keypress(function(e) {
    if(e.which == 13)
    {
       return false;
    }
/*
    if(e.which == 13 && $botonPresionado == 'editar') {
        console.log("se presionó enter")
        console.log($botonPresionado)
        $('#update').trigger('click')
    }else if(e.which == 13 && $botonPresionado == 'eliminar'){
        console.log("se presionó enter")
        console.log($botonPresionado)
        $('.confirmar').trigger('click')
        $botonPresionado = "volver"
    }else if(e.which == 13 && $botonPresionado == 'volver'){
        console.log("se presionó enter")
        console.log($botonPresionado)
        location.reload();
    }*/
});

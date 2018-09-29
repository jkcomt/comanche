$(document).ready(function() {
    $('#msg-error').hide();
});

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();
    $('input[name=apellidos]').parent().removeClass('has-error')
    $('input[name=nombres]').parent().removeClass('has-error')
    $('input[name=dni]').parent().removeClass('has-error')
    $('#modal-exito').modal('hide')
});

$('#registrarProcedencia').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarProcedencia');
    var url = datos.attr('action');

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
        if(data.responseJSON.errors.lugar)
        {
            $('input[name=lugar]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.lugar)
        }else{
            $('input[name=lugar]').parent().removeClass('has-error')
        }

    });

});


$('body').on('click','.edit',function(e){

    e.preventDefault();

    $botonPresionado = 'editar'

    $('input[name=lugar]').parent().removeClass('has-error')

    var id = $(this).attr('value');

    var url = "/procedencia/"+id+"/edit"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            $('#update').attr('value',data.id)
            $('input[name=lugar]').val(data.lugar)

            $('#modal-procedencia-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#procedencia-frm-update').attr('action');

    var id = $('#update').attr('value')
    var lugar = $('input[name=lugar]').val()
    var token = $('input[name=_token]').val()

    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id,
            lugar: lugar
        },
        success: function(data){
            $('#modal-procedencia-edit').modal('hide');
            location.reload();

        },
        error: function(data){
            if(data.responseJSON.errors.lugar)
            {
                $('input[name=lugar]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.lugar)
            }else{
                $('input[name=lugar]').parent().removeClass('has-error')
            }
        }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/procedencia/delete"

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

    $botonPresionado = 'eliminar'

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('#modal-confirmacion').modal('show')
});

$('#buscarProcedencia').on('keyup',function(){
    valor = $(this).val()

    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/procedencia/buscar"
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
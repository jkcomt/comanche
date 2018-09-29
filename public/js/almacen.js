$(document).ready(function() {
    $('#msg-error').hide();
});

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();
    $('input[name=nombre]').parent().removeClass('has-error')
    $('#modal-exito').modal('hide')

});

$('#registrarAlmacen').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarAlmacen');
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
        if(data.responseJSON.errors.nombre)
        {
            $('input[name=nombre]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.lugar)
        }else{
            $('input[name=nombre]').parent().removeClass('has-error')
        }

    });

});


$('.edit').on('click',function(e){

    e.preventDefault();

    $botonPresionado = "editar";

    $('input[name=nombre]').parent().removeClass('has-error')

    var id = $(this).attr('value');

    var url = "/almacen/"+id+"/edit"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            $('#update').attr('value',data.id)
            $('input[name=nombre]').val(data.nombre)

            $('#modal-almacen-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#almacen-frm-update').attr('action');

    var id = $('#update').attr('value')
    var nombre = $('input[name=nombre]').val()
    var token = $('input[name=_token]').val()

    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id,
            nombre: nombre
        },
        success: function(data){
            $('#modal-almacen-edit').modal('hide');
            location.reload();

        },
        error: function(data){
            if(data.responseJSON.errors.lugar)
            {
                $('input[name=nombre]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.lugar)
            }else{
                $('input[name=nombre]').parent().removeClass('has-error')
            }
        }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/almacen/delete"

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

$('.delete').on('click',function (e) {
    e.preventDefault();

    $botonPresionado = "eliminar";

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('#modal-confirmacion').modal('show')
});

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
$(document).ready(function() {
    $('#msg-error').hide();
});

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();
    $('input[name=descripcion]').parent().removeClass('has-error')
    $('#modal-exito').modal('hide')

});

$('#registrarArea').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarArea');
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
        if(data.responseJSON.errors.descripcion)
        {
            $('input[name=descripcion]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.descripcion)
        }else{
            $('input[name=descripcion]').parent().removeClass('has-error')
        }

    });
});


$('.edit').on('click',function(e){

    e.preventDefault();

    $botonPresionado = 'editar'

    $('input[name=descripcion]').parent().removeClass('has-error')

    var id = $(this).attr('value');

    var url = "/area/"+id+"/edit"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            $('#update').attr('value',data.id)
            $('input[name=descripcion]').val(data.descripcion)

            $('#modal-area-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#area-frm-update').attr('action');

    var id = $('#update').attr('value')
    var descripcion = $('input[name=descripcion]').val().toLowerCase()
    var token = $('input[name=_token]').val()

    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id,
            descripcion: descripcion
        },
        success: function(data){
            $('#modal-area-edit').modal('hide');
            location.reload();

        },
        error: function(data){
            if(data.responseJSON.errors.descripcion)
            {
                $('input[name=descripcion]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.descripcion)
                return false;
            }else{
                $('input[name=descripcion]').parent().removeClass('has-error')
                //return false;
            }
            return false;
        }
    });

});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/area/delete"

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

    $botonPresionado = 'eliminar';

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('#modal-confirmacion').modal('show')
});

$botonPresionado = ""

$(document).keypress(function(e) {

    if(e.which == 13)
    {
        return false;
    }

    // if(e.which == 13 && $botonPresionado == 'editar') {
    //     console.log("se presionó enter")
    //     console.log($botonPresionado)
    //     $('#update').trigger('click')
    // }else if(e.which == 13 && $botonPresionado == 'eliminar'){
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
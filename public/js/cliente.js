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
    $('input[name=celular]').parent().removeClass('has-error')
    $('input[name=email]').parent().removeClass('has-error')

    $('label[for=dni]').html('DNI: ');
    $('label[for=celular]').html('Celular: ')
    $('label[for=email]').html('E-mail: ')
    $('#modal-exito').modal('hide')

});

$('#registrarCliente').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarCliente');
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
        if(data.responseJSON.errors.apellidos)
        {
            $('input[name=apellidos]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.apellidos)
        }else{
            $('input[name=apellidos]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.nombres)
        {
            $('input[name=nombres]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.nombres)
        }else{
            $('input[name=nombres]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.dni)
        {
            $('input[name=dni]').parent().addClass('has-error')
            $('label[for=dni]').html('DNI: '+data.responseJSON.errors.dni);
            console.log(data.responseJSON.errors.dni)
        }else{
            $('input[name=dni]').parent().removeClass('has-error')
            $('label[for=dni]').html('DNI: ');
        }

        if(data.responseJSON.errors.celular)
        {
            $('input[name=celular]').parent().addClass('has-error')
            $('label[for=celular]').html('Celular: '+data.responseJSON.errors.celular);
            console.log(data.responseJSON.errors.celular)
        }else{
            $('input[name=celular]').parent().removeClass('has-error')
            $('label[for=celular]').html('Celular: ')
        }

        if(data.responseJSON.errors.email)
        {
            $('input[name=email]').parent().addClass('has-error')
            $('label[for=email]').html('E-mail: El email ya está registrado');
            console.log(data.responseJSON.errors.email)
        }else{
            $('input[name=email]').parent().removeClass('has-error')
            $('label[for=email]').html('E-mail: ')
        }
    });
});


$('body').on('click','.edit',function(e){

    e.preventDefault();

    $botonPresionado = 'editar'

    $('input[name=apellidos]').parent().removeClass('has-error')
    $('input[name=nombres]').parent().removeClass('has-error')
    $('input[name=dni]').parent().removeClass('has-error')
    $('input[name=celular]').parent().removeClass('has-error')
    $('input[name=email]').parent().removeClass('has-error')

    $('input[name=apellidos]').val('')
    $('input[name=nombres]').val('')
    $('input[name=dni]').val('')
    $('input[name=celular]').val('')
    $('input[name=email]').val('')
    $('input[name=direccion]').val('')

    $('label[for=dni]').html('DNI: ');
    $('label[for=celular]').html('Celular: ')
    $('label[for=email]').html('E-mail: ')

    var id = $(this).attr('value');

    var url = "/cliente/"+id+"/edit"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            $('#update').attr('value',data.id)
            $('input[name=apellidos]').val(data.apellidos)
            $('input[name=nombres]').val(data.nombres)
            $('input[name=dni]').val(data.dni)
            $('input[name=celular]').val(data.celular)
            $('input[name=direccion]').val(data.direccion)
            $('input[name=email]').val(data.email)

            $('#modal-cli-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#cli-frm-update').attr('action');

    var id = $('#update').attr('value')
    var apellidos = $('input[name=apellidos]').val()
    var nombres = $('input[name=nombres]').val()
    var dni = $('input[name=dni]').val()
    var celular = $('input[name=celular]').val()
    var direccion = $('input[name=direccion]').val()
    var email = $('input[name=email]').val()
    var token = $('input[name=_token]').val()

    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id,
            apellidos: apellidos,
            nombres: nombres,
            dni: dni,
            celular: celular,
            direccion: direccion,
            email: email
        },
        success: function(data){
            $('#modal-cli-edit').modal('hide');
            location.reload();

        },
        error: function(data){
            if(data.responseJSON.errors.apellidos)
            {
                $('input[name=apellidos]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.apellidos)
            }else{
                $('input[name=apellidos]').parent().removeClass('has-error')
            }

            if(data.responseJSON.errors.nombres)
            {
                $('input[name=nombres]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.nombres)
            }else{
                $('input[name=nombres]').parent().removeClass('has-error')
            }

            if(data.responseJSON.errors.dni)
            {
                $('input[name=dni]').parent().addClass('has-error')
                $('label[for=dni]').html('DNI: '+data.responseJSON.errors.dni);
                console.log(data.responseJSON.errors.dni)
            }else{
                $('input[name=dni]').parent().removeClass('has-error')
            }

            if(data.responseJSON.errors.celular)
            {
                $('input[name=celular]').parent().addClass('has-error')
                $('label[for=celular]').html('Celular: '+data.responseJSON.errors.celular);
                console.log(data.responseJSON.errors.celular)
            }else{
                $('input[name=celular]').parent().removeClass('has-error')
                $('label[for=celular]').html('Celular: ')
            }

            if(data.responseJSON.errors.email)
            {
                $('input[name=email]').parent().addClass('has-error')
                $('label[for=email]').html('E-mail: '+data.responseJSON.errors.email);
                console.log(data.responseJSON.errors.email)
            }else{
                $('input[name=email]').parent().removeClass('has-error')
                $('label[for=email]').html('E-mail: ')
            }
        }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/cliente/delete"

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

$('#limpiar').on('click',function(e){
    e.preventDefault();
    $('#msg-error').hide();
    $('input[name=apellidos]').parent().removeClass('has-error')
    $('input[name=nombres]').parent().removeClass('has-error')
    $('input[name=dni]').parent().removeClass('has-error')
    $('input[name=celular]').parent().removeClass('has-error')
    $('input[name=email]').parent().removeClass('has-error')

    $('input[name=apellidos]').val('')
    $('input[name=nombres]').val('')
    $('input[name=dni]').val('')
    $('input[name=celular]').val('')
    $('input[name=email]').val('')
    $('input[name=direccion]').val('')

    $('label[for=dni]').html('DNI: ');
    $('label[for=celular]').html('Celular: ')
    $('label[for=email]').html('E-mail: ')
});

$('#buscarCliente').on('keyup',function(){
    valor = $(this).val()

    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/cliente/buscar"
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
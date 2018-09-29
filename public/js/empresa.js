
$(document).ready(function() {
    $('#msg-error').hide();
});

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');
    $('#msg-error').hide();
    $('input[name=razon_social]').parent().removeClass('has-error')
    $('input[name=ruc]').parent().removeClass('has-error')
    $('input[name=direccion]').parent().removeClass('has-error')
    $('input[name=telefono]').parent().removeClass('has-error')
    $('input[name=email]').parent().removeClass('has-error')
    $('input[name=representante]').parent().removeClass('has-error')
    $('input[name=dni_representante]').parent().removeClass('has-error')

    $('label[for=razon_social]').html('Razón Social: ');
    $('label[for=ruc]').html('RUC: ');
    $('label[for=direccion]').html('Dirección: ');
    $('label[for=telefono]').html('Teléfono: ');
    $('label[for=email]').html('E-mail: ');
    $('input[name=representante]').html('Representante: ');
    $('input[name=dni_representante]').html('DNI: ');
    $('#modal-exito').modal('hide')

});

$('#registrarEmpresa').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarEmpresa');
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
        if(data.responseJSON.errors.razon_social)
        {
            $('input[name=razon_social]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.razon_social)
        }else{
            $('input[name=razon_social]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.ruc)
        {
            $('input[name=ruc]').parent().addClass('has-error')
            $('label[for=ruc]').html('RUC: '+data.responseJSON.errors.ruc);
            console.log(data.responseJSON.errors.ruc)
        }else{
            $('input[name=ruc]').parent().removeClass('has-error')
            $('label[for=ruc]').html('RUC: ');
        }

        if(data.responseJSON.errors.direccion)
        {
            $('input[name=direccion]').parent().addClass('has-error')
            $('label[for=direccion]').html('Dirección: '+data.responseJSON.errors.direccion);
            console.log(data.responseJSON.errors.direccion)
        }else{
            $('input[name=direccion]').parent().removeClass('has-error')
            $('label[for=direccion]').html('Dirección: ')
        }

        if(data.responseJSON.errors.telefono)
        {
            $('input[name=telefono]').parent().addClass('has-error')
            $('label[for=telefono]').html('Teléfono: '+data.responseJSON.errors.telefono);
            console.log(data.responseJSON.errors.telefono)
        }else{
            $('input[name=telefono]').parent().removeClass('has-error')
            $('label[for=telefono]').html('Teléfono: ')
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

        if(data.responseJSON.errors.representante)
        {
            $('input[name=representante]').parent().addClass('has-error')
            $('label[for=representante]').html('Representante: '+data.responseJSON.errors.representante);
            console.log(data.responseJSON.errors.representante)
        }else{
            $('input[name=representante]').parent().removeClass('has-error')
            $('label[for=representante]').html('Representante: ')
        }

        if(data.responseJSON.errors.dni_representante)
        {
            $('input[name=dni_representante]').parent().addClass('has-error')
            $('label[for=dni_representante]').html('DNI de representante: '+data.responseJSON.errors.dni_representante);
            console.log(data.responseJSON.errors.dni_representante)
        }else{
            $('input[name=dni_representante]').parent().removeClass('has-error')
            $('label[for=dni_representante]').html('DNI de representante: ')
        }
    });

});


$('body').on('click','.edit',function(e){

    e.preventDefault();
    $botonPresionado = "editar"

    $('input[name=razon_social]').parent().removeClass('has-error')
    $('input[name=ruc]').parent().removeClass('has-error')
    $('input[name=direccion]').parent().removeClass('has-error')
    $('input[name=telefono]').parent().removeClass('has-error')
    $('input[name=email]').parent().removeClass('has-error')
    $('input[name=dni_representante]').parent().removeClass('has-error')
    $('input[name=representante]').parent().removeClass('has-error')
    $('input[name=razon_social]').val('')
    $('input[name=ruc]').val('')
    $('input[name=direccion]').val('')
    $('input[name=telefono]').val('')
    $('input[name=email]').val('')
    $('input[name=dni_representante]').val('')
    $('input[name=representante]').val('')
    $('label[for=ruc]').html('RUC: ');
    $('label[for=telefono]').html('Teléfono: ')
    $('label[for=email]').html('E-mail: ')
    $('label[for=dni_representante]').html('DNI Representante: ')
    $('label[for=representante]').html('Representante: ')

    var id = $(this).attr('value');

    var url = "/empresa/"+id+"/edit"
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            $('#update').attr('value',data.id)
            $('input[name=razon_social]').val(data.razon_social)
            $('input[name=ruc]').val(data.ruc)
            $('input[name=telefono]').val(data.telefono)
            $('input[name=direccion]').val(data.direccion)
            $('input[name=email]').val(data.email)
            $('input[name=representante]').val(data.representante)
            $('input[name=dni_representante]').val(data.dni_representante)

            $('#modal-empresa-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#empresa-frm-update').attr('action');

    var id = $('#update').attr('value')
    var razon_social = $('input[name=razon_social]').val()
    var ruc = $('input[name=ruc]').val()
    var telefono = $('input[name=telefono]').val()
    var direccion = $('input[name=direccion]').val()
    var email = $('input[name=email]').val()
    var representante = $('input[name=representante]').val()
    var dni_representante = $('input[name=dni_representante]').val()
    var token = $('input[name=_token]').val()
    console.log(ruc);
    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id,
            razon_social: razon_social,
            ruc: ruc,
            telefono: telefono,
            direccion: direccion,
            email: email,
            representante: representante,
            dni_representante: dni_representante
        },
        success: function(data){
            $('#modal-empresa-edit').modal('hide');
            location.reload();

        },
        error: function(data){
            if(data.responseJSON.errors.razon_social)
            {
                $('input[name=razon_social]').parent().addClass('has-error')
                console.log(data.responseJSON.errors.razon_social)
            }else{
                $('input[name=razon_social]').parent().removeClass('has-error')
            }
            if(data.responseJSON.errors.ruc)
            {
                $('input[name=ruc]').parent().addClass('has-error')
                $('label[for=ruc]').html('RUC: '+data.responseJSON.errors.ruc);
                console.log(data.responseJSON.errors.ruc)
            }else{
                $('input[name=ruc]').parent().removeClass('has-error')
            }

            if(data.responseJSON.errors.telefono)
            {
                $('input[name=telefono]').parent().addClass('has-error')
                $('label[for=telefono]').html('Teléfono: '+data.responseJSON.errors.telefono);
                console.log(data.responseJSON.errors.celular)
            }else{
                $('input[name=telefono]').parent().removeClass('has-error')
                $('label[for=telefono]').html('Teléfono: ')
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

            if(data.responseJSON.errors.representante)
            {
                $('input[name=representante]').parent().addClass('has-error')
                $('label[for=representante]').html('Representante: Ingrese representante');
                console.log(data.responseJSON.errors.representante)
            }else{
                $('input[name=representante]').parent().removeClass('has-error')
                $('label[for=representante]').html('Representante: ')
            }

            if(data.responseJSON.errors.dni_representante)
            {
                $('input[name=dni_representante]').parent().addClass('has-error')
                $('label[for=dni_representante]').html('DNI de representante: '+data.responseJSON.errors.dni_representante);
                console.log(data.responseJSON.errors.dni_representante)
            }else{
                $('input[name=dni_representante]').parent().removeClass('has-error')
                $('label[for=dni_representante]').html('DNI de representante: ')
            }
        }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();

    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/empresa/delete"

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

    $botonPresionado = "eliminar"

    var id = $(this).attr('id')
    $('.confirmar').attr('id',id)
    $('#modal-confirmacion').modal({
        show:true,
        keyboard:false
    })

});

$('#limpiar').on('click',function(e){
    e.preventDefault();
    $('#msg-error').hide();
    $('input[name=razon_social]').parent().removeClass('has-error')
    $('input[name=ruc]').parent().removeClass('has-error')
    $('input[name=telefono]').parent().removeClass('has-error')
    $('input[name=direccion]').parent().removeClass('has-error')
    $('input[name=email]').parent().removeClass('has-error')

    $('input[name=razon_social]').val('')
    $('input[name=ruc]').val('')
    $('input[name=telefono]').val('')
    $('input[name=direccion]').val('')
    $('input[name=email]').val('')

    $('label[for=dni]').html('RUC: ');
    $('label[for=telefono]').html('Teléfono: ')
    $('label[for=email]').html('E-mail: ')
});

$('#buscarEmpresa').on('keyup',function(){
    valor = $(this).val()

    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/empresa/buscar"
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
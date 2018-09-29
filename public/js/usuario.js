$(document).ready(function() {
    $('#personal').select2({
        theme:'bootstrap',
        placeholder: "Seleccione personal",
        allowClear: true,

    });

    $('#area').select2({
        theme:'bootstrap',
        placeholder: "Seleccione área",
        allowClear: true
    });

    $('#msg-error').hide();
});

$('.modal-footer #create-agri').on('click',function (event) {
    event.preventDefault();
    $('#limpiar').trigger('click');//espera
    $('#msg-error').hide();
    $('input[name=nick]').parent().removeClass('has-error')
    // $('input[name=email]').parent().removeClass('has-error')
    $('input[name=password]').parent().removeClass('has-error')
    $('select[name=area]').parent().removeClass('has-error')
    $('select[name=personal]').parent().removeClass('has-error')

    $('#modal-exito').modal('hide')
    location.reload();

});

$('#limpiar').on('click',function(event){
	event.preventDefault(event);
	
	console.log('click limpiar');
	$('input[name=name]').val('');
	$('input[name=password]').val('');
	$('#cliente').val('-1').trigger('change');
	$('#area').val('-1').trigger('change');
});

$('#registrarUsuario').submit(function(event)
{
    event.preventDefault();

    var datos = $('#registrarUsuario');
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
        if(data.responseJSON.errors.name)
        {
            $('input[name=name]').parent().addClass('has-error')
            $('label[for=name]').html('Nick: '+data.responseJSON.errors.name);
            console.log(data.responseJSON.errors.name)
        }else{
            $('input[name=name]').parent().removeClass('has-error')
            $('label[for=name]').html('Nick');
        }

        // if(data.responseJSON.errors.email)
        // {
        //     $('input[name=email]').parent().addClass('has-error')
        //     console.log(data.responseJSON.errors.email)
        // }else{
        //     $('input[name=email]').parent().removeClass('has-error')
        // }

        if(data.responseJSON.errors.password)
        {
            $('input[name=password]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.password)
        }else{
            $('input[name=password]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.area)
        {
            $('select[name=area]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.area)
        }else{
            $('select[name=area]').parent().removeClass('has-error')
        }

        if(data.responseJSON.errors.personal)
        {
            $('select[name=personal]').parent().addClass('has-error')
            console.log(data.responseJSON.errors.personal)
        }else{
            $('select[name=personal]').parent().removeClass('has-error')
        }
    });

});


$('body').on('click','.edit',function(e){

    e.preventDefault();

    $botonPresionado = 'editar'

    $('input[name=nick]').parent().removeClass('has-error')
    // $('input[name=email]').parent().removeClass('has-error')
    $('select[name=area]').parent().removeClass('has-error')
    $('select[name=personal]').parent().removeClass('has-error')

    $('label[for=nick]').html('Nick :');
    //$('label[for=email]').html('E-mail :');

    var id = $(this).attr('value');

    var url = "/usuario/"+id+"/edit"

    var areasSelect = $('#area')
    $.ajax({
        type:"get",
        url:url,
        dataType:"json",
        data:{
            id : id
        },
        success: function(data){
            //console.log(data);
            areasSelect.children().remove()
            $('#update').attr('value',data.usuario.id)
            $('input[name=nick]').val(data.usuario.name)
            var areas = data.areas
            $.each(areas,function(key,area){
                areasSelect.append("<option value='"+key+"'>" + area.charAt(0).toUpperCase() + area.slice(1) + "</option>");
            });

            areasSelect.val(data.usuario.area_id);

            // $('input[name=email]').val(data.email)
            $('input[name=personal]').val(data.usuario.personal.apellidos+' '+data.usuario.personal.nombres)
            //$('input[name=email]').val(data.usuario.email)
            //$('input[name=password]').val(data.usuario.password)

            $('#modal-usuario-edit').modal('show');
        },
        error: function(data){
            alert("Error "+json.stringify(data))
        }
    });
});

$('#update').on('click',function (e) {
    e.preventDefault();

    var url = $('#usuario-frm-update').attr('action');

    var id = $('#update').attr('value')
    var area = $('select[name=area]').val()
    var password = $('input[name=password]').val()
    // var email = $('input[name=email]').val()
    var token = $('input[name=_token]').val()
    var nick = $('input[name=nick]').val()

    console.log(url)
    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        dataType:"json",
        data:{
            id : id,
            area: area,
            password: password,
            //email: email,
            name:nick
        },
        success: function(data){
            $('#modal-usuario-edit-edit').modal('hide');
            location.reload();

        },
        error: function(data){
            console.log(data.responseJSON)

            // if(data.responseJSON.errors.email)
            // {
            //     $('input[name=email]').parent().addClass('has-error')
            //     $('label[for=email]').html('E-mail: '+data.responseJSON.errors.email);
            //     console.log(data.responseJSON.errors.email)
            // }else{
            //     $('input[name=email]').parent().removeClass('has-error')
            //     $('label[for=email]').html('E-mail: ');
            // }

            if(data.responseJSON.errors.name)
            {
                $('input[name=nick]').parent().addClass('has-error')
                $('label[for=nick]').html('Nick: '+data.responseJSON.errors.name);
                console.log(data.responseJSON.errors.name)
            }else{
                $('input[name=nick]').parent().removeClass('has-error')
                $('label[for=nick]').html('Nick');
            }

        }
    });
});

$('.confirmar').on('click',function (e) {
    e.preventDefault();
    var id = $(this).attr('id')
    var token = $('input[name=_token]').attr('value')
    var url = "/usuario/delete"

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

$('#mostrarpassword').on('click',function(e){
   pass = $('input[name="password"]').attr('type')

    console.log(pass)
    if(pass == 'password')
    {
        $('input[name="password"]').attr('type','text')
        $('#mostrarpassword span').removeClass('glyphicon glyphicon-eye-open')
        $('#mostrarpassword span').addClass('glyphicon glyphicon-asterisk')
    }else{
        $('input[name="password"]').attr('type','password')
        $('#mostrarpassword span').removeClass('glyphicon glyphicon-asterisk')
        $('#mostrarpassword span').addClass('glyphicon glyphicon-eye-open')
    }
});

$('#buscarUsuario').on('keyup',function(){
    valor = $(this).val()

    // e.preventDefault();
    var token = $('input[name=_token]').attr('value')

    var url = "/usuario/buscar"
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

   /* if(e.which == 13 && $botonPresionado == 'editar') {
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
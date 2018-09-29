var getNewNotifications = function () {
    $.getJSON('/secado/notifications', function (data) {
        $('.notificaciones').text('')
        $('.notificaciones').append(data.html)
    });

    $.getJSON('/produccion_ingreso/notifications', function (data) {
        $('.notificaciones').text('')
        $('.notificaciones').append(data.html)
        console.log('noti a produccion')
    });
};

setInterval(getNewNotifications, 10000);
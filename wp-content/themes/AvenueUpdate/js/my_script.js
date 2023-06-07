jQuery(function ($) {
    $('li.qtranxs-lang-menu').find('a[data-toggle=dropdown]').each(function () {
        var img = $(this).children().eq(0).css('vertical-align','baseline'), flechita = $(this).children().eq(1);
        $(this).text("");
        $(this).append(img).append(flechita);

    });
})
function filtroExcursion(e) {
    var $ = jQuery;
    var indiceSeleccionado = e.selectedIndex;
    var opcionSeleccionada = e.options[indiceSeleccionado];
    var valorSeleccionado = opcionSeleccionada.value;
    var listaExcursiones = $('#articulos-excursiones > article');
    console.log(listaExcursiones);
    for (var i = 0; i < listaExcursiones.length; i++) {
        var articulo = listaExcursiones[i];
        var clase=articulo.className;
        var arrclase=clase.split(' ');
        var tipo=arrclase[1];
        if (tipo == valorSeleccionado || valorSeleccionado == 0) {
            articulo.style.display = 'inline-block';
        } else {
            articulo.style.display = 'none';
        }
    }
}
function filtroTipoHostal(e) {
    var $ = jQuery;
    var indiceSeleccionado = e.selectedIndex;
    var opcionSeleccionada = e.options[indiceSeleccionado];
    var valorSeleccionado = opcionSeleccionada.value;

    var destinoHostal = document.getElementById('select-destino-hostal');
    var indiceSeleccionadoDestinoHostal = destinoHostal.selectedIndex;
    var opcionSeleccionadaDestinoHostal = destinoHostal.options[indiceSeleccionadoDestinoHostal];
    var valorSeleccionadoDestinoHostal = opcionSeleccionadaDestinoHostal.value;

    var listaHostales = $('#articulos-hostales-div > article');
    for (var i = 0; i < listaHostales.length; i++) {
        var articulo = listaHostales[i];
        var claseArticulo = articulo.className;
        var arrClaseArticulo = claseArticulo.split(' ');
        var destino = arrClaseArticulo[1];
        var tipo = arrClaseArticulo[2];
        if ((tipo == valorSeleccionado && valorSeleccionadoDestinoHostal == '0') || (valorSeleccionado == '0' && destino == valorSeleccionadoDestinoHostal) || (valorSeleccionado == '0' && valorSeleccionadoDestinoHostal == '0') || (destino == valorSeleccionadoDestinoHostal && tipo == valorSeleccionado)) {
            articulo.style.display = 'inline-block';
        } else {
            articulo.style.display = 'none';
        }
    }
}
function filtroDestinoHostal(e) {
    var $ = jQuery;
    var indiceSeleccionado = e.selectedIndex;
    var opcionSeleccionada = e.options[indiceSeleccionado];
    var valorSeleccionado = opcionSeleccionada.value;

    var tipoHostal = document.getElementById('select-tipo-hostal');
    var indiceSeleccionadoTipoHostal = tipoHostal.selectedIndex;
    var opcionSeleccionadaTipoHostal = tipoHostal.options[indiceSeleccionadoTipoHostal];
    var valorSeleccionadoTipoHostal = opcionSeleccionadaTipoHostal.value;

    var listaHostales = $('#articulos-hostales-div > article');
    for (var i = 0; i < listaHostales.length; i++) {
        var articulo = listaHostales[i];
        var claseArticulo = articulo.className;
        var arrClaseArticulo = claseArticulo.split(' ');
        var destino = arrClaseArticulo[1];
        var tipo = arrClaseArticulo[2];
        if ((tipo == valorSeleccionadoTipoHostal && valorSeleccionado == '0') || (valorSeleccionadoTipoHostal == '0' && destino == valorSeleccionado) || (valorSeleccionadoTipoHostal == '0' && valorSeleccionado == '0') || (destino == valorSeleccionado && tipo == valorSeleccionadoTipoHostal)) {
            articulo.style.display = 'inline-block';
        } else {
            articulo.style.display = 'none';
        }
    }
}


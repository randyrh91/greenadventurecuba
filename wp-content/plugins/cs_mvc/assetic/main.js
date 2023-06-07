/**
 * Created by pr0x on 10/05/2015.
 */
//console.log(loader);
jQuery(function($) {
    $.ajaxSetup({
        cache: true,
        data:{'action': 'cs_mvc_action'},
        dataType: 'json',
        error: function(xhr, status, error) {
            alert("Ocurrio un error mistras se realizaba esta acción, \nlo más probable es que su session haya caducado o cancelado la petición. \nSi persiste el problema Entre de nuevo!.");
        },
        timeout: 60000, // Timeout of 60 seconds
        type: 'POST',
        url: meta.ajax_url
    });

    $(document).ajaxStart(function() {
        $('#cs_mvc_loader').modal('show');
    });
    $(document).ajaxStop(function() {
        $('#cs_mvc_loader').modal('hide');
    });

    $('#btn_moreinfo').click(function() {
        var btn = $(this);
        $.post(meta.ajax_url, { 'controller': 'Siger.listajax' }, function(response) {
            btn.slideUp('slow');
            var panel     =     $('<div class="panel panel-primary"><div class="panel-heading"><h3>Apodos de los desarrolladores</h3></div></div>').hide();
            var panelbody =     $('<div class="panel-body"></div>');
            panel.append(panelbody).appendTo('#moreinfo');

            $.each(response, function (e,record) {
                panelbody.append('<div class="well">'+record+'</div>');
            });
            panel.slideDown('slow');
        });
    });
    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

});

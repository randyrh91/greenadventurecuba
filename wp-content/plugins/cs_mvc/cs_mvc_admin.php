<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 4:09
 */
//assets de admin
function cs_mvc_assets_admin() {

    wp_enqueue_style( 'admin-style', plugins_url('assetic/admin.css',CS_MVC_PATH_PLUGIN),array(),'1.0.1');

    wp_enqueue_script( 'knockout', plugins_url('assetic/libs/knockout-2.3.0.js',CS_MVC_PATH_PLUGIN),array(),'2.3.0',false);
    wp_enqueue_script( 'admin-script', plugins_url('assetic/admin.js',CS_MVC_PATH_PLUGIN),array(),'1.0.1',true);
}
//Menu
add_action('admin_menu',function() {
//    add_menu_page('GAC','GAC (Reservas)', 'manage_options','ImagenPortada',function() {
//        cs_mvc_render_admin('admin/ReservaExcursion','ReservaExcursion');
//    },'',10);
    add_menu_page('GAC','GAC (Portada)', 'manage_options','cs_mvc_imagen_portadas',function() {
        cs_mvc_render_admin('admin/ImagenPortada','ImagenPortada');
    },'',10);
    add_submenu_page('cs_mvc_imagen_portadas','Reservas Exc','Reservas Exc', 'manage_options','cs_mvc_reserva_excursiones',function() {
        cs_mvc_render_admin('admin/ReservaExcursion','ReservaExcursion');
    });
//    add_submenu_page('cs_mvc_reserva_excursiones','Portada GAC','Portada', 'manage_options','cs_mvc_imagen_portadas',function() {
//        cs_mvc_render_admin('admin/ImagenPortada','ImagenPortada');
//    });
    add_submenu_page('cs_mvc_imagen_portadas','Excursiones GAC','Excursiones', 'manage_options','cs_mvc_excursiones',function() {
        cs_mvc_render_admin('admin/Excursion','Excursion');
    });
    add_submenu_page('cs_mvc_reserva_excursiones_cxf','Imagen Excursion','Imagen de Excursion', 'manage_options','cs_mvc_imagen_excursiones',function() {
        cs_mvc_render_admin('admin/ImagenExcursion','ImagenExcursion');
    });
    add_submenu_page('cs_mvc_reserva_excursiones','Viajes de Excursion','Viajes de Excursion', 'manage_options','cs_mvc_viajes',function() {
        cs_mvc_render_admin('admin/Viaje','Viaje');
    });
    add_submenu_page('cs_mvc_imagen_portadas','Modalidades','Modalidades', 'manage_options','cs_mvc_modalidades',function() {
        cs_mvc_render_admin('admin/Modalidad','Modalidad');
    });
    add_submenu_page('cs_mvc_imagen_portadas','Tipo de Excursion','Tipo de Excursion', 'manage_options','cs_mvc_tipo_excursiones',function() {
        cs_mvc_render_admin('admin/TipoExcursion','TipoExcursion');
    });
    add_submenu_page('cs_mvc_imagen_portadas','Reservas Exc','Reservas Aloj', 'manage_options','cs_mvc_reserva_alojamienientos',function() {
        cs_mvc_render_admin('admin/ReservaExcursion','ReservaExcursion');
    });
    add_submenu_page('cs_mvc_imagen_portadas','Alojamientos','Alojamientos', 'manage_options','cs_mvc_alojamientos',function() {
        cs_mvc_render_admin('admin/Alojamiento','Alojamiento');
    });
    add_submenu_page('cs_mvc_reserva_excursiones_cxf','Imagen Alojamiento','Imagen de Alojamiento', 'manage_options','cs_mvc_imagen_alojamientos',function() {
        cs_mvc_render_admin('admin/ImagenAlojamiento','ImagenAlojamiento');
    });
    add_submenu_page('cs_mvc_reserva_excursiones','Habitaciones de Excursion','Habitaciones de Excursion', 'manage_options','cs_mvc_habitaciones',function() {
        cs_mvc_render_admin('admin/Habitacion','Habitacion');
    });
    add_submenu_page('cs_mvc_imagen_portadas','Servicios','Servicios', 'manage_options','cs_mvc_servicios',function() {
        cs_mvc_render_admin('admin/Servicios','Servicios');
    });
    add_submenu_page('cs_mvc_imagen_portadas','Tipo de Alojamiento','Tipo de Alojamiento', 'manage_options','cs_mvc_tipo_alojamientos',function() {
        cs_mvc_render_admin('admin/TipoAlojamiento','TipoAlojamiento');
    });
//    add_submenu_page('cs_mvc_reserva_excursiones','Destinos Turisticos GAC','Destinos Turisticos', 'manage_options','cs_mvc_destino_turisticos',function() {
//        cs_mvc_render_admin('admin/DestinoTuristico','DestinoTuristico');
//    });
//    add_submenu_page('cs_mvc_reserva_excursiones','Tipo de Destino','Tipo de Destino', 'manage_options','cs_mvc_tipo_destinos',function() {
//        cs_mvc_render_admin('admin/TipoDestino','TipoDestino');
//    });
//    add_submenu_page('cs_mvc_reserva_excursiones','Transportes GAC','Transportes', 'manage_options','cs_mvc_transportes',function() {
//        cs_mvc_render_admin('admin/Transporte','Transporte');
//    });
//    add_submenu_page('cs_mvc_reserva_excursiones','Tipo de Transporte','Tipo de Transporte', 'manage_options','cs_mvc_tipo_transportes',function() {
//        cs_mvc_render_admin('admin/TipoTransporte','TipoTransporte');
//    });
//    add_submenu_page('cs_mvc_reserva_excursiones','Choferes GAC','Choferes', 'manage_options','cs_mvc_choferes',function() {
//        cs_mvc_render_admin('admin/Chofer','Chofer');
//    });


//    add_submenu_page('cs_mvcadmin','Acciones','Acciones', 'manage_options','cs_mvc_acciones',function() {
//        cs_mvc_render_admin('admin/acciones','Accion');
//    });

});

////MVC-VM
function cs_mvc_render_admin($view, $viewmodel=null) {
//    cs_mvc_assets_admin();
//    if(isset($_REQUEST['controller']))
//        cs_mvc_create_controller();
//    else {
        $config = array();
        $config['view'] = $view;
        if($viewmodel) $config['viewmodel'] = $viewmodel;
        cs_mvc_render_main($config);
//    }
}
//Gestion de Assets
add_action( 'admin_print_styles', function() {
    if(preg_match("/^cs_mvc_/",Controller::in('page'))) {
        cs_mvc_assets_admin();
    }
} );


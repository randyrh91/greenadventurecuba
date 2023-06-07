<?php
/**
 * @package Siger
 * @version 1.1
 */
/*
Plugin Name: CS_MVC
Plugin URI: http://wordpress.org/plugins/Siger/
Description: This is main plugluin development for the site with MVC pattern
Author: PR0X
Version: 1.0
*/

define('CS_MVC_PATH',__DIR__);
define('CS_MVC_PATH_MODEL',CS_MVC_PATH.'/model');
define('CS_MVC_PATH_CONTROLLER',CS_MVC_PATH.'/controller');
define('CS_MVC_PATH_VIEW',CS_MVC_PATH.'/view');
define('CS_MVC_PATH_VMODEL',CS_MVC_PATH.'/viewmodel');
define('CS_MVC_PATH_PLUGIN',__FILE__);

define('CS_MVC_URL_ASSETIC',plugins_url('assetic',__FILE__));

////Inciaando  Rutas y Controlleres
add_action('init', function() {
    if(isset($_REQUEST['controller'])) {
       cs_mvc_create_controller();
    }
//    custom_rewrite_rule();
}, 10, 0);
function custom_rewrite_rule($file='rules') {
    $cs_mvc_rules = array();
    include_once CS_MVC_PATH . "/cs_mvc.php";
    foreach($cs_mvc_rules as $rule=>$redirect) {
        add_rewrite_rule($rule,$redirect,'top');
    }
    flush_rewrite_rules();
}

////MVC-VM
require_once CS_MVC_PATH . '/core/controller.php';
require_once CS_MVC_PATH . '/core/viewmodel.php';
require_once CS_MVC_PATH . '/core/view.php';

////Definiendo los helpers
include_once CS_MVC_PATH . '/helper/html.php';
include_once CS_MVC_PATH . '/helper/language.php';

////Administrar
if(is_admin()) {
    include_once CS_MVC_PATH . '/cs_mvc_admin.php';
//    wp_enqueue_script( 'language-script', plugins_url('assetic/language.js',__FILE__),array(),'1.0.0',true);
}

//render view
add_action('render_main','cs_mvc_render_main');

//Contenido de la pagina.
function cs_mvc_render_main($config=array()) {
    global $wp_query;
    $view = cs_mvc_get_view($config);
//    var_dump($view);die;
    $viewModelInstance = cs_mvc_get_viewmodel($config);
    View::create()->render($view,array("model"=>$viewModelInstance));
}


function cs_mvc_get_view($config=array()) {
    global $wp_query;
    if(isset($_REQUEST['view']))
        $view = $_REQUEST['view'];
    else {
        $view = get_post_field('view',$wp_query->post) ? get_post_field('view',$wp_query->post) :
            (isset($config['view'])? $config['view'] :
            ($wp_query->post && $wp_query->post->post_name ? str_replace('-','_',$wp_query->post->post_name):'index'));

    }
//    $view = isset($_REQUEST['view']) ? $_REQUEST['view'] :
//        get_post_field('view',$wp_query->post) ? get_post_field('view',$wp_query->post) :
//            (isset($config['view'])? $config['view'] :
//            ($wp_query->post && $wp_query->post->post_name ? str_replace('-','_',$wp_query->post->post_name):'index'));
//    var_dump($view);
//    $view = str_replace('%2F','/',$view);
    return $view;
}
function cs_mvc_get_viewmodel($config=array()) {
    global $wp_query;
    $viewModel = $_REQUEST['viewmodel'] ? $_REQUEST['viewmodel'] :
        (($p=get_post_field('viewmodel',$wp_query->post)) ? $p : (isset($config['viewmodel']) ? $config['viewmodel'] : false));
    if(isset($config['viewmodel'])) $viewModel = $config['viewmodel'];

    $viewModelInstance = null;
    if($viewModel) {
        require_once CS_MVC_PATH . '/viewmodel/' . $viewModel.'ViewModel.php';
        $viewModel .='ViewModel';
        $viewModelInstance = $viewModel;
//        $viewModelInstance = new $viewModel;
    }
    return $viewModelInstance;
}

//agregando el modelo
require_once CS_MVC_PATH . '/core/ormrepo.php';
require_once CS_MVC_PATH . '/core/ormmodel.php';

//acciones de controller
//add_action('wp_ajax_cs_mvc_action',function() {
//    cs_mvc_create_controller();
//});
function cs_mvc_create_controller($controller=null) {

    $rule = explode('.', $_REQUEST['controller']);
    if (count($rule) == 1) {
        $method = "save";
    } else $method = $rule[1];

    $controller = ucfirst($rule[0]);

    $filepath = CS_MVC_PATH . '/controller/' . $controller . 'Controller.php';
    if(file_exists($filepath)) {
        require_once $filepath;
        $controller .= "Controller";
        if(class_exists($controller,false)) {
            $controller = new $controller();
            $controller->$method();
            wp_die();
        }
    }

}

//Definiedo JS y CSS
add_action( 'wp_enqueue_scripts', 'cs_mvc_scripts');
function cs_mvc_scripts() {

    wp_localize_script( 'main-script', 'meta', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ), 'is_admin' => is_admin(), 'post_name'=> $wp_query->post ? $wp_query->post->postname: '',
        'base_url' => get_site_url(),'imgs_url' => CS_MVC_URL_ASSETIC.'/imgs/'
    ));
}

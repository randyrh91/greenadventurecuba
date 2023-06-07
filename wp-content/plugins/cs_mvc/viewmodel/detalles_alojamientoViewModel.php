<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/AccionModel.php';
class DetallesAlojamientoViewModel extends ViewModel{
    private $pruebas;
    private $prueba;
    private $post;


    function __construct() {
        $q = new WP_Query( 'page_id=66' );
        $this->post = $q->post;
    }

    /**
     * @return WP_Post
     */
    function getPost() {
        return $this->post;
    }

    /**
     * @return Array PruebaModel
     */
    function getPruebas() {
        if(!$this->pruebas) $this->pruebas = PruebaRepo::create()->all();
        return $this->pruebas;
    }

    /**
     * @return PruebaModel
     */
    function getPrueba() {
        if(!$this->prueba) $this->prueba = PruebaRepo::create()->oneBy(array(
            "(id>"               =>1,
                "OR nombre LIKE"    =>'"%OX%")',
            "id"                =>2,
        ));
        return $this->prueba;
    }

    function getCountPrueba() {
        $count = AccionRepo::create()->count(array("nombre LIKE"=>'"%re%"'));
        return $count;
    }

    function getDev() {
        return "<p>Aqui esta el modelo de la vista de *Detalles de alojamiento*</p>";
    }
} 
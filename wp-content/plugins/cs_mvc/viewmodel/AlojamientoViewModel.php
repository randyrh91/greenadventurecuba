<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/AccionModel.php';
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';

class AlojamientoViewModel extends ViewModel {


    function __construct() {
        $q = new WP_Query( 'page_id=' );
        $this->post = $q->post;
    }

    /**
     * @return array AlojamientoModel
     */
    function getHostalesPopulares($count) {

        return AlojamientoRepo::create()->all(0, $count, 'isPop DESC, likes DESC');
    }



    private $alojamientos;
    private $alojamiento;

    /**
     * @return array AlojamientoModel
     */
    function getAlojamientos() {
        $q = $this->in('q');
        if(!$q && !$this->alojamientos) $this->alojamientos = AlojamientoRepo::create()->all();
        elseif($q) {
            $this->alojamientos = AlojamientoRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR descripcion LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
                "OR precio LIKE"=>"'%$q%'",
                "OR categoria LIKE"=>"'%$q%'",
                "OR likes LIKE"=>"'%$q%'",
                "OR distanciaKM LIKE"=>"'%$q%'",
                "OR tiempo LIKE"=>"'%$q%'",
                "OR dias LIKE"=>"'%$q%'",
                "OR Post_ID LIKE"=>"'%$q%'",
            ));
        }
        return $this->alojamientos;
    }

    /**
     * @return AlojamientoModel
     */
    function getAlojamiento() {
        if(!$this->alojamiento){
            if($this->in('id'))
                $this->alojamiento = AlojamientoRepo::create()->oneBy($this->in_num('id'));
            else $this->alojamiento = new AlojamientoModel();
        }
        return $this->alojamiento;

    }
    /**
     * @return array AlojamientoModel
     */
    function getAlojamientoPopulares($count) {

        return AlojamientoRepo::create()->all(0, $count, 'isPop DESC, likes DESC');
    }
    function getTipoAlojamientos() {
        return TipoAlojamientoRepo::create()->all();
    }
    function getServicios() {
        return ServiciosRepo::create()->all();
    }

} 
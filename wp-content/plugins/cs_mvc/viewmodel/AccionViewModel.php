<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/AccionModel.php';
class AccionViewModel extends ViewModel {
    private $acciones;
    private $accion;

    /**
     * @return array AccionModel
     */
    function getAcciones() {
        $q = $this->in('q');
        if(!$q && !$this->acciones) $this->acciones = AccionRepo::create()->all();
        else if($q) {
            $this->acciones = AccionRepo::create()->allBy(array(
                "nombre LIKE"=>"'%$q%'"
            ));
        }
        return $this->acciones;
    }

    /**
     * @return AccionModel
     */
    function getAccion() {
        if(!$this->accion){
            if($this->in('id'))
                $this->accion = AccionRepo::create()->oneBy($this->in_num('id'));
            else $this->accion = new AccionModel();
        }
        return $this->accion;

    }


} 
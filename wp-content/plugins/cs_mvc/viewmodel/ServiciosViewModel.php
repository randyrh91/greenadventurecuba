<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';
class ServiciosViewModel extends ViewModel {
    private $tipoTransportes;
    private $tipoTransporte;

    /**
     * @return ServiciosModel[]
     */
    function getServicios() {
		$q = $this->in('q');
        if(!$q && !$this->tipoTransportes) $this->tipoTransportes = ServiciosRepo::create()->all();
		elseif($q) {
			$this->tipoTransportes = ServiciosRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
            ));
		}
        return $this->tipoTransportes;
    }

    /**
     * @return ServiciosModel
     */
    function getServicio() {
        if(!$this->tipoTransporte){
            if($this->in('id'))
                $this->tipoTransporte = ServiciosRepo::create()->oneBy($this->in_num('id'));
            else $this->tipoTransporte = new ServiciosModel();
        }
        return $this->tipoTransporte;

    }
	


}  
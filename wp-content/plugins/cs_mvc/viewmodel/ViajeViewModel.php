<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ViajeModel.php';
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
class ViajeViewModel extends ViewModel {
    private $viajes;
    private $viaje;

    /**
     * @return array ViajeModel
     */
    function getViajes() {
		$q = $this->in('q');
        if(!$q && !$this->viajes) $this->viajes = ViajeRepo::create()->all();
		elseif($q) {
			$this->viajes = ViajeRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR orden LIKE"=>"'%$q%'",
                "OR tiempo LIKE"=>"'%$q%'",
                "OR distanciaKM LIKE"=>"'%$q%'",
            ));
		}
        return $this->viajes;
    }

    /**
     * @return ViajeModel
     */
    function getViaje() {
        if(!$this->viaje){
            if($this->in('id'))
                $this->viaje = ViajeRepo::create()->oneBy($this->in_num('id'));
            else $this->viaje = new ViajeModel();
        }
        return $this->viaje;

    }
	
	function getTransportes() {
        return TransporteRepo::create()->all();
    }
	function getDestinoTuristicos() {
        return DestinoTuristicoRepo::create()->all();
    }
	function getExcursiones() {
        return ExcursionRepo::create()->all();
    }


}  
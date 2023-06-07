<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoTransporteModel.php';
class TipoTransporteViewModel extends ViewModel {
    private $tipoTransportes;
    private $tipoTransporte;

    /**
     * @return array TipoTransporteModel
     */
    function getTipoTransportes() {
		$q = $this->in('q');
        if(!$q && !$this->tipoTransportes) $this->tipoTransportes = TipoTransporteRepo::create()->all();
		elseif($q) {
			$this->tipoTransportes = TipoTransporteRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
            ));
		}
        return $this->tipoTransportes;
    }

    /**
     * @return TipoTransporteModel
     */
    function getTipoTransporte() {
        if(!$this->tipoTransporte){
            if($this->in('id'))
                $this->tipoTransporte = TipoTransporteRepo::create()->oneBy($this->in_num('id'));
            else $this->tipoTransporte = new TipoTransporteModel();
        }
        return $this->tipoTransporte;

    }
	


}  
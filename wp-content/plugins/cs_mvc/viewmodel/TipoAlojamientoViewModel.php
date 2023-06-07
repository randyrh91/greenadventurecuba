<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoAlojamientoModel.php';
class TipoAlojamientoViewModel extends ViewModel {
    private $tipoAlojamientos;
    private $tipoAlojamiento;

    /**
     * @return array TipoAlojamientoModel
     */
    function getTipoAlojamientos() {
		$q = $this->in('q');
        if(!$q && !$this->tipoAlojamientos) $this->tipoAlojamientos = TipoAlojamientoRepo::create()->all();
		elseif($q) {
			$this->tipoAlojamientos = TipoAlojamientoRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
            ));
		}
        return $this->tipoAlojamientos;
    }

    /**
     * @return TipoAlojamientoModel
     */
    function getTipoAlojamiento() {
        if(!$this->tipoAlojamiento){
            if($this->in('id'))
                $this->tipoAlojamiento = TipoAlojamientoRepo::create()->oneBy($this->in_num('id'));
            else $this->tipoAlojamiento = new TipoAlojamientoModel();
        }
        return $this->tipoAlojamiento;

    }
	


}  
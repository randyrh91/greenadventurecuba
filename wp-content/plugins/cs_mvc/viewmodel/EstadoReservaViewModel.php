<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/EstadoReservaModel.php';
class EstadoReservaViewModel extends ViewModel {
    private $estadoReservas;
    private $estadoReserva;

    /**
     * @return array EstadoReservaModel
     */
    function getEstadoReservas() {
		$q = $this->in('q');
        if(!$q && !$this->estadoReservas) $this->estadoReservas = EstadoReservaRepo::create()->all();
		elseif($q) {
			$this->estadoReservas = EstadoReservaRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
            ));
		}
        return $this->estadoReservas;
    }

    /**
     * @return EstadoReservaModel
     */
    function getEstadoReserva() {
        if(!$this->estadoReserva){
            if($this->in('id'))
                $this->estadoReserva = EstadoReservaRepo::create()->oneBy($this->in_num('id'));
            else $this->estadoReserva = new EstadoReservaModel();
        }
        return $this->estadoReserva;

    }
	


}  
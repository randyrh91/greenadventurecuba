<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ReservaExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/EstadoReservaModel.php';
class ReservaExcursionViewModel extends ViewModel {
    private $reservaExcursiones;
    private $reservaExcursion;

    /**
     * @return array ReservaExcursionModel
     */
    function getReservaExcursiones() {
		$q = $this->in('q');
        if($q) {
            if($q{0}=='#') $conds = array("id"=>substr($q,1));
            else $conds = array(
                "EstadoReserva_id".($this->in('type',2)<3?' <=':'')=>$this->in('type',2),
                "AND (id LIKE"=>"'%$q%'",
                "OR fecha LIKE"=>"'%$q%'",
                "OR hora LIKE"=>"'%$q%'",
                "OR precioOferta LIKE"=>"'%$q%'",
                "OR cantidadPersona LIKE"=>"'%$q%'",
                "OR descripcion LIKE"=>"'%$q%'",
                "OR User_ID LIKE"=>"'%$q%' )"
            );
            $this->reservaExcursiones = ReservaExcursionRepo::create()->allBy($conds,0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200),"EstadoReserva_id, fecha, id DESC");
        }
        elseif(!$this->reservaExcursiones) $this->reservaExcursiones = ReservaExcursionRepo::create()->all(0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200),"EstadoReserva_id, fecha, id DESC",
            array(
                "EstadoReserva_id".($this->in('type',2)<3?' <=':'')=>$this->in('type',2)
            ));

        return $this->reservaExcursiones;
    }

    /**
     * @return ReservaExcursionModel
     */
    function getReservaExcursion() {
        if(!$this->reservaExcursion){
            if($this->in('id'))
                $this->reservaExcursion = ReservaExcursionRepo::create()->oneBy($this->in_num('id'));
            else $this->reservaExcursion = new ReservaExcursionModel();
        }
        return $this->reservaExcursion;

    }

    function getUser() {
        $item = $this->getReservaExcursion();
        return json_decode($item->User_JSON);
    }
	
	function getExcursiones() {
        return ExcursionRepo::create()->all();
    }
	function getEstadoReservas() {
        return EstadoReservaRepo::create()->all();
    }

    function count() {
        return ReservaExcursionRepo::create()->count(array(),0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200));
    }
    function countTipo1_2() {
        return ReservaExcursionRepo::create()->count(array(
            "EstadoReserva_id <"=>3
        ),0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200));
    }
    function countTipo3() {
        return ReservaExcursionRepo::create()->count(array(
            "EstadoReserva_id"=>3
        ),0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200));
    }
    function countTipo4() {
        return ReservaExcursionRepo::create()->count(array(
            "EstadoReserva_id"=>4
        ),0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200));
    }
    function countTipo5() {
        return ReservaExcursionRepo::create()->count(array(
            "EstadoReserva_id"=>5
        ),0,($this->in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?1:200));
    }


}  
<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';
class HabitacionViewModel extends ViewModel {
    private $tipoExcursiones;
    private $tipoExcursion;

    /**
     * @return array HabitacionModel
     */
    function getHabitaciones() {
		$q = $this->in('q');
        if(!$q && !$this->tipoExcursiones) $this->tipoExcursiones = HabitacionRepo::create()->all();
		elseif($q) {
			$this->tipoExcursiones = HabitacionRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
            ));
		}
        return $this->tipoExcursiones;
    }

    /**
     * @return HabitacionModel
     */
    function getHabitacion() {
        if(!$this->tipoExcursion){
            if($this->in('id'))
                $this->tipoExcursion = HabitacionRepo::create()->oneBy($this->in_num('id'));
            else $this->tipoExcursion = new HabitacionModel();
        }
        return $this->tipoExcursion;

    }
    function getServicios() {
        return ServiciosRepo::create()->all();
    }

}  
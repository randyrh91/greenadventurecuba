<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenHabitacionModel.php';
require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';
class ImagenHabitacionViewModel extends ViewModel {
    private $imagenHabitaciones;
    private $imagenHabitacion;

    /**
     * @return array ImagenHabitacionModel
     */
    function getImagenHabitaciones() {
		$q = $this->in('q');
        if(!$q && !$this->imagenHabitaciones) $this->imagenHabitaciones = ImagenHabitacionRepo::create()->all();
		elseif($q) {
			$this->imagenHabitaciones = ImagenHabitacionRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->imagenHabitaciones;
    }

    /**
     * @return ImagenHabitacionModel
     */
    function getImagenHabitacion() {
        if(!$this->imagenHabitacion){
            if($this->in('id'))
                $this->imagenHabitacion = ImagenHabitacionRepo::create()->oneBy($this->in_num('id'));
            else $this->imagenHabitacion = new ImagenHabitacionModel();
        }
        return $this->imagenHabitacion;

    }
	
	function getHabitaciones() {
        return HabitacionRepo::create()->all();
    }


}  
<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenAlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
class ImagenAlojamientoViewModel extends ViewModel {
    private $imagenAlojamientos;
    private $imagenAlojamiento;

    /**
     * @return array ImagenAlojamientoModel
     */
    function getImagenAlojamientos() {
		$q = $this->in('q');
        if(!$q && !$this->imagenAlojamientos) $this->imagenAlojamientos = ImagenAlojamientoRepo::create()->all();
		elseif($q) {
			$this->imagenAlojamientos = ImagenAlojamientoRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->imagenAlojamientos;
    }

    /**
     * @return ImagenAlojamientoModel
     */
    function getImagenAlojamiento() {
        if(!$this->imagenAlojamiento){
            if($this->in('id'))
                $this->imagenAlojamiento = ImagenAlojamientoRepo::create()->oneBy($this->in_num('id'));
            else $this->imagenAlojamiento = new ImagenAlojamientoModel();
        }
        return $this->imagenAlojamiento;

    }
	
	function getAlojamientos() {
        return AlojamientoRepo::create()->all();
    }


}  
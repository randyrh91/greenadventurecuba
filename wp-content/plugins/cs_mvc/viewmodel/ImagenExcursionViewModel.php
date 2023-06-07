<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
class ImagenExcursionViewModel extends ViewModel {
    private $imagenExcursiones;
    private $imagenExcursion;

    /**
     * @return array ImagenExcursionModel
     */
    function getImagenExcursiones() {
		$q = $this->in('q');
        if(!$q && !$this->imagenExcursiones) $this->imagenExcursiones = ImagenExcursionRepo::create()->all();
		elseif($q) {
			$this->imagenExcursiones = ImagenExcursionRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->imagenExcursiones;
    }

    /**
     * @return ImagenExcursionModel
     */
    function getImagenExcursion() {
        if(!$this->imagenExcursion){
            if($this->in('id'))
                $this->imagenExcursion = ImagenExcursionRepo::create()->oneBy($this->in_num('id'));
            else $this->imagenExcursion = new ImagenExcursionModel();
        }
        return $this->imagenExcursion;

    }
	
	function getExcursiones() {
        return ExcursionRepo::create()->all();
    }


}  
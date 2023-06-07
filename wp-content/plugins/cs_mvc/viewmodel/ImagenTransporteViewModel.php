<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenTransporteModel.php';
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';
class ImagenTransporteViewModel extends ViewModel {
    private $imagenTransportes;
    private $imagenTransporte;

    /**
     * @return array ImagenTransporteModel
     */
    function getImagenTransportes() {
		$q = $this->in('q');
        if(!$q && !$this->imagenTransportes) $this->imagenTransportes = ImagenTransporteRepo::create()->all();
		elseif($q) {
			$this->imagenTransportes = ImagenTransporteRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->imagenTransportes;
    }

    /**
     * @return ImagenTransporteModel
     */
    function getImagenTransporte() {
        if(!$this->imagenTransporte){
            if($this->in('id'))
                $this->imagenTransporte = ImagenTransporteRepo::create()->oneBy($this->in_num('id'));
            else $this->imagenTransporte = new ImagenTransporteModel();
        }
        return $this->imagenTransporte;

    }
	
	function getTransportes() {
        return TransporteRepo::create()->all();
    }


}  
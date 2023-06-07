<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenDestinoTuristicoModel.php';
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';
class ImagenDestinoTuristicoViewModel extends ViewModel {
    private $imagenDestinoTuristicos;
    private $imagenDestinoTuristico;

    /**
     * @return array ImagenDestinoTuristicoModel
     */
    function getImagenDestinoTuristicos() {
		$q = $this->in('q');
        if(!$q && !$this->imagenDestinoTuristicos) $this->imagenDestinoTuristicos = ImagenDestinoTuristicoRepo::create()->all();
		elseif($q) {
			$this->imagenDestinoTuristicos = ImagenDestinoTuristicoRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->imagenDestinoTuristicos;
    }

    /**
     * @return ImagenDestinoTuristicoModel
     */
    function getImagenDestinoTuristico() {
        if(!$this->imagenDestinoTuristico){
            if($this->in('id'))
                $this->imagenDestinoTuristico = ImagenDestinoTuristicoRepo::create()->oneBy($this->in_num('id'));
            else $this->imagenDestinoTuristico = new ImagenDestinoTuristicoModel();
        }
        return $this->imagenDestinoTuristico;

    }
	
	function getDestinoTuristicos() {
        return DestinoTuristicoRepo::create()->all();
    }


}  
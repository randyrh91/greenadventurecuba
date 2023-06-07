<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenPortadaModel.php';
require_once CS_MVC_PATH_MODEL . '/CellPortadaModel.php';
class ImagenPortadaViewModel extends ViewModel {
    private $imagenPortadas;
    private $imagenPortada;

    /**
     * @return array ImagenPortadaModel
     */
    function getImagenPortadas() {
		$q = $this->in('q');
        if(!$q && !$this->imagenPortadas) $this->imagenPortadas = ImagenPortadaRepo::create()->allBy(array('active'=>1));
		elseif($q) {
			$this->imagenPortadas = ImagenPortadaRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
            ));
		}
        return $this->imagenPortadas;
    }

    /**
     * @return ImagenPortadaModel
     */
    function getImagenPortada() {
        if(!$this->imagenPortada){
            if($this->in('id'))
                $this->imagenPortada = ImagenPortadaRepo::create()->oneBy($this->in_num('id'));
            else $this->imagenPortada = new ImagenPortadaModel();
        }
        return $this->imagenPortada;

    }

    private $cells_assoc;
    /**
     * @return CellPortadaModel[]
     */
    function getCelsAssoc() {
        if(!$this->cells_assoc){
            $this->cells_assoc = CellPortadaRepo::create()->all();
        }
        return $this->cells_assoc;

    }

}  
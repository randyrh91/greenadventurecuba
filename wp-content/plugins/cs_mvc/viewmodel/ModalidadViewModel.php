<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ModalidadModel.php';
class ModalidadViewModel extends ViewModel {
    private $modalidades;
    private $modalidad;

    /**
     * @return array ModalidadModel
     */
    function getModalidades() {
		$q = $this->in('q');
        if(!$q && !$this->modalidades) $this->modalidades = ModalidadRepo::create()->all();
		elseif($q) {
			$this->modalidades = ModalidadRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
            ));
		}
        return $this->modalidades;
    }

    /**
     * @return ModalidadModel
     */
    function getModalidad() {
        if(!$this->modalidad){
            if($this->in('id'))
                $this->modalidad = ModalidadRepo::create()->oneBy($this->in_num('id'));
            else $this->modalidad = new ModalidadModel();
        }
        return $this->modalidad;

    }
	


}  
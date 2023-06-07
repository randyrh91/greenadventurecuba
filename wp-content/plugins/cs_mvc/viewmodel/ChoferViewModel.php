<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ListaPrecioModel.php';
class ChoferViewModel extends ViewModel {
    private $choferes;
    private $chofer;

    /**
     * @return array ChoferModel
     */
    function getChoferes() {
		$q = $this->in('q');
        if(!$q && !$this->choferes) $this->choferes = ChoferRepo::create()->all();
		elseif($q) {
			$this->choferes = ChoferRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR telefono LIKE"=>"'%$q%'",
                "OR anosExperiencia LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->choferes;
    }

    /**
     * @return ChoferModel
     */
    function getChofer() {
        if(!$this->chofer){
            if($this->in('id'))
                $this->chofer = ChoferRepo::create()->oneBy($this->in_num('id'));
            else $this->chofer = new ChoferModel();
        }
        return $this->chofer;

    }
	


}  
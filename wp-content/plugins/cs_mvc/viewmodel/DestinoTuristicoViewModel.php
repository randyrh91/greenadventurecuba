<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';
require_once CS_MVC_PATH_MODEL . '/TipoDestinoModel.php';
class DestinoTuristicoViewModel extends ViewModel {
    private $destinoTuristicos;
    private $destinoTuristico;

    /**
     * @return array DestinoTuristicoModel
     */
    function getDestinoTuristicos() {
		$q = $this->in('q');
        if(!$q && !$this->destinoTuristicos) $this->destinoTuristicos = DestinoTuristicoRepo::create()->all();
		elseif($q) {
			$this->destinoTuristicos = DestinoTuristicoRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
                "OR descripcion LIKE"=>"'%$q%'",
                "OR foto LIKE"=>"'%$q%'",
            ));
		}
        return $this->destinoTuristicos;
    }

    /**
     * @return DestinoTuristicoModel
     */
    function getDestinoTuristico() {
        if(!$this->destinoTuristico){
            if($this->in('id'))
                $this->destinoTuristico = DestinoTuristicoRepo::create()->oneBy($this->in_num('id'));
            else $this->destinoTuristico = new DestinoTuristicoModel();
        }
        return $this->destinoTuristico;

    }
	
	function getTipoDestinos() {
        return TipoDestinoRepo::create()->all();
    }


}  
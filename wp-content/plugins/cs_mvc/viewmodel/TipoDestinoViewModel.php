<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoDestinoModel.php';
class TipoDestinoViewModel extends ViewModel {
    private $tipoDestinos;
    private $tipoDestino;

    /**
     * @return array TipoDestinoModel
     */
    function getTipoDestinos() {
		$q = $this->in('q');
        if(!$q && !$this->tipoDestinos) $this->tipoDestinos = TipoDestinoRepo::create()->all();
		elseif($q) {
			$this->tipoDestinos = TipoDestinoRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
            ));
		}
        return $this->tipoDestinos;
    }

    /**
     * @return TipoDestinoModel
     */
    function getTipoDestino() {
        if(!$this->tipoDestino){
            if($this->in('id'))
                $this->tipoDestino = TipoDestinoRepo::create()->oneBy($this->in_num('id'));
            else $this->tipoDestino = new TipoDestinoModel();
        }
        return $this->tipoDestino;

    }
	


}  
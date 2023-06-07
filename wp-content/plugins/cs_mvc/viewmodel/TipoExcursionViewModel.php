<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoExcursionModel.php';
class TipoExcursionViewModel extends ViewModel {
    private $tipoExcursiones;
    private $tipoExcursion;

    /**
     * @return array TipoExcursionModel
     */
    function getTipoExcursiones() {
		$q = $this->in('q');
        if(!$q && !$this->tipoExcursiones) $this->tipoExcursiones = TipoExcursionRepo::create()->all();
		elseif($q) {
			$this->tipoExcursiones = TipoExcursionRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
            ));
		}
        return $this->tipoExcursiones;
    }

    /**
     * @return TipoExcursionModel
     */
    function getTipoExcursion() {
        if(!$this->tipoExcursion){
            if($this->in('id'))
                $this->tipoExcursion = TipoExcursionRepo::create()->oneBy($this->in_num('id'));
            else $this->tipoExcursion = new TipoExcursionModel();
        }
        return $this->tipoExcursion;

    }

}  
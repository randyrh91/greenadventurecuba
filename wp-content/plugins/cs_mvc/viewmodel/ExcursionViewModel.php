<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/TipoExcursionModel.php';
class ExcursionViewModel extends ViewModel {
    private $excursiones;
    private $excursion;

    /**
     * @return array ExcursionModel
     */
    function getExcursiones() {
		$q = $this->in('q');
        if(!$q && !$this->excursiones) $this->excursiones = ExcursionRepo::create()->all();
		elseif($q) {
			$this->excursiones = ExcursionRepo::create()->allBy(array(
                "id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR descripcion LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%'",
                "OR precio LIKE"=>"'%$q%'",
                "OR categoria LIKE"=>"'%$q%'",
                "OR likes LIKE"=>"'%$q%'",
                "OR distanciaKM LIKE"=>"'%$q%'",
                "OR tiempo LIKE"=>"'%$q%'",
                "OR dias LIKE"=>"'%$q%'",
                "OR Post_ID LIKE"=>"'%$q%'",
            ));
		}
        return $this->excursiones;
    }

    /**
     * @return ExcursionModel
     */
    function getExcursion() {
        if(!$this->excursion){
            if($this->in('id'))
                $this->excursion = ExcursionRepo::create()->oneBy($this->in_num('id'));
            else $this->excursion = new ExcursionModel();
        }
        return $this->excursion;

    }
    /**
     * @return array ExcursionModel
     */
    function getExcursionPopulares($count) {

        return ExcursionRepo::create()->all(0, $count, 'isPop DESC, likes DESC');
    }
	function getTipoExcursiones() {
        return TipoExcursionRepo::create()->all();
    }

    private $destinoTuristicos;
    function getDestinoTuristicos() {
        if(!$this->destinoTuristicos)
            $this->destinoTuristicos = DestinoTuristicoRepo::create()->all();
        return $this->destinoTuristicos;
    }

    private $transportes;
    function getTransportes() {
        if(!$this->transportes)
            $this->transportes = TransporteRepo::create()->all();
        return $this->transportes;
    }
 private $modalidades;
    function getModalidades() {
        if(!$this->modalidades)
            $this->modalidades = ModalidadRepo::create()->all();
        return $this->modalidades;
    }

//    ------
//FUnciones pora el SideBAr y mas
//      ------
    function getRandomTransportes($start=0,$count=3) {
        return TransporteRepo::create()->all($start,$count);
    }
    function getRandomDestinos($start=0,$count=3) {
        return DestinoTuristicoRepo::create()->all($start,$count);
    }

    function getTransporteFromExcursion($id) {
        /** @var ExcursionModel $exc */
        $exc = ExcursionRepo::create()->oneBy((int)$id);
        $transportes_id = array();
        foreach($exc->getViajes() as $v) {
            $t = $v->getTransporte();
            if(!isset($transportes_id[$t->id]))
                $transportes_id[$t->id] = $t;
        }
        return $transportes_id;
    }

    function getDestinosFromExcursion($id) {
        /** @var ExcursionModel $exc */
        $exc = ExcursionRepo::create()->oneBy((int)$id);
        $destinos_id = array();
        foreach($exc->getViajes() as $v) {
            $t = $v->getDestinoTuristico();
            if(!isset($destinos_id[$t->id]))
                $destinos_id[$t->id] = $t;
        }
        return $destinos_id;
    }
    function getOneDestinoFromExcursion($id) {
        /** @var ExcursionModel $exc */
        $exc = ExcursionRepo::create()->oneBy((int)$id);
        $destinos=null;
        foreach($exc->getViajes() as $v) {
            $destinos = $v->getDestinoTuristico();
            break;
        }
        return $destinos;
    }
}  
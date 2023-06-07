<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/EstadoReservaModel.php';

class EstadoReservaController extends Controller {

    function save() {
        $estadoReserva = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('EstadoReservas-edit/?show_details=1&id='.$estadoReserva->id));
        $this->redirect($this->genPathVM('cs_mvc_estado_reservas','admin/EstadoReserva_edit','EstadoReserva',$estadoReserva->id));
    }
	
	/**
    * @return EstadoReservaModel
    */
    private function _save($data) {
        $estadoReserva = EstadoReservaRepo::create()->oneBy(intval($data['id']));
        if (!$estadoReserva)
            $estadoReserva = new EstadoReservaModel();
        $estadoReserva->save($data);
        return $estadoReserva;
    }

    function remove() {
        if($this->in('id')) {
            EstadoReservaRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_estado_reservas'));
        $this->redirectPage('cs_mvc_estado_reservas');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            EstadoReservaRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $estadoReserva = $this->_save($this->in_ajax());
        $this->responseJSON($estadoReserva->toArray());
    }

} 
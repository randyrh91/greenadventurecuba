<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';

class ServicioController extends Controller {

    function save() {
        $servicio = $this->_save($_REQUEST);
//        var_dump($servicio); die;
        $this->uploadFoto($servicio,true,'icono');

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Servicios-edit/?show_details=1&id='.$servicio->id));
        $this->redirect($this->genPathVM('cs_mvc_servicios','admin/Servicios_edit','Servicios',$servicio->id));
    }
	
	/**
    * @return ServiciosModel
    */
    private function _save($data) {
        $servicio = ServiciosRepo::create()->oneBy(intval($data['id']));
        if (!$servicio)
            $servicio = new ServiciosModel();
        $servicio->save($data);
        return $servicio;
    }

    function remove() {
        if($this->in('id')) {
            ServiciosRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_servicios'));
        $this->redirectPage('cs_mvc_servicios');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ServiciosRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $servicio = $this->_save($this->in_ajax());
        $this->responseJSON($servicio->toArray());
    }

} 
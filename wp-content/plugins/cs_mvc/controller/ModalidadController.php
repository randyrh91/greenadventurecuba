<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ModalidadModel.php';

class ModalidadController extends Controller {

    function save() {
        $modalidad = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Modalidades-edit/?show_details=1&id='.$modalidad->id));
        $this->redirect($this->genPathVM('cs_mvc_modalidades','admin/Modalidad_edit','Modalidad',$modalidad->id));
    }
	
	/**
    * @return ModalidadModel
    */
    private function _save($data) {
        $modalidad = ModalidadRepo::create()->oneBy(intval($data['id']));
        if (!$modalidad)
            $modalidad = new ModalidadModel();
        $modalidad->save($data);
        return $modalidad;
    }

    function remove() {
        if($this->in('id')) {
            ModalidadRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_modalidades'));
        $this->redirectPage('cs_mvc_modalidades');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ModalidadRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $modalidad = $this->_save($this->in_ajax());
        $this->responseJSON($modalidad->toArray());
    }

} 
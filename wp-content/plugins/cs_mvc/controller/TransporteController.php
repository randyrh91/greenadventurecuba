<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';

class TransporteController extends Controller {

    function save() {
        $transporte = $this->_save($_REQUEST);
        $this->uploadFoto($transporte);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Transportes-edit/?show_details=1&id='.$transporte->id));
        $this->redirect($this->genPathVM('cs_mvc_transportes','admin/Transporte_edit','Transporte',$transporte->id));
    }
	
	/**
    * @return TransporteModel
    */
    private function _save($data) {
        $transporte = TransporteRepo::create()->oneBy(intval($data['id']));
        if (!$transporte)
            $transporte = new TransporteModel();
        $transporte->save($data);
        return $transporte;
    }

    function remove() {
        if($this->in('id')) {
            TransporteRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_transportes'));
        $this->redirectPage('cs_mvc_transportes');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            TransporteRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $transporte = $this->_save($this->in_ajax());
        $this->responseJSON($transporte->toArray());
    }

} 
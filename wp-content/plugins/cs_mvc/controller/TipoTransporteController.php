<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoTransporteModel.php';

class TipoTransporteController extends Controller {

    function save() {
        $tipoTransporte = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('TipoTransportes-edit/?show_details=1&id='.$tipoTransporte->id));
        $this->redirect($this->genPathVM('cs_mvc_tipo_transportes','admin/TipoTransporte_edit','TipoTransporte',$tipoTransporte->id));
    }
	
	/**
    * @return TipoTransporteModel
    */
    private function _save($data) {
        $tipoTransporte = TipoTransporteRepo::create()->oneBy(intval($data['id']));
        if (!$tipoTransporte)
            $tipoTransporte = new TipoTransporteModel();
        $tipoTransporte->save($data);
        return $tipoTransporte;
    }

    function remove() {
        if($this->in('id')) {
            TipoTransporteRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_tipo_transportes'));
        $this->redirectPage('cs_mvc_tipo_transportes');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            TipoTransporteRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $tipoTransporte = $this->_save($this->in_ajax());
        $this->responseJSON($tipoTransporte->toArray());
    }

} 
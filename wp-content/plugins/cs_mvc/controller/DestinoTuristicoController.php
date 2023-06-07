<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';

class DestinoTuristicoController extends Controller {

    function save() {
        $destinoTuristico = $this->_save($_REQUEST);
        $this->uploadFoto($destinoTuristico);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('DestinoTuristicos-edit/?show_details=1&id='.$destinoTuristico->id));
        $this->redirect($this->genPathVM('cs_mvc_destino_turisticos','admin/DestinoTuristico_edit','DestinoTuristico',$destinoTuristico->id));
    }
	
	/**
    * @return DestinoTuristicoModel
    */
    private function _save($data) {
        $destinoTuristico = DestinoTuristicoRepo::create()->oneBy(intval($data['id']));
        if (!$destinoTuristico)
            $destinoTuristico = new DestinoTuristicoModel();
        $destinoTuristico->save($data);
        return $destinoTuristico;
    }

    function remove() {
        if($this->in('id')) {
            DestinoTuristicoRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_destino_turisticos'));
        $this->redirectPage('cs_mvc_destino_turisticos');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            DestinoTuristicoRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $destinoTuristico = $this->_save($this->in_ajax());
        $this->responseJSON($destinoTuristico->toArray());
    }

} 
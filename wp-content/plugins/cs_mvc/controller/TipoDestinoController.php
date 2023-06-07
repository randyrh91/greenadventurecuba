<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoDestinoModel.php';

class TipoDestinoController extends Controller {

    function save() {
        $tipoDestino = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('TipoDestinos-edit/?show_details=1&id='.$tipoDestino->id));
        $this->redirect($this->genPathVM('cs_mvc_tipo_destinos','admin/TipoDestino_edit','TipoDestino',$tipoDestino->id));
    }
	
	/**
    * @return TipoDestinoModel
    */
    private function _save($data) {
        $tipoDestino = TipoDestinoRepo::create()->oneBy(intval($data['id']));
        if (!$tipoDestino)
            $tipoDestino = new TipoDestinoModel();
        $tipoDestino->save($data);
        return $tipoDestino;
    }

    function remove() {
        if($this->in('id')) {
            TipoDestinoRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_tipo_destinos'));
        $this->redirectPage('cs_mvc_tipo_destinos');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            TipoDestinoRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $tipoDestino = $this->_save($this->in_ajax());
        $this->responseJSON($tipoDestino->toArray());
    }

} 
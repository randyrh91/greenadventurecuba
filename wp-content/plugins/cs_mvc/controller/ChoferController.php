<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ListaPrecioModel.php';
require_once CS_MVC_PATH_MODEL . '/ChoferModel.php';

class ChoferController extends Controller {

    function save() {
        $chofer = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Choferes-edit/?show_details=1&id='.$chofer->id));
        $this->redirect($this->genPathVM('cs_mvc_choferes','admin/Chofer_edit','Chofer',$chofer->id));
    }
	
	/**
    * @return ChoferModel
    */
    private function _save($data) {
        $chofer = ChoferRepo::create()->oneBy(intval($data['id']));
        if (!$chofer)
            $chofer = new ChoferModel();
        $chofer->save($data);
        return $chofer;
    }

    function remove() {
        if($this->in('id')) {
            ChoferRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_choferes'));
        $this->redirectPage('cs_mvc_choferes');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ChoferRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $chofer = $this->_save($this->in_ajax());
        $this->responseJSON($chofer->toArray());
    }

} 
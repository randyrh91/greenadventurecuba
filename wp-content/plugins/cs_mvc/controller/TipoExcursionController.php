<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoExcursionModel.php';

class TipoExcursionController extends Controller {

    function save() {
        $tipoExcursion = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('TipoExcursiones-edit/?show_details=1&id='.$tipoExcursion->id));
        $this->redirect($this->genPathVM('cs_mvc_tipo_excursiones','admin/TipoExcursion_edit','TipoExcursion',$tipoExcursion->id));
    }
	
	/**
    * @return TipoExcursionModel
    */
    private function _save($data) {
        $tipoExcursion = TipoExcursionRepo::create()->oneBy(intval($data['id']));
        if (!$tipoExcursion)
            $tipoExcursion = new TipoExcursionModel();
        $tipoExcursion->save($data);
        return $tipoExcursion;
    }

    function remove() {
        if($this->in('id')) {
            TipoExcursionRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_tipo_excursiones'));
        $this->redirectPage('cs_mvc_tipo_excursiones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            TipoExcursionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $tipoExcursion = $this->_save($this->in_ajax());
        $this->responseJSON($tipoExcursion->toArray());
    }

} 
<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ViajeModel.php';

class ViajeController extends Controller {

    function save() {
        $viaje = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Viajes-edit/?show_details=1&id='.$viaje->id));
        $this->redirect($this->genPathVM('cs_mvc_viajes','admin/Viaje_edit','Viaje',$viaje->id));
    }
	
	/**
    * @return ViajeModel
    */
    private function _save($data) {
        $viaje = ViajeRepo::create()->oneBy(intval($data['id']));
        if (!$viaje)
            $viaje = new ViajeModel();
        $viaje->save($data);
        return $viaje;
    }

    function remove() {
        if($this->in('id')) {
            ViajeRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_viajes'));
        $this->redirectPage('cs_mvc_viajes');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ViajeRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $viaje = $this->_save($this->in_ajax());
        $this->responseJSON($viaje->toArray());
    }

    function saveAccion()
    {
        $acc = AccionRepo::create()->oneBy($this->in_num('id', 0));
        if (!$acc)
            $acc = new AccionModel();
//        var_dump($_REQUEST);
        $acc->save($_REQUEST);
//        var_dump($acc); die;
        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Viaje_edit', 'Viaje', $this->in('Viaje_id')));
    }

} 
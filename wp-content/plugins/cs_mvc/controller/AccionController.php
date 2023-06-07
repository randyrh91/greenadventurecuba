<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/AccionModel.php';

class AccionController extends Controller {

    function save() {
        $acc = AccionRepo::create()->oneBy($this->in_num('id',0));
//        var_dump($acc); die;

        if(!$acc)
            $acc = new AccionModel();
        $acc->save($_REQUEST);
        $this->redirect($this->genPathVM('cs_mvc_acciones','admin/accion_edit','accion',$acc->id));
    }

    function saveJSON() {
        $accion = $this->_save($this->in_ajax());
        $this->responseJSON($accion->toArray());
    }
    /**
     * @return AccionModel
     */
    private function _save($data) {
        $accion = AccionRepo::create()->oneBy(intval($data['id']));
        if (!$accion)
            $accion = new AccionModel();
        $accion->save($data);
        return $accion;
    }

    function remove() {
        if($this->in('id')) {
            AccionRepo::create()->oneBy(array('id'=>$this->in('id')))->delete();
        }
        $this->redirectPage('cs_mvc_acciones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            AccionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }
} 
<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenTransporteModel.php';

class ImagenTransporteController extends Controller {

    function save() {
        $imagenTransporte = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('ImagenTransportes-edit/?show_details=1&id='.$imagenTransporte->id));
        $this->redirect($this->genPathVM('cs_mvc_imagen_transportes','admin/ImagenTransporte_edit','ImagenTransporte',$imagenTransporte->id));
    }
	
	/**
    * @return ImagenTransporteModel
    */
    private function _save($data) {
        $imagenTransporte = ImagenTransporteRepo::create()->oneBy(intval($data['id']));
        if (!$imagenTransporte)
            $imagenTransporte = new ImagenTransporteModel();
        $imagenTransporte->save($data);
        return $imagenTransporte;
    }

    function remove() {
        if($this->in('id')) {
            ImagenTransporteRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_imagen_transportes'));
        $this->redirectPage('cs_mvc_imagen_transportes');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ImagenTransporteRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $imagenTransporte = $this->_save($this->in_ajax());
        $this->responseJSON($imagenTransporte->toArray());
    }

} 
<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenDestinoTuristicoModel.php';

class ImagenDestinoTuristicoController extends Controller {

    function save() {
        $imagenDestinoTuristico = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('ImagenDestinoTuristicos-edit/?show_details=1&id='.$imagenDestinoTuristico->id));
        $this->redirect($this->genPathVM('cs_mvc_imagen_destino_turisticos','admin/ImagenDestinoTuristico_edit','ImagenDestinoTuristico',$imagenDestinoTuristico->id));
    }
	
	/**
    * @return ImagenDestinoTuristicoModel
    */
    private function _save($data) {
        $imagenDestinoTuristico = ImagenDestinoTuristicoRepo::create()->oneBy(intval($data['id']));
        if (!$imagenDestinoTuristico)
            $imagenDestinoTuristico = new ImagenDestinoTuristicoModel();
        $imagenDestinoTuristico->save($data);
        return $imagenDestinoTuristico;
    }

    function remove() {
        if($this->in('id')) {
            ImagenDestinoTuristicoRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_imagen_destino_turisticos'));
        $this->redirectPage('cs_mvc_imagen_destino_turisticos');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ImagenDestinoTuristicoRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $imagenDestinoTuristico = $this->_save($this->in_ajax());
        $this->responseJSON($imagenDestinoTuristico->toArray());
    }

} 
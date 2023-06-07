<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenExcursionModel.php';

class ImagenExcursionController extends Controller {

    function save() {
        $imagenExcursion = $this->_save($_REQUEST);
        $this->uploadFoto($imagenExcursion);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('ImagenExcursiones-edit/?show_details=1&id='.$imagenExcursion->id));
        $this->redirect($this->genPathVM('cs_mvc_imagen_excursiones','admin/ImagenExcursion_edit','ImagenExcursion',$imagenExcursion->id));
    }
	
	/**
    * @return ImagenExcursionModel
    */
    private function _save($data) {
        $imagenExcursion = ImagenExcursionRepo::create()->oneBy(intval($data['id']));
        if (!$imagenExcursion)
            $imagenExcursion = new ImagenExcursionModel();
        $imagenExcursion->save($data);
        return $imagenExcursion;
    }

    function remove() {
        if($this->in('id')) {
            ImagenExcursionRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_imagen_excursiones'));
        $this->redirectPage('cs_mvc_imagen_excursiones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ImagenExcursionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $imagenExcursion = $this->_save($this->in_ajax());
        $this->responseJSON($imagenExcursion->toArray());
    }

} 
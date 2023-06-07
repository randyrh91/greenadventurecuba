<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenPortadaModel.php';
require_once CS_MVC_PATH_MODEL . '/CellPortadaModel.php';

class ImagenPortadaController extends Controller {

    function save() {
        $imagenPortada = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('ImagenPortadas-edit/?show_details=1&id='.$imagenPortada->id));
        $this->redirect($this->genPathVM('cs_mvc_imagen_portadas','admin/ImagenPortada_edit','ImagenPortada',$imagenPortada->id));
    }
	
	/**
    * @return ImagenPortadaModel
    */
    private function _save($data) {
        $imagenPortada = ImagenPortadaRepo::create()->oneBy(intval($data['id']));
        if (!$imagenPortada)
            $imagenPortada = new ImagenPortadaModel();
        $imagenPortada->save($data);
        $this->uploadFoto($imagenPortada);
        return $imagenPortada;
    }

    function remove() {
        if($this->in('id')) {
            ImagenPortadaRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_imagen_portadas'));
        $this->redirectPage('cs_mvc_imagen_portadas');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ImagenPortadaRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $imagenPortada = $this->_save($this->in_ajax());
        $this->responseJSON($imagenPortada->toArray());
    }

    function saveCell() {
        /** @var CellPortadaModel $cell */
        $cell = CellPortadaRepo::create()->oneBy($this->in_num('id'));
        $cell->save($_REQUEST);
        $this->uploadFoto($cell);
        $this->redirect($this->genPathVM('cs_mvc_imagen_portadas','admin/ImagenPortada','ImagenPortada'));
    }

} 
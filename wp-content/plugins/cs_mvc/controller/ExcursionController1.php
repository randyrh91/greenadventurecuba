<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class ExcursionController extends Controller {

    function save() {
        $excursion = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Excursiones-edit/?show_details=1&id='.$excursion->id));
        $this->redirect($this->genPathVM('cs_mvc_excursiones','admin/Excursion_edit','Excursion',$excursion->id));
    }
	
	/**
    * @return ExcursionModel
    */
    private function _save($data) {
        $excursion = ExcursionRepo::create()->oneBy(intval($data['id']));
        if (!$excursion)
            $excursion = new ExcursionModel();
        $excursion->save($data);
        return $excursion;
    }

    function remove() {
        if($this->in('id')) {
            ExcursionRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_excursiones'));
        $this->redirectPage('cs_mvc_excursiones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ExcursionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $excursion = $this->_save($this->in_ajax());
        $this->responseJSON($excursion->toArray());
    }

    function upLoadImg() {
        $img = new ImagenExcursionModel();
        $img->nombre = $_REQUEST['nombre'];
        $img->foto = $this->in('foto');
        $img->Excursion_id = $_REQUEST['Excursion_id'];
        $img->save();
        if(!$this->in('foto'))
            $this->uploadFoto($img);

        $this->redirect($this->genPathVM('cs_mvc_excursiones','admin/Excursion_edit','Excursion',$this->in('Excursion_id')));
    }

    function upLoadImgs() {
        $path = $this->in('foto_dir');
        if(is_dir($path)) { //verificando que exista la carpeta
            if ($dir = opendir($path)) {
                while (($file_dir = readdir($dir)) !== false) { //leyendo el contenido de la carpeta
//                    if(is_file($path."/".$file_dir) && preg_match("/.scnodo$/",$file_dir)) { //verificar que es un file
                    if (is_file($path . "/" . $file_dir) && preg_match('/.jpg|.png$/i', $file_dir)) { //verificar que es un file
                        var_dump($file_dir."===".$path . "/" . $file_dir);
                        $new_name = $file_dir;
                        copy($path . "/" . $file_dir,CS_MVC_PATH.'/foto/'.$new_name);
                    }
                }
                closedir($dir);
            }
        }

        die;
        $img = new ImagenExcursionModel();
        $img->nombre = $_REQUEST['nombre'];
        $img->foto = $this->in('foto');
        $img->Excursion_id = $_REQUEST['Excursion_id'];
        $img->save();
        if(!$this->in('foto'))
            $this->uploadFoto($img);

        $this->redirect($this->genPathVM('cs_mvc_excursiones','admin/Excursion_edit','Excursion',$this->in('Excursion_id')));
    }

    function deleteImg() {
        /** @var ImagenExcursionModel $img */
        $img = ImagenExcursionRepo::create()->oneBy($this->in_num('id'));
        $this->deleteFoto($img);
        $img->delete();

        $this->responseJSON(array('success'=>'true'));
    }

    function saveDestinoTuristico() {
        $data = $_REQUEST;
        $viaje = ViajeRepo::create()->oneBy(intval($data['id']));
        if (!$viaje)
            $viaje = new ViajeModel();
        $viaje->save($data);

        $this->redirect($this->genPathVM('cs_mvc_excursiones','admin/Excursion_edit','Excursion',$this->in('Excursion_id')));
    }

    function saveAccion() {
        $acc = AccionRepo::create()->oneBy($this->in_num('id',0));
        if(!$acc)
            $acc = new AccionModel();
        $acc->save($_REQUEST);
        $this->redirect($this->genPathVM('cs_mvc_excursiones','admin/Excursion_edit','Excursion',$this->in('Excursion_id')));
    }
    function saveAllAccion() {
        $arr_en = explode("\n",$_REQUEST['acciones_en']);
        $arr_es = explode("\n",$_REQUEST['acciones_es']);
        var_dump($arr_en);
        $i = 0;
        foreach($arr_en as $str_en) {
            $str_es = $arr_es[$i];
            $str = "[:en]".$str_en."[:es]".$str_es;
            //guardando la accion
            $acc = new AccionModel();
            $acc->orden = 1;
            $acc->nombre = $str;
            $acc->Excursion_id = $_REQUEST['Excursion_id'];
            $acc->Viaje_id = $_REQUEST['Viaje_id'];
            $acc->save();
            $i++;
        }

        $this->redirect($this->genPathVM('cs_mvc_excursiones','admin/Excursion_edit','Excursion',$this->in('Excursion_id')));
    }

} 
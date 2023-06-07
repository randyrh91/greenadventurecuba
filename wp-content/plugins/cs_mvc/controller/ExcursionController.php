<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/RatingModel.php';

class ExcursionController extends Controller
{
    function save()
    {
        $excursion = $this->_save($_REQUEST);
        //Si Existe el post le pone los meta datos para la vista MVC
        //Si no Existe lo crea y le pone los metadatos
        if ($excursion->Post_ID) {
            update_post_meta($excursion->Post_ID, 'id', $excursion->id, true);
            update_post_meta($excursion->Post_ID, 'view', 'aventurasView');
            update_post_meta($excursion->Post_ID, 'viewmodel', 'Book');
        } elseif($this->in('create_post',false)) {
            $Post_ID = wp_insert_post(array(
                "post_type"=>"page",
                "post_status"=>"publish",
                "post_name"=>sanitize_title($excursion->nombre),
                "post_title"=>$excursion->nombre,
                "page_template"=>'_notitle_post_dev.php',
//                "post_parent"=>($excursion->TipoExcursion_id == 3) ? 72 : (($excursion->TipoExcursion_id == 2) ? 70:68),
                "post_parent"=> 280,
            ));
            $excursion->Post_ID = $Post_ID;
            $excursion->save();
            update_post_meta($excursion->Post_ID, 'id', $excursion->id, true);
//            update_post_meta($excursion->Post_ID, 'view', ($excursion->TipoExcursion_id == 3) ? 'bookView' : 'bookLargeView');
            update_post_meta($excursion->Post_ID, 'view', 'bookView');
            update_post_meta($excursion->Post_ID, 'viewmodel', 'Book');
        }

        if ($this->in('page') == 'site')
            $this->redirect($this->genPathSite('Excursiones-edit/?show_details=1&id=' . $excursion->id));
        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Excursion_edit', 'Excursion', $excursion->id));
    }

    /**
     * @return ExcursionModel
     */
    private function _save($data)
    {
        /** @var ExcursionModel $excursion */
        $excursion = ExcursionRepo::create()->oneBy(intval($data['id']));
        $data['Rating_id'] = $excursion->Rating_id;
        if (!$excursion) {
            $excursion = new ExcursionModel();
            $newRating = new RatingModel();
            $newRating->save(array('id' => ''));
            $data['Rating_id'] = $newRating->id;
        }
        $excursion->active = isset($data['active']);
        $excursion->isPop = isset($data['isPop']);
        $excursion->save($data);
        //gestion de modalidades
        foreach($excursion->getModalidadExcursiones() as $mod_exc) {
            $mod_exc->delete();
        }
        $ids = $this->in('modalidades',array());
        foreach($ids as $id_mod) {
            $mod = new ModalidadExcursionesModel();
            $mod->Modalidad_id = $id_mod;
            $mod->Excursion_id = $excursion->id;
            $mod->save();
        }
        return $excursion;
    }

    function remove()
    {
        if ($this->in('id')) {
            /** @var ExcursionModel $excursion */
            $excursion = ExcursionRepo::create()->oneBy($this->in_num('id'));
            /** @var RatingModel $rating */
            $rating = RatingRepo::create()->oneBy(intval($excursion->Rating_id));
            $excursion->delete();
            $rating->delete();
        }

        if ($this->in('page') == 'site')
            $this->redirect($this->genPathSite('cs_mvc_excursiones'));
        $this->redirectPage('cs_mvc_excursiones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ExcursionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success' => 'true'));
    }

    function saveJSON()
    {
        $excursion = $this->_save($this->in_ajax());
        $this->responseJSON($excursion->toArray());
    }

    function upLoadImg()
    {
        $img = new ImagenExcursionModel();
        $img->nombre = $_REQUEST['nombre'];
        $img->foto = $this->in('foto');
        $img->Excursion_id = $_REQUEST['Excursion_id'];
        $img->save();
        if (!$this->in('foto'))
            $this->uploadFoto($img);

        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Excursion_edit', 'Excursion', $this->in('Excursion_id')));
    }

    function upLoadImgs()
    {
        $path = $this->in('foto_dir');
        if (is_dir($path)) { //verificando que exista la carpeta
            if ($dir = opendir($path)) {
                while (($file_dir = readdir($dir)) !== false) { //leyendo el contenido de la carpeta
//                    if(is_file($path."/".$file_dir) && preg_match("/.scnodo$/",$file_dir)) { //verificar que es un file
                    if (is_file($path . "/" . $file_dir) && preg_match('/.jpg|.png$/i', $file_dir)) { //verificar que es un file
                        $new_name = $file_dir;
                        copy($path . "/" . $file_dir, CS_MVC_PATH . '/foto/excursiones/' . $new_name);
                        $buscar = array('jpg', 'png', 'JPG', 'PNG');
                        $sinExt = str_replace($buscar, '', $new_name);
                        $traslate = explode('_', $sinExt);
                        $traslateEng = $traslate[0];
                        $traslateEsp = $traslate[1];
                        $nameTraslate = '[:en]' . $traslateEng . '[:es]' . $traslateEsp;
//                        Guardando images
                        $img = new ImagenExcursionModel();
                        $img->nombre = $nameTraslate;
                        $img->foto = $new_name;
                        $img->Excursion_id = $_REQUEST['Excursion_id'];
                        $img->save();
                    }
                }
                closedir($dir);
            }
        }
        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Excursion_edit', 'Excursion', $this->in('Excursion_id')));
    }

    function deleteImg()
    {
        /** @var ImagenExcursionModel $img */
        $img = ImagenExcursionRepo::create()->oneBy($this->in_num('id'));
        $this->deleteFoto($img);
        $img->delete();

        $this->responseJSON(array('success' => 'true'));
    }

    function saveDestinoTuristico()
    {
        $data = $_REQUEST;
        $viaje = ViajeRepo::create()->oneBy(intval($data['id']));
        if (!$viaje)
            $viaje = new ViajeModel();
        $viaje->save($data);

        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Excursion_edit', 'Excursion', $this->in('Excursion_id')));
    }

    function saveAccion()
    {
        $acc = AccionRepo::create()->oneBy($this->in_num('id', 0));
        if (!$acc)
            $acc = new AccionModel();
        $acc->save($_REQUEST);
        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Excursion_edit', 'Excursion', $this->in('Excursion_id')));
    }

    function saveAllAccion()
    {

        if($this->in('acc')=='clearAddAll') {
            /** @var AccionModel $acc */
            foreach(AccionRepo::create()->allBy(array('Excursion_id'=>$this->in_num('Excursion_id'))) as $acc)
            {
                $acc->delete();
            }
        }
        $arr_en = explode("\n", $_REQUEST['acciones_en']);
        $arr_es = explode("\n", $_REQUEST['acciones_es']);
        $i = 0;
        foreach ($arr_en as $str_en) {
            $str_es = $arr_es[$i];
            $str = "[:en]" . $str_en . "[:es]" . $str_es;
            //guardando la accion
            $acc = new AccionModel();
            $acc->orden = 1;
            $acc->nombre = $str;
            $acc->Excursion_id = $_REQUEST['Excursion_id'];
            $acc->Viaje_id = $_REQUEST['Viaje_id'];
            $acc->save();
            $i++;
        }

        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Excursion_edit', 'Excursion', $this->in('Excursion_id')));
    }

    function details()
    {
        /** @var ExcursionModel $item */
        $item = ExcursionRepo::create()->oneBy($this->in_num('id'));

        $this->render('detailsView',array(
            'item'=>$item
        ));
    }

    function incluidoJSON()
    {
        if ($this->in('id')) {
            $arr = ExcursionRepo::create()->observaciones_arr($this->in_num('id'),1);
            $this->responseJSON(array('success' => 'true', "data" => $arr));
        }
        $this->responseJSON(array('success' => 'false'));
    }
    function noIncluidoJSON()
    {
        if ($this->in('id')) {
            $arr = ExcursionRepo::create()->observaciones_arr($this->in_num('id'),0);
            $this->responseJSON(array('success' => 'true', "data" => $arr));
        }
        $this->responseJSON(array('success' => 'false'));
    }
    function observacionesJSON()
    {
        if ($this->in('id')) {
            $arr = ExcursionRepo::create()->observaciones_arr($this->in_num('id'));
            $this->responseJSON(array('success' => 'true', "data" => $arr));
        }
        $this->responseJSON(array('success' => 'false'));
    }
    function saveObservacionesIncluyeJSON() {
        foreach(ObservacionesRepo::create()->allBy(array(
            "Excursion_id" => $this->in('id'),
            "isIncluye" => 1
        )) as $observacion) {
            $observacion->delete();
        }
        foreach($this->in_ajax() as $obj) {
            $obs = new ObservacionesModel();
            $obs->descripcion = $obj->nombre;
            $obs->isIncluye = 1;
            $obs->Excursion_id = $this->in('id');
            $obs->save();
        }
        $this->responseJSON(array('success' => 'true'));
    }

    function saveObservacionesNoIncluyeJSON() {
        foreach(ObservacionesRepo::create()->allBy(array(
            "Excursion_id" => $this->in('id'),
            "isIncluye" => 0
        )) as $observacion) {
            $observacion->delete();
        }
        foreach($this->in_ajax() as $obj) {
            $obs = new ObservacionesModel();
            $obs->descripcion = $obj->nombre;
            $obs->isIncluye = 0;
            $obs->Excursion_id = $this->in('id');
            $obs->save();
        }
        $this->responseJSON(array('success' => 'true'));
    }


} 
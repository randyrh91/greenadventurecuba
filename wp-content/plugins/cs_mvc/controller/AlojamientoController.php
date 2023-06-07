<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/RatingModel.php';

class AlojamientoController extends Controller
{
    function save()
    {
        $alojamiento = $this->_save($_REQUEST);
        //Si Existe el post le pone los meta datos para la vista MVC
        //Si no Existe lo crea y le pone los metadatos
        if ($alojamiento->Post_ID) {
            update_post_meta($alojamiento->Post_ID, 'id', $alojamiento->id, true);
//            update_post_meta($alojamiento->Post_ID, 'view', ($alojamiento->TipoAlojamiento_id == 3) ? 'bookView' : 'bookLargeView');
            update_post_meta($alojamiento->Post_ID, 'view', 'hostalesView');
            update_post_meta($alojamiento->Post_ID, 'viewmodel', 'Book');
        } elseif($this->in('create_post',false)) {
            $Post_ID = wp_insert_post(array(
                "post_type"=>"page",
                "post_status"=>"publish",
                "post_name"=>sanitize_title($alojamiento->nombre),
                "post_title"=>$alojamiento->nombre,
                "page_template"=>'_notitle_post_dev.php',
//                "post_parent"=>($alojamiento->TipoAlojamiento_id == 3) ? 72 : (($alojamiento->TipoAlojamiento_id == 2) ? 70:68),
                "post_parent"=> 277,
            ));
            $alojamiento->Post_ID = $Post_ID;
            $alojamiento->save();
            update_post_meta($alojamiento->Post_ID, 'id', $alojamiento->id, true);
//            update_post_meta($alojamiento->Post_ID, 'view', ($alojamiento->TipoAlojamiento_id == 3) ? 'bookView' : 'bookLargeView');
            update_post_meta($alojamiento->Post_ID, 'view', 'bookView');
            update_post_meta($alojamiento->Post_ID, 'viewmodel', 'Book');
        }

        if ($this->in('page') == 'site')
            $this->redirect($this->genPathSite('Alojamientos-edit/?show_details=1&id=' . $alojamiento->id));
        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Alojamiento_edit', 'Alojamiento', $alojamiento->id));
    }

    /**
     * @return AlojamientoModel
     */
    private function _save($data)
    {
        /** @var AlojamientoModel $alojamiento */
        $alojamiento = AlojamientoRepo::create()->oneBy(intval($data['id']));
        $data['Rating_id'] = $alojamiento->Rating_id;
        if (!$alojamiento) {
            $alojamiento = new AlojamientoModel();
            $newRating = new RatingModel();
            $newRating->save(array('id' => ''));
            $data['Rating_id'] = $newRating->id;
        }
        $alojamiento->active = isset($data['active']);
        $alojamiento->isPop = isset($data['isPop']);
        $alojamiento->save($data);
        //gestion de modalidades
        foreach($alojamiento->getServicioAlojamientos() as $alj_serv) {
            $alj_serv->delete();
        }
        $ids = $this->in('servicios',array());
        foreach($ids as $id_ser) {
            $serv = new ServiciosAlojamientosModel();
            $serv->Servicio_id = $id_ser;
            $serv->Alojamiento_id = $alojamiento->id;
            $serv->save();
        }
        return $alojamiento;
    }

    function remove()
    {
        if ($this->in('id')) {
            /** @var AlojamientoModel $alojamiento */
            $alojamiento = AlojamientoRepo::create()->oneBy($this->in_num('id'));
            /** @var RatingModel $rating */
            $rating = RatingRepo::create()->oneBy(intval($alojamiento->Rating_id));
            $alojamiento->delete();
            $rating->delete();
        }

        if ($this->in('page') == 'site')
            $this->redirect($this->genPathSite('cs_mvc_alojamientos'));
        $this->redirectPage('cs_mvc_alojamientos');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            AlojamientoRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success' => 'true'));
    }

    function saveJSON()
    {
        $alojamiento = $this->_save($this->in_ajax());
        $this->responseJSON($alojamiento->toArray());
    }

    function upLoadImg()
    {
        $img = new ImagenAlojamientoModel();
        $img->nombre = $_REQUEST['nombre'];
        $img->foto = $this->in('foto');
        $img->Alojamiento_id = $_REQUEST['Alojamiento_id'];
        $img->save();
        if (!$this->in('foto'))
            $this->uploadFoto($img);

        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Alojamiento_edit', 'Alojamiento', $this->in('Alojamiento_id')));
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
                        copy($path . "/" . $file_dir, CS_MVC_PATH . '/foto/alojamientos/' . $new_name);
                        $buscar = array('jpg', 'png', 'JPG', 'PNG');
                        $sinExt = str_replace($buscar, '', $new_name);
                        $traslate = explode('_', $sinExt);
                        $traslateEng = $traslate[0];
                        $traslateEsp = $traslate[1];
                        $nameTraslate = '[:en]' . $traslateEng . '[:es]' . $traslateEsp;
//                        Guardando images
                        $img = new ImagenAlojamientoModel();
                        $img->nombre = $nameTraslate;
                        $img->foto = $new_name;
                        $img->Alojamiento_id = $_REQUEST['Alojamiento_id'];
                        $img->save();
                    }
                }
                closedir($dir);
            }
        }
        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Alojamiento_edit', 'Alojamiento', $this->in('Alojamiento_id')));
    }

    function deleteImg()
    {
        /** @var ImagenAlojamientoModel $img */
        $img = ImagenAlojamientoRepo::create()->oneBy($this->in_num('id'));
        $this->deleteFoto($img);
        $img->delete();

        $this->responseJSON(array('success' => 'true'));
    }

    function saveHabitacion()
    {
        $data = $_REQUEST;
        $hab = HabitacionRepo::create()->oneBy(intval($data['id']));
        if (!$hab)
            $hab = new HabitacionModel();
        $hab->save($data);

        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Alojamiento_edit', 'Alojamiento', $this->in('Alojamiento_id')));
    }

    function saveAccion()
    {
        $acc = AccionRepo::create()->oneBy($this->in_num('id', 0));
        if (!$acc)
            $acc = new AccionModel();
        $acc->save($_REQUEST);
        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Alojamiento_edit', 'Alojamiento', $this->in('Alojamiento_id')));
    }

    function saveAllAccion()
    {

        if($this->in('acc')=='clearAddAll') {
            /** @var AccionModel $acc */
            foreach(AccionRepo::create()->allBy(array('Alojamiento_id'=>$this->in_num('Alojamiento_id'))) as $acc)
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
            $acc->Alojamiento_id = $_REQUEST['Alojamiento_id'];
            $acc->Viaje_id = $_REQUEST['Viaje_id'];
            $acc->save();
            $i++;
        }

        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Alojamiento_edit', 'Alojamiento', $this->in('Alojamiento_id')));
    }

    function details()
    {
        /** @var AlojamientoModel $item */
        $item = AlojamientoRepo::create()->oneBy($this->in_num('id'));

        $this->render('detailsView',array(
            'item'=>$item
        ));
    }

    function incluidoJSON()
    {
        if ($this->in('id')) {
            $arr = AlojamientoRepo::create()->observaciones_arr($this->in_num('id'),1);
            $this->responseJSON(array('success' => 'true', "data" => $arr));
        }
        $this->responseJSON(array('success' => 'false'));
    }
    function noIncluidoJSON()
    {
        if ($this->in('id')) {
            $arr = AlojamientoRepo::create()->observaciones_arr($this->in_num('id'),0);
            $this->responseJSON(array('success' => 'true', "data" => $arr));
        }
        $this->responseJSON(array('success' => 'false'));
    }
    function observacionesJSON()
    {
        if ($this->in('id')) {
            $arr = AlojamientoRepo::create()->observaciones_arr($this->in_num('id'));
            $this->responseJSON(array('success' => 'true', "data" => $arr));
        }
        $this->responseJSON(array('success' => 'false'));
    }
    function saveObservacionesIncluyeJSON() {
        foreach(ObservacionesRepo::create()->allBy(array(
            "Alojamiento_id" => $this->in('id'),
            "isIncluye" => 1
        )) as $observacion) {
            $observacion->delete();
        }
        foreach($this->in_ajax() as $obj) {
            $obs = new ObservacionesModel();
            $obs->descripcion = $obj->nombre;
            $obs->isIncluye = 1;
            $obs->Alojamiento_id = $this->in('id');
            $obs->save();
        }
        $this->responseJSON(array('success' => 'true'));
    }

    function saveObservacionesNoIncluyeJSON() {
        foreach(ObservacionesRepo::create()->allBy(array(
            "Alojamiento_id" => $this->in('id'),
            "isIncluye" => 0
        )) as $observacion) {
            $observacion->delete();
        }
        foreach($this->in_ajax() as $obj) {
            $obs = new ObservacionesModel();
            $obs->descripcion = $obj->nombre;
            $obs->isIncluye = 0;
            $obs->Alojamiento_id = $this->in('id');
            $obs->save();
        }
        $this->responseJSON(array('success' => 'true'));
    }


} 
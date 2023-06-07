<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';

class HabitacionController extends Controller {

    function save() {
        $habitacion = $this->_save($_REQUEST);

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('Habitaciones-edit/?show_details=1&id='.$habitacion->id));
        $this->redirect($this->genPathVM('cs_mvc_alojamientos','admin/Habitacion_edit','Habitacion',$habitacion->id));
    }
	
	/**
    * @return HabitacionModel
    */
    private function _save($data) {
        $habitacion = HabitacionRepo::create()->oneBy(intval($data['id']));
        if (!$habitacion)
            $habitacion = new HabitacionModel();
        $habitacion->save($data);
        foreach($habitacion->getServicioHabitaciones() as $serv) {
            $serv->delete();
        }
        $ids = $this->in('servicios',array());
        foreach($ids as $id_ser) {
            $serv = new ServiciosHabitacionesModel();
            $serv->Servicio_id = $id_ser;
            $serv->Habitacion_id = $habitacion->id;
            $serv->save();
        }
        return $habitacion;
    }

    function remove() {
        if($this->in('id')) {
            HabitacionRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if($this->in('page')=='site')
            $this->redirect($this->genPathSite('cs_mvc_habitaciones'));
        $this->redirectPage('cs_mvc_habitaciones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            HabitacionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success'=>'true'));
    }

    function saveJSON() {
        $habitacion = $this->_save($this->in_ajax());
        $this->responseJSON($habitacion->toArray());
    }

    function saveAccion()
    {
        $acc = AccionRepo::create()->oneBy($this->in_num('id', 0));
        if (!$acc)
            $acc = new AccionModel();
        $acc->save($_REQUEST);
        $this->redirect($this->genPathVM('cs_mvc_excursiones', 'admin/Habitacion_edit', 'Habitacion', $this->in('Habitacion_id')));
    }

    function upLoadImg()
    {
        $img = new ImagenHabitacionModel();
        $img->nombre = $_REQUEST['nombre'];
        $img->foto = $this->in('foto');
        $img->Habitacion_id = $_REQUEST['Habitacion_id'];
        $img->save();
        if (!$this->in('foto'))
            $this->uploadFoto($img);

        $this->redirect($this->genPathVM('cs_mvc_alojamientos', 'admin/Habitacion_edit', 'Habitacion', $this->in('Habitacion_id')));
    }

    function deleteImg()
    {
        /** @var ImagenHabitacionModel $img */
        $img = ImagenHabitacionRepo::create()->oneBy($this->in_num('id'));
        $this->deleteFoto($img);
        $img->delete();

        $this->responseJSON(array('success' => 'true'));
    }

} 
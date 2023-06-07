<?php

require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';

class ServiciosHabitacionesRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}
class ServiciosHabitacionesModel extends ORMModel {
    const TABLE = "cu_neg_servicios_habitacion";

    /**
     * @var int
     */
    public $Servicio_id;

    /**
     * @var int
     */
    public $Habitacion_id;
    /**
     * @return ServiciosModel
     */
    public function getServicio()
    {
        return $this->hasOne('ServiciosModel','Servicio_id', 'id');
    }
    /**
     * @return HabitacionModel
     */
    public function getHabitacion()
    {
        return $this->hasOne('HabitacionModel','Habitacion_id', 'id');
    }
    public function toArray() {
        $arr = parent::toArray();
        $arr['servicio_display'] = $this->getServicio()->__toString();
        $arr['habitacion_display'] = $this->getHabitacion()->__toString();
        return $arr;

    }


    public function __toString() {
        return 'relacion m-m';
    }

} // Accion

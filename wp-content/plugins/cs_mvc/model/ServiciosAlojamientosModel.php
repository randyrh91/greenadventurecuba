<?php

require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';

class ServiciosAlojamientosRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}
class ServiciosAlojamientosModel extends ORMModel {
    const TABLE = "cu_neg_servicios_alojamiento";

    /**
     * @var int
     */
    public $Servicio_id;

    /**
     * @var int
     */
    public $Alojamiento_id;
    /**
     * @return ServiciosModel
     */
    public function getServicio()
    {
        return $this->hasOne('ServiciosModel','Servicio_id', 'id');
    }
    /**
     * @return AlojamientoModel
     */
    public function getAlojamiento()
    {
        return $this->hasOne('AlojamientoModel','Alojamiento_id', 'id');
    }
    public function toArray() {
        $arr = parent::toArray();
        $arr['servicio_display'] = $this->getServicio()->__toString();
        $arr['alojamiento_display'] = $this->getAlojamiento()->__toString();
        return $arr;

    }


    public function __toString() {
        return 'relacion m-m';
    }

} // Accion

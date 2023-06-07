<?php

require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';

class ServiciosExcursionesRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}
class ServiciosExcursionesModel extends ORMModel {
    const TABLE = "cu_neg_servicios_excursion";

    /**
     * @var int
     */
    public $Servicio_id;

    /**
     * @var int
     */
    public $Excursion_id;
    /**
     * @return ServiciosModel
     */
    public function getServicio()
    {
        return $this->hasOne('ServiciosModel','Servicio_id', 'id');
    }
    /**
     * @return ExcursionModel
     */
    public function getExcursion()
    {
        return $this->hasOne('ExcursionModel','Excursion_id', 'id');
    }
    public function toArray() {
        $arr = parent::toArray();
        $arr['servicio_display'] = $this->getServicio()->__toString();
        $arr['excursion_display'] = $this->getExcursion()->__toString();
        return $arr;

    }
    /**
     * @var int
     */
    public $Viaje_id;

    public function __toString() {
        return 'relacion m-m';
    }

} // Accion

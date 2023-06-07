<?php

require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ModalidadModel.php';

class ModalidadExcursionesRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}
class ModalidadExcursionesModel extends ORMModel {
    const TABLE = "cu_neg_modalidad_excursion";

    /**
     * @var int
     */
    public $Modalidad_id;

    /**
     * @var int
     */
    public $Excursion_id;
    /**
     * @return ModalidadModel
     */
    public function getModalidad()
    {
        return $this->hasOne('ModalidadModel','Modalidad_id', 'id');
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
        $arr['modalidad_display'] = $this->getModalidad()->__toString();
        $arr['excursion_display'] = $this->getExcursion()->__toString();
        return $arr;

    }

    public function __toString() {
        return 'relacion m-m';
    }

} // ModalidadExcursionesModel

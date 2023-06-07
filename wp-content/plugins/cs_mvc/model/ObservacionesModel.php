<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class ObservacionesRepo extends ORMRepo
{
    /**
     * @return self
     */
    public static function create()
    {
        return self::_create(__CLASS__);
    }

}

class ObservacionesModel extends ORMModel
{
    const TABLE = "cu_neg_observaciones";

    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $Excursion_id;
    /**
     * @var boolean
     */
    public $isIncluye;
    /**
     * @var string
     */
    public $descripcion;



    /**
     * @return ExcursionModel
     */
    public function getExcursion()
    {
        return $this->hasOne('ExcursionModel', 'Excursion_id', 'id');
    }
    public function toArray()
    {
        $arr = parent::toArray();
        return $arr;

    }
    public function __toString()
    {
        return $this->descripcion;
    }

}

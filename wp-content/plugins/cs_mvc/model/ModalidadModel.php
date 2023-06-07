<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ModalidadExcursionesModel.php';

class ModalidadRepo extends ORMRepo
{
    /**
     * @return self
     */
    public static function create()
    {
        return self::_create(__CLASS__);
    }

}

class ModalidadModel extends ORMModel
{
    const TABLE = "cu_neg_modalidad";

    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $nombre;
    /**
     * @var string
     */
    public $textoCorto;
    /**
     * @return ModalidadExcursionesModel[]
     */
    public function getExcursiones()
    {
        return $this->hasMany('ModalidadExcursionesModel', 'Modalidad_id');
    }

    public function toArray()
    {
        $arr = parent::toArray();
        return $arr;

    }

    public function __toString()
    {
        return $this->nombre;
    }

}

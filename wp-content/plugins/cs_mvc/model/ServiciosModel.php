<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosExcursionesModel.php';

class ServiciosRepo extends ORMRepo
{
    /**
     * @return self
     */
    public static function create()
    {
        return self::_create(__CLASS__);
    }

}

class ServiciosModel extends ORMModel
{
    const TABLE = "cu_neg_servicios";

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
    public $icono;
    /**
     * @var string
     */
    public $descripcion;
    /**
     * @return ServiciosExcursionesModel[]
     */
    public function getExcursiones()
    {
        return $this->hasMany('ServiciosExcursionesModel', 'Servicio_id');
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

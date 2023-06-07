<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class ListaPrecioRepo extends ORMRepo
{
    /**
     * @return self
     */
    public static function create()
    {
        return self::_create(__CLASS__);
    }

}

class ListaPrecioModel extends ORMModel
{
    const TABLE = "cu_neg_lista_precio";

    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $cantidadPersonas;
    /**
     * @var double
     */
    public $precio;
    /**
     * @var string
     */
    public $moneda;
    /**
     * @var int
     */
    public $Excursion_id;

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
        return $this->precio. " ". $this->moneda;
    }

}

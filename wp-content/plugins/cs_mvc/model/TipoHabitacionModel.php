<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';

class TipoHabitacionRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class TipoHabitacionModel extends ORMModel {
    const TABLE = "cu_neg_tipo_habitacion";

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
     * @return HabitacionModel[]
     */
    public function getHabitaciones()
    {
        return $this->hasMany('HabitacionModel','TipoHabitacion_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
